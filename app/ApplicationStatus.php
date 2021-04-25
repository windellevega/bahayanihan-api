<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function workerApplications()
    {
        return $this->belongsToMany('App\WorkerApplication');
    }
}
