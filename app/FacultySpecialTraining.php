<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultySpecialTraining extends Model
{
    protected $table = 'faculty_special_training';

    protected $fillable = [
        'user_id', 'training_title', 'organization', 'venue', 'inclusive_dates',
    ];
}
