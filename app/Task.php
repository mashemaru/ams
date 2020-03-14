<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name', 'assigner', 'asigned_to', 'due_date', 'priority', 'status', 'remarks', 'recurring', 'recurring_freq', 'recurring_date',
    ];

    protected $casts = [
        'recurring'   => 'boolean',
    ];

    protected $dates = [
        'due_date',
        'recurring_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'asigned_to');
    }
}
