<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyProfessionalPracticeDlsu extends Model
{
    protected $table = 'faculty_professional_practice_dlsu';

    protected $fillable = [
        'user_id', 'position', 'college', 'years', 'inclusive_dates',
    ];
}
