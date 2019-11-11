<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name', 'course_code', 'syllabus', 'is_academic', 'units',
    ];

    protected $casts = [
        'is_academic' => 'boolean',
        'units'       => 'decimal:2',
    ];

    public function courseHardPreq()
    {
        return $this->requisites()->wherePivot('requisite', 'hard');
    }

    public function courseSoftPreq()
    {
        return $this->requisites()->wherePivot('requisite', 'soft');
    }

    public function courseCoReq()
    {
        return $this->requisites()->wherePivot('requisite', 'co');
    }

    public function requisites()
    {
        return $this->belongsToMany('App\Course', 'course_requisites', 'course_id', 'requisite_id');
    }

    public function faculty()
    {
        return $this->belongsToMany('App\User', 'course_faculty', 'course_id', 'user_id');
    }

    public function syllabus_history()
    {
        return $this->hasMany('App\SyllabusHistory', 'course_id');
    }
}
