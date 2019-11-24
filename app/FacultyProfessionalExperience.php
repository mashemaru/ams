<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyProfessionalExperience extends Model
{
    protected $table = 'faculty_professional_experience';

    protected $fillable = [
        'user_id', 'year_passed', 'license_passed', 'license_number', 'validity',
    ];
}
