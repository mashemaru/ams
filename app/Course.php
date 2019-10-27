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

    public function scopeHardPrerequisite($query)
    {
        return $query->where('requisite', 'hard');
    }

    public function scopeSoftPrerequisite($query)
    {
        return $query->where('requisite', 'soft');
    }

    public function scopeCoRequisite($query)
    {
        return $query->where('requisite', 'co');
    }

    public function courseHardPreq()
    {
        return $this->requisites()->hardPrerequisite();
    }

    public function courseSoftPreq()
    {
        return $this->requisites()->softPrerequisite();
    }

    public function courseCoReq()
    {
        return $this->requisites()->coRequisite();
    }

    public function requisites()
    {
        return $this->belongsToMany('App\Course', 'course_requisites', 'course_id', 'requisite_id');
    }
}
