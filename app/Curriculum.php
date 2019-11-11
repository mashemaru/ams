<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculum';

    protected $fillable = [
        'program_id', 'term', 'start_year', 'end_year',
    ];

    public function curriculum_courses()
    {
        return $this->belongsToMany('App\Curriculum', 'curriculum_courses', 'curriculum_id')->withPivot('term');
    }

    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'curriculum_courses', 'curriculum_id', 'course_id')->withPivot('term');
    }
}
