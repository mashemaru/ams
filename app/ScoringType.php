<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoringType extends Model
{
    protected $fillable = [
        'scoring_name', 'scoring_description', 'scores',
    ];

    protected $casts = [
        'scores' => 'array',
    ];

}