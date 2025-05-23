<?php

namespace App\Console\Commands;

use App\Models\Bill;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RenewBills extends Command
{
    protected $signature = 'bills:renew';
    protected $description = 'Automatically renew bills into the next due period if paid and due in this month';

    public function handle()
    {
        $now = now();

        $this->info("Checking for outdated bill due dates...");

        $bills = \App\Models\Bill::whereDate('next_due_date', '<', $now)->get();

        foreach ($bills as $bill) {
            $original = $bill->next_due_date->copy();

            while ($bill->next_due_date->lt($now)) {
                $bill->next_due_date = match ($bill->frequency) {
                    'weekly' => $bill->next_due_date->addWeek(),
                    'monthly' => $bill->next_due_date->addMonthNoOverflow(),
                    'yearly' => $bill->next_due_date->addYear(),
                    default => $bill->next_due_date,
                };
            }

            $bill->save();

            $this->info("✓ Advanced '{$bill->name}' from {$original->format('Y-m-d')} to {$bill->next_due_date->format('Y-m-d')}");
        }

        $this->info("Bill due date renewal complete.");
        return Command::SUCCESS;
    }

}
