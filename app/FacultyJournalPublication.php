<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyJournalPublication extends Model
{
    protected $table = 'faculty_journal_publication';

    protected $fillable = [
        'user_id', 'author', 'title', 'journal_name', 'date', 'volume_number', 'issue_number', 'pages', 'type'
    ];
}
