<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill_name', 'skill_rate', 'picture_url'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
                ->withTimestamps();
    }
}
