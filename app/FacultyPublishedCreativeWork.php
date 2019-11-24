<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyPublishedCreativeWork extends Model
{
    protected $table = 'faculty_published_creative_work';

    protected $fillable = [
        'user_id', 'author', 'title', 'published_in', 'publisher', 'place_of_publication', 'pages', 'date',
    ];
}
