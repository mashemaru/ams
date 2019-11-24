<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCreativeWorkPerformed extends Model
{
    protected $table = 'faculty_creative_work_performed';

    protected $fillable = [
        'user_id', 'author', 'title', 'venue_of_performance_or_presentation', 'date',
    ];
}
