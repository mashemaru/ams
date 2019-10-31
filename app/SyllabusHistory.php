<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyllabusHistory extends Model
{
    protected $fillable = [
        'syllabus', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
}
