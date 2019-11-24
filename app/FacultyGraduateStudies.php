<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyGraduateStudies extends Model
{
    protected $table = 'faculty_graduate_studies';

    protected $fillable = [
        'user_id', 'degrees_pursued', 'university', 'stage', 'units_completed', 'inclusive_dates',
    ];
}
