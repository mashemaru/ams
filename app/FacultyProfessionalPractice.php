<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyProfessionalPractice extends Model
{
    protected $table = 'faculty_professional_practice';

    protected $fillable = [
        'user_id', 'practice_nature', 'organization', 'years', 'inclusive_dates',
    ];
}
