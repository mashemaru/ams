<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['program_name', 'program_code'];

    public function score_types()
    {
        return $this->belongsToMany('App\ScoringType', 'program_scoring', 'program_id', 'scoring_id');
    }
}