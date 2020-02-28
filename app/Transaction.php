<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'id', 'hailer_id', 'worker_id', 'skill_id', 'job_description',
        'transaction_long', 'transaction_lat', 'actions_taken',
        'job_durations', 'total_cost',
    ];
    
    public function Hailer()
    {
        return $this->belongsTo('App\User', 'hailer_id');
    }

    public function Worker()
    {
        return $this->belongsTo('App\User', 'worker_id');
    }

    public function TransactionStatusHistory()
    {
        return $this->belongsToMany('App\TransactionStatus', 'transaction_status_details', 'transaction_id', 'transaction_status_id')
                ->withPivot('remarks')
                ->withTimestamps()
                ->orderBy('transaction_status_details.created_at', 'desc');
    }

    public function latestStatus()
    {
        return $this->TransactionStatusHistory()
                ->limit(1);
    }
}
