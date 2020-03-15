<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill_name', 'skill_rate', 'picture_url'
    ];

    public function Users()
    {
        return $this->belongsToMany('App\User');
    }
}
