<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'user_id',
        'source',
        'amount',
        'frequency',
        'received_at',
        'notes',
        'category_id',
    ];

    protected $casts = [
        'received_at' => 'date',
    ];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
