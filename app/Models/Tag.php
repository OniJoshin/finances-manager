<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function incomes()
    {
        return $this->belongsToMany(Income::class);
    }

}
