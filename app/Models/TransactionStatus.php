<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class)
                ->withTimestamps();
    }
}
