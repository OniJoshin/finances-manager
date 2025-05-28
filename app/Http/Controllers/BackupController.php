<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Income;
use League\Csv\Reader;
use League\Csv\Writer;
use SplTempFileObject;
use App\Models\Expense;
use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use App\Exports\FullBackupExport;
use App\Imports\FullBackupImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }

    public function export()
    {
       return Excel::download(new FullBackupExport(), 'finance-backup.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

       // Optional: backup existing data first (can add confirmation UI later)

        Excel::import(new FullBackupImport, $request->file('excel'));

        return redirect()->route('backup.index')->with('success', 'Data imported successfully.');

    }

    private function extractTargetAmount($notes)
    {
        if (preg_match('/Target:\s*([\d\.]+)/i', $notes, $match)) {
            return floatval($match[1]);
        }
        return 1000;
    }


}
