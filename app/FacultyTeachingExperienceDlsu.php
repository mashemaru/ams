<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyTeachingExperienceDlsu extends Model
{
    protected $table = 'faculty_teaching_experience_dlsu';

    protected $fillable = [
        'user_id', 'level', 'years', 'inclusive_dates',
    ];
}
