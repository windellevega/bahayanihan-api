<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerApplication extends Model
{
    protected $fillable = [
        'user_id', 'application_details',
    ];
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function WokerApplicationStatusHistory()
    {
        return $this->belongsToMany('App\ApplicationStatus', 'worker_application_status_details', 'worker_application_id', 'application_status_id')
                ->withTimestamps();
    }
}
