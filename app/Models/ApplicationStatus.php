<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function workerApplications()
    {
        return $this->belongsToMany(WorkerApplication::class);
    }
}
