<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyOtherResearchOutputs extends Model
{
    protected $table = 'faculty_other_research_outputs';

    protected $fillable = [
        'user_id', 'author', 'title', 'type', 'date', 'remarks',
    ];
}
