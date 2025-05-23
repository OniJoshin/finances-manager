<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringExpenseLog extends Model
{

    protected $fillable = [
        'recurring_expense_id',
        'expense_id',
        'generated_for_date',
    ];

    protected $casts = [
        'generated_for_date' => 'date',
    ];


    public function recurringExpense()
    {
        return $this->belongsTo(\App\Models\RecurringExpense::class);
    }

    public function expense()
    {
        return $this->belongsTo(\App\Models\Expense::class);
    }
}
