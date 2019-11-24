<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyConferencesAttended extends Model
{
    protected $table = 'faculty_conferences_attended';

    protected $fillable = [
        'user_id', 'type', 'title', 'venue', 'date',
    ];
}
