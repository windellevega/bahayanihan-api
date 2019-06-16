<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerApplicationStatusDetail extends Model
{
    protected $fillable = [
        'worker_application_id', 'application_status_id',
    ];

    public function WorkerApplication()
    {
        return $this->belongsTo('App\WorkerApplication');
    }

    public function ApplicationStatuses()
    {
        return $this->hasMany('App\ApplicationStatus');
    }
}
