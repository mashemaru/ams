<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function team_head()
    {
        return $this->hasMany('App\Team', 'team_head');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'user_team', 'user_id', 'team_id');
    }

    public function comments()
    {
        return $this->hasMany('App\OutlineComment', 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_faculty', 'user_id', 'course_id');
    }
}