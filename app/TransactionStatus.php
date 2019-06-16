<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function TransactionStatusDetail()
    {
        return $this->belongsTo('App\TransactionStatusDetail');
    }
}
