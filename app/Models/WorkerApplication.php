<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerApplication extends Model
{
    protected $fillable = [
        'user_id', 'application_details',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workerApplicationStatusHistory()
    {
        return $this->belongsToMany(ApplicationStatus::class, 'worker_application_status_details', 'worker_application_id', 'application_status_id')
                ->withTimestamps();
    }
}
