<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill_name', 'skill_rate',
    ];

    public function UserSkill()
    {
        return $this->belongsTo('App\UserSkill');
    }
}
