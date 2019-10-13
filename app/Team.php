<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team_name', 'team_head',
    ];

    public function head()
    {
        return $this->belongsTo('App\User', 'team_head');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_team', 'team_id', 'user_id');
    }

    public function accreditations()
    {
        return $this->belongsToMany('App\Accreditation', 'accreditation_team', 'team_id', 'accreditation_id');
    }
}
