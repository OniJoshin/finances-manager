<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringExpenseLog extends Model
{
    public function recurringExpense()
    {
        return $this->belongsTo(\App\Models\RecurringExpense::class);
    }

    public function expense()
    {
        return $this->belongsTo(\App\Models\Expense::class);
    }
}
