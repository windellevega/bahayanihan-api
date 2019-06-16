<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'hailer_id', 'worker_id', 'skill_id', 'job_description',
        'transaction_long', 'transaction_lat'
    ];
    
    public function Hailer()
    {
        return $this->belongsTo('App\User', 'hailer_id');
    }

    public function Worker()
    {
        return $this->belongsTo('App\User', 'worker_id');
    }

    public function TransactionStatusDetails()
    {
        return $this->hasMany('App\TransactionStatusDetail');
    }
}
