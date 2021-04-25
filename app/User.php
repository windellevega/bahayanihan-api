<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'middlename', 'lastname', 'email_address',
        'username', 'password', 'address', 'current_long',
        'current_lat', 'is_worker', 'profile_picture_url',
        'mobile_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($username)
    {
        return $this->where('username', $username)
                ->orWhere('email_address', $username)->first();
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'user_skills', 'user_id', 'skill_id')
                ->withPivot('years_experience')
                ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function credentials()
    {
        return $this->hasMany('App\Credential');
    }

    public function workerApplications()
    {
        return $this->hasMany('App\WorkerApplication');
    }

    public function conversations() {
        return $this->belongsToMany('App\Conversation', 'user_conversations', 'user_id', 'conversation_id')
                ->withTimestamps();
    }
}
