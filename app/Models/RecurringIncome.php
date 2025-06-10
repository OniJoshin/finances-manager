<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringIncome extends Model
{
    protected $fillable = [
        'user_id',
        'source',
        'amount',
        'frequency',
        'start_date',
        'day_of_month',
        'notes',
        'last_generated_at',
        'category_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'last_generated_at' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recurring_income_tag');
    }
}