<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'id', 'hailer_id', 'worker_id', 'skill_id', 'job_description',
        'transaction_long', 'transaction_lat', 'actions_taken',
        'job_durations', 'total_cost',
    ];
    
    public function hailer()
    {
        return $this->belongsTo(User::class, 'hailer_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function transactionStatusHistory()
    {
        return $this->belongsToMany(TransactionStatus::class, 'transaction_status_details', 'transaction_id', 'transaction_status_id')
                ->withPivot('remarks')
                ->withTimestamps()
                ->orderBy('transaction_status_details.created_at', 'desc');
    }
}
