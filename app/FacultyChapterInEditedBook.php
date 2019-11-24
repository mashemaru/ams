<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyChapterInEditedBook extends Model
{
    protected $table = 'faculty_chapter_in_edited_book';

    protected $fillable = [
        'user_id', 'author', 'title_of_work', 'title_of_book', 'editor', 'publisher', 'place_of_publication', 'date_of_publication', 'pages', 'isbn',
    ];
}
