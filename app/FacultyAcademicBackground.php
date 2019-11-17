<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyAcademicBackground extends Model
{
    protected $table = 'faculty_academic_background';

    protected $fillable = [
        'user_id', 'degrees_earned', 'title_of_degree', 'area_of_specialization', 'year_obtained', 'educational_institution', 'location', 'so_number',
    ];

}
