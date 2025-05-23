<?php

namespace App\Console\Commands;

use App\Models\Income;
use App\Models\RecurringIncome;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenerateRecurringIncome extends Command
{
    protected $signature = 'income:generate-recurring';
    protected $description = 'Generate income entries for recurring incomes';

    public function handle(): int
    {
        $now = Carbon::now()->startOfDay();
        $this->info("Checking recurring incomes for generation: " . $now->toDateString());

        $recurrings = RecurringIncome::all();

        foreach ($recurrings as $recurring) {
            $referenceDate = $recurring->last_generated_at ?? $recurring->start_date->copy()->subMonth();
            $today = now()->startOfDay();
            $endOfMonth = now()->endOfMonth();

            $nextDue = $referenceDate;

            while (true) {
                $nextDue = $this->getNextDueDate($nextDue, $recurring);

                if ($nextDue->greaterThan($endOfMonth)) {
                    break;
                }

                // Skip if already exists (extra safety if running manually multiple times)
                $alreadyExists = $recurring->user->incomes()
                    ->where('source', $recurring->source)
                    ->whereDate('received_at', $nextDue)
                    ->exists();

                if ($alreadyExists) {
                    $recurring->last_generated_at = $nextDue;
                    $recurring->save();
                    continue;
                }

                $this->info("→ Generating for {$recurring->source} due on {$nextDue->toDateString()}");

                $income = Income::create([
                    'user_id' => $recurring->user_id,
                    'source' => $recurring->source,
                    'amount' => $recurring->amount,
                    'frequency' => $recurring->frequency,
                    'received_at' => $nextDue->toDateString(),
                    'notes' => $recurring->notes,
                    'category_id' => null,
                ]);

                // Log the generation
                \App\Models\RecurringIncomeLog::create([
                    'recurring_income_id' => $recurring->id,
                    'income_id' => $income->id,
                    'generated_for_date' => $nextDue->toDateString(),
                ]);


                $recurring->last_generated_at = $nextDue;
                $recurring->save();
            }


            // Create actual income entry
            $income = Income::create([
                'user_id' => $recurring->user_id,
                'source' => $recurring->source,
                'amount' => $recurring->amount,
                'frequency' => $recurring->frequency,
                'received_at' => $nextDue->toDateString(),
                'notes' => $recurring->notes,
                'category_id' => $recurring->category_id,
            ]);

            $income->tags()->sync($recurring->tags->pluck('id'));

            // Update last_generated_at
            $recurring->last_generated_at = $nextDue;
            $recurring->save();

            break;
        }

        $this->info('Recurring income generation complete.');
        return Command::SUCCESS;
    }

    private function getNextDueDate(Carbon $last, RecurringIncome $recurring): Carbon
    {
        if ($recurring->frequency === 'weekly') {
            return $last->copy()->addWeek();
        }

        if ($recurring->frequency === 'monthly') {
            $targetDay = $recurring->day_of_month ?? $recurring->start_date->day;
            $next = $last->copy()->addMonthNoOverflow();
            $daysInMonth = $next->daysInMonth;

            // Clamp to last day if needed
            $next->day = min($targetDay, $daysInMonth);
            return $next;
        }

        // Default fallback
        return now();
    }
}
