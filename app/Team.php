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

    public function document_teams()
    {
        return $this->belongsToMany('App\DocumentOutline', 'document_team', 'team_id', 'document_outline_id')->withPivot('accreditation_id');
    }
}
