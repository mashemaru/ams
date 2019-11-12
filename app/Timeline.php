<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'accreditation_id', 'task', 'status', 'is_complete',
    ];

    protected $casts = [
        'task'          => 'array',
        'status'        => 'decimal:2',
        'is_complete'   => 'boolean',
    ];

    public function accreditation()
    {
        return $this->belongsTo('App\Accreditation', 'accreditation_id');
    }
}
