<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_name',
        'agency_code',
    ];

    public function document()
    {
        return $this->hasMany('App\Document', 'agency_id');
    }

    public function score_types()
    {
        return $this->belongsToMany('App\ScoringType', 'agency_scoring', 'agency_id', 'scoring_id');
    }

    public function accreditation()
    {
        return $this->hasMany('App\Accreditation', 'agency_id');
    }
}
