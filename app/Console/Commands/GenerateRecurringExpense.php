<?php

namespace App\Console\Commands;

use App\Models\Expense;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Models\RecurringExpense;
use App\Models\RecurringExpenseLog;

class GenerateRecurringExpense extends Command
{
    protected $signature = 'expense:generate-recurring';
    protected $description = 'Generate recurring expense entries';

    public function handle(): int
    {
        $today = now()->startOfDay();
        $endOfMonth = now()->endOfMonth();

        $this->info('Checking recurring expenses for generation: ' . $today->toDateString());

        $recurrings = RecurringExpense::with('user')->get();

        foreach ($recurrings as $recurring) {
            $last = $recurring->last_generated_at ?? $recurring->start_date->copy()->subMonth();
            $nextDue = $last;

            while (true) {
                $nextDue = $this->getNextDueDate($nextDue, $recurring);

                if ($nextDue->greaterThan($endOfMonth)) {
                    break;
                }

                $alreadyExists = $recurring->user->expenses()
                    ->where('name', $recurring->name)
                    ->whereDate('spent_at', $nextDue)
                    ->exists();

                if ($alreadyExists) {
                    $recurring->last_generated_at = $nextDue;
                    $recurring->save();
                    continue;
                }

                $this->info("→ Generating {$recurring->name} for " . $nextDue->toDateString());

                $expense = Expense::create([
                    'user_id' => $recurring->user_id,
                    'name' => $recurring->name,
                    'amount' => $recurring->amount,
                    'spent_at' => $nextDue,
                    'category_id' => $recurring->category_id,
                    'notes' => $recurring->notes,
                    'is_recurring' => true,
                ]);

                $expense->tags()->sync($recurring->tags->pluck('id'));


                RecurringExpenseLog::create([
                    'recurring_expense_id' => $recurring->id,
                    'expense_id' => $expense->id,
                    'generated_for_date' => $nextDue,
                ]);


                $recurring->last_generated_at = $nextDue;
                $recurring->save();

                // Only generate one per run
                break;
            }
        }

        $this->info('Recurring expense generation complete.');
        return Command::SUCCESS;
    }

    private function getNextDueDate(Carbon $from, RecurringExpense $recurring): Carbon
    {
        $day = $recurring->day_of_month ?? $recurring->start_date->day;

        return match ($recurring->frequency) {
            'weekly' => $from->copy()->addWeek(),
            'monthly' => $from->copy()->addMonthNoOverflow()->day(min($day, $from->copy()->addMonthNoOverflow()->daysInMonth)),
            'yearly' => $from->copy()->addYear()->day(min($day, $from->copy()->addYear()->daysInMonth)),
            default => $from,
        };
    }
}
