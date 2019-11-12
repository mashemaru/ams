<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumCourse extends Model
{
    protected $table = 'curriculum_courses';

    protected $fillable = [
        'curriculum_id', 'course_id', 'term',
    ];

    public function curriculum()
    {
        return $this->belongsTo('App\Curriculum', 'curriculum_id');
    }
}
