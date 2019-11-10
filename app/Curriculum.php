<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculum';

    protected $fillable = [
        'program_id', 'term', 'start_year', 'end_year',
    ];

    protected $casts = [
        'start_year' => 'date:Y',
        'end_year'   => 'date:Y',
    ];

    protected $dates = ['start_year', 'end_year'];

    public function curriculum_courses()
    {
        return $this->belongsToMany('App\CurriculumCourse', 'curriculum_courses', 'curriculum_id', 'course_id');
    }
}
