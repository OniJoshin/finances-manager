<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Budget;
use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use League\Csv\Reader;
use SplTempFileObject;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }

    public function export()
    {
        $userId = Auth::id();

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['Type', 'Name', 'Amount', 'Category ID', 'Date', 'Notes']);

        // Expenses
        foreach (Expense::where('user_id', $userId)->get() as $e) {
            $csv->insertOne(['Expense', $e->name, $e->amount, $e->category_id, $e->spent_at, $e->notes]);
        }

        // Income
        foreach (Income::where('user_id', $userId)->get() as $i) {
            $csv->insertOne(['Income', $i->source, $i->amount, null, $i->received_at, null]);
        }

        // Budgets
        foreach (Budget::where('user_id', $userId)->get() as $b) {
            $csv->insertOne(['Budget', $b->category->name, $b->amount, $b->category_id, $b->start_date, $b->period]);
        }

        // Goals
        foreach (SavingsGoal::where('user_id', $userId)->get() as $g) {
            $notes = "Target: {$g->target_amount}" . ($g->notes ? " | {$g->notes}" : '');
            $csv->insertOne(['Goal', $g->name, $g->current_amount, null, $g->target_date, $notes]);
        }


        return Response::make((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="finance-backup.csv"',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        $dryRun = $request->boolean('dry_run');
        $userId = Auth::id();
        $reader = Reader::createFromPath($request->file('csv')->getRealPath(), 'r');
        $reader->setHeaderOffset(0);

        $summary = [];

        foreach ($reader->getRecords() as $record) {
            $type = $record['Type'];
            $name = $record['Name'];

            switch ($type) {
                case 'Expense':
                    $exists = Expense::where('user_id', $userId)
                        ->where('name', $name)
                        ->where('spent_at', $record['Date'])
                        ->first();

                    if ($exists) {
                        $summary[] = "Update Expense: $name";
                        if (!$dryRun) {
                            $exists->update([
                                'amount' => $record['Amount'],
                                'category_id' => $record['Category ID'],
                                'notes' => $record['Notes'],
                            ]);
                        }
                    } else {
                        $summary[] = "Create Expense: $name";
                        if (!$dryRun) {
                            Expense::create([
                                'user_id' => $userId,
                                'name' => $name,
                                'amount' => $record['Amount'],
                                'category_id' => $record['Category ID'],
                                'spent_at' => $record['Date'],
                                'notes' => $record['Notes'],
                            ]);
                        }
                    }
                    break;

                case 'Income':
                    $exists = Income::where('user_id', $userId)
                        ->where('source', $name)
                        ->where('received_at', $record['Date'])
                        ->first();

                    if ($exists) {
                        $summary[] = "Update Income: $name";
                        if (!$dryRun) {
                            $exists->update(['amount' => $record['Amount']]);
                        }
                    } else {
                        $summary[] = "Create Income: $name";
                        if (!$dryRun) {
                            Income::create([
                                'user_id' => $userId,
                                'source' => $name,
                                'amount' => $record['Amount'],
                                'received_at' => $record['Date'],
                            ]);
                        }
                    }
                    break;

                case 'Budget':
                    $exists = Budget::where('user_id', $userId)
                        ->where('category_id', $record['Category ID'])
                        ->where('start_date', $record['Date'])
                        ->first();

                    if ($exists) {
                        $summary[] = "Update Budget for Category ID {$record['Category ID']}";
                        if (!$dryRun) {
                            $exists->update([
                                'amount' => $record['Amount'],
                                'period' => $record['Notes'],
                            ]);
                        }
                    } else {
                        $summary[] = "Create Budget for Category ID {$record['Category ID']}";
                        if (!$dryRun) {
                            Budget::create([
                                'user_id' => $userId,
                                'category_id' => $record['Category ID'],
                                'amount' => $record['Amount'],
                                'period' => $record['Notes'] ?? 'monthly',
                                'start_date' => $record['Date'],
                            ]);
                        }
                    }
                    break;

                case 'Goal':
                    $exists = SavingsGoal::where('user_id', $userId)
                        ->where('name', $name)
                        ->first();

                    if ($exists) {
                        $summary[] = "Update Goal: $name";
                        if (!$dryRun) {
                            $exists->update([
                                'current_amount' => $record['Amount'],
                                'target_date' => $record['Date'],
                                'notes' => $record['Notes'],
                            ]);
                        }
                    } else {
                        $summary[] = "Create Goal: $name";
                        if (!$dryRun) {
                            SavingsGoal::create([
                                'user_id' => $userId,
                                'name' => $name,
                                'current_amount' => $record['Amount'],
                                'target_date' => $record['Date'] ?? null,
                                'notes' => $record['Notes'],
                                'target_amount' => $this->extractTargetAmount($record['Notes']),
                            ]);
                        }
                    }
                    break;
            }
        }

        if ($dryRun) {
            return view('backup.preview', [
                'summary' => $summary,
                'count' => count($summary),
            ]);
        }

        return redirect()->route('backup.index')->with('success', 'Import complete. ' . count($summary) . ' actions performed.');

    }

    private function extractTargetAmount($notes)
    {
        if (preg_match('/Target:\s*([\d\.]+)/i', $notes, $match)) {
            return floatval($match[1]);
        }
        return 1000;
    }


}
