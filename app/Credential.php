<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = [
        'user_skill_id', 'credential_details',
    ];

    public function userSkill()
    {
        return $this->belongsTo('App\User');
    }
}
