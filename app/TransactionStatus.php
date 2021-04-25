<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function transactions()
    {
        return $this->belongsToMany('App\Transaction')
                ->withTimestamps();
    }
}
