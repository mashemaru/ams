<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyAchievements extends Model
{
    protected $table = 'faculty_achievements';

    protected $fillable = [
        'user_id', 'achievement_received', 'awarding_body', 'date',
    ];
}
