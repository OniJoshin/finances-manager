<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BudgetPolicy
{
    public function update(User $user, Budget $budget)
    {
        return $user->id === $budget->user_id;
    }

    public function delete(User $user, Budget $budget)
    {
        return $user->id === $budget->user_id;
    }
}
