<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyTeachingExperienceOther extends Model
{
    protected $table = 'faculty_teaching_experience_other';

    protected $fillable = [
        'user_id', 'level', 'school_name', 'inclusive_dates', 'years',
    ];
}
