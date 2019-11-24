<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyProgramsDeveloped extends Model
{
    protected $table = 'faculty_programs_developeds';

    protected $fillable = [
        'user_id', 'author', 'title', 'remarks', 'date',
    ];
}
