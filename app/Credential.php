<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = [
        'user_skill_id', 'credential_details',
    ];

    public function UserSkill()
    {
        return $this->belongsTo('App\UserSkill');
    }
}
