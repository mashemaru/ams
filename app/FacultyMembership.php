<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyMembership extends Model
{
    protected $table = 'faculty_membership';

    protected $fillable = [
        'user_id', 'role', 'professional_organization', 'inclusive_years',
    ];
}
