<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function Transactions()
    {
        return $this->belongsToMany('App\Transaction');
    }
}
