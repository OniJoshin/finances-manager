<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\RecurringExpenseLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecurringExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'frequency',
        'start_date',
        'day_of_month',
        'category_id',
        'notes',
        'last_generated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'last_generated_at' => 'date',
    ];

    // 🔗 Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logs()
    {
        return $this->hasMany(RecurringExpenseLog::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recurring_expense_tag');
    }
}

