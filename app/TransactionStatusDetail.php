<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatusDetail extends Model
{
    protected $fillable = [
        'transaction_id', 'transaction_status_id', 'remarks',
    ];

    public function Transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function TransactionStatuses()
    {
        return $this->hasMany('App\TransactionStatus');
    }
}
