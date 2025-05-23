<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'monthly_contribution',
        'target_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPercentCompleteAttribute()
    {
        if ($this->target_amount == 0) return 0;
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }
}
