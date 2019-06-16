<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function WorkerApplicationStatusDetail()
    {
        return $this->belongsTo('App\WorkerApplicationStatusDetail');
    }
}
