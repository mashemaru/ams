<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $fillable = [
        'agency_id', 'program_id', 'document_id', 'type', 'status', 'result', 'progress', 'completed_document', 'recommendations', 'evidence_list', 'end_date', 'report_submission_date', 'onsite_visit_date',
    ];

    protected $dates = ['end_date', 'report_submission_date', 'onsite_visit_date'];

    protected $casts = [
        'recommendations'   => 'array',
        'evidence_list'     => 'array',
        'status'            => 'decimal:2',
    ];

    public function agency()
    {
        return $this->hasOne('App\Agency', 'id', 'agency_id');
    }

    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function document()
    {
        return $this->hasOne('App\Document', 'id', 'document_id');
    }

    public function timeline()
    {
        return $this->hasOne('App\Timeline');
    }

    public function accreditation_teams()
    {
        return $this->belongsToMany('App\Accreditation', 'accreditation_team', 'accreditation_id', 'team_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'accreditation_team', 'accreditation_id', 'team_id');
    }

    public function document_teams()
    {
        return $this->belongsToMany('App\DocumentOutline', 'document_team', 'accreditation_id', 'document_outline_id')->withPivot('team_id', 'document_id');
    }

    public function outlines()
    {
        return $this->hasMany('App\DocumentOutline', 'accred_id');
    }

    public function appendix_exhibit()
    {
        return $this->belongsToMany('App\AppendixExhibit', 'document_outline_appendix_exhibits', 'accreditation_id', 'appendix_exhibits_id');
    }

    public function getEvidenceCanUploadAttribute()
    {
        return $this->evidence_complete;
    }

    public function recommendations_appendix_exhibits()
    {
        return $this->belongsToMany('App\AppendixExhibit', 'recommendations_appendix_exhibits', 'accreditation_id', 'appendix_exhibits_id');
    }
}
