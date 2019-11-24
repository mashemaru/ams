<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyConferenceProceedingsPapers extends Model
{
    protected $table = 'faculty_conference_proceedings_papers';

    protected $fillable = [
        'user_id', 'paper_authors', 'paper_title', 'conference_proceedings', 'paper_publisher', 'publication_place', 'pages', 'isbn',
    ];
}
