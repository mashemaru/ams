<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $fillable = [
        'agency_id', 'program_id', 'document_id', 'type', 'result', 'completed_document', 'recommendations', 'report_submission_date', 'onsite_visit_date',
    ];

    protected $dates = ['report_submission_date', 'onsite_visit_date'];

    protected $casts = [
        'recommendations'   => 'array',
    ];

    public function teams()
    {
        return $this->belongsToMany('App\Accreditation', 'accreditation_team', 'accreditation_id', 'team_id');
    }
}
