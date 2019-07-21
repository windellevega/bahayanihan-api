<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $fillable = [
        'user_id', 'skill_id', 'years_experience',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Skills()
    {
        return $this->belongsTo('App\Skill', 'skill_id');
    }

    public function Credentials()
    {
        return $this->hasMany('App\Credential');
    }
}
