<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyBooksAndTextbooks extends Model
{
    protected $table = 'faculty_books_and_textbooks';

    protected $fillable = [
        'user_id', 'author', 'title', 'publisher', 'place_of_publication', 'date_of_publication', 'isbn',
    ];
}
