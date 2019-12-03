<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentOutline extends Model
{
    protected $table = 'document_outline';

    protected $fillable = [
        'document_id', 'accred_id', 'parent_id', 'root_parent_id', 'section', 'body', 'score', 'reference', 'doc_type', 'score_type',
    ];

    public function document()
    {
        return $this->belongsTo('App\Document', 'document_id');
    }
    
    public function accreditation()
    {
        return $this->belongsTo('App\Accreditation', 'accred_id');
    }

    public function scoring_type()
    {
        return $this->belongsTo('App\ScoringType', 'score_type');
    }

    public function comments()
    {
        return $this->hasMany('App\OutlineComment', 'outline_id');
    }

    public function appendix_exhibit()
    {
        return $this->belongsToMany('App\AppendixExhibit', 'document_outline_appendix_exhibits', 'document_outline_id', 'appendix_exhibits_id');
    }

    public function scopeRootParent($query)
    {
        return $query->where('parent_id', 0);
    }
}
