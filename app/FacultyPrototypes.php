<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyPrototypes extends Model
{
    protected $table = 'faculty_prototypes';

    protected $fillable = [
        'user_id', 'author', 'title', 'journal_name', 'date', 'volume_number', 'issue_number', 'pages', 'issn_isbn'
    ];
}
