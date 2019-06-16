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

    public function WokerApplicationStatusDetails()
    {
        return $this->hasMany('App\WorkerApplicationStatusDetail');
    }
}
