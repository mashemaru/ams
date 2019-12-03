<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppendixExhibit extends Model
{
    protected $table = 'appendix_exhibits';

    protected $fillable = [
        'name', 'code', 'type', 'evidence_complete',
    ];

    protected $casts = [
        'evidence_complete' => 'boolean',
    ];

    public function evidences()
    {
        return $this->belongsToMany('App\FileRepository', 'appendix_exhibits_evidence', 'appendix_exhibit_id', 'evidence_id');
    }

    public function document_outlines()
    {
        return $this->belongsToMany('App\DocumentOutline', 'document_outline_appendix_exhibits', 'appendix_exhibits_id', 'document_outline_id');
    }
}
