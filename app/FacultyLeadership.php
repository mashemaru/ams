<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyLeadership extends Model
{
    protected $table = 'faculty_leadership';

    protected $fillable = [
        'user_id', 'role', 'professional_organization', 'inclusive_years',
    ];
}
