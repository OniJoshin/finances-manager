<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\SavingsGoal;

class SavingsGoalTest extends TestCase
{
    public function test_percent_complete_is_calculated_correctly(): void
    {
        $goal = new SavingsGoal([
            'target_amount' => 1000,
            'current_amount' => 250,
        ]);

        $this->assertSame(25, $goal->percent_complete);
    }

    public function test_percent_complete_is_capped_at_100(): void
    {
        $goal = new SavingsGoal([
            'target_amount' => 500,
            'current_amount' => 1000,
        ]);

        $this->assertSame(100, $goal->percent_complete);
    }

    public function test_percent_complete_is_zero_when_target_is_zero(): void
    {
        $goal = new SavingsGoal([
            'target_amount' => 0,
            'current_amount' => 100,
        ]);

        $this->assertSame(0, $goal->percent_complete);
    }
}
