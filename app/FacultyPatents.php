<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyPatents extends Model
{
    protected $table = 'faculty_patents';

    protected $fillable = [
        'user_id', 'author', 'title', 'date', 'issuing_country', 'patent_number',
    ];
}
