<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function WorkerApplications()
    {
        return $this->belongsToMany('App\WorkerApplication');
    }
}
