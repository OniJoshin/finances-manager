<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringIncomeLog extends Model
{
    protected $fillable = [
        'recurring_income_id',
        'income_id',
        'generated_for_date',
    ];

    protected $casts = [
        'generated_for_date' => 'date',
    ];

    public function recurringIncome()
    {
        return $this->belongsTo(RecurringIncome::class);
    }

    public function income()
    {
        return $this->belongsTo(Income::class);
    }
}

