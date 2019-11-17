<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentOutline extends Model
{
    protected $table = 'document_outline';

    protected $fillable = [
        'document_id', 'parent_id', 'root_parent_id', 'section', 'body', 'score', 'reference', 'doc_type', 'score_type',
    ];

    public function document()
    {
        return $this->belongsTo('App\Document', 'document_id');
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
        return $this->belongsToMany('App\FileRepository', 'appendix_exhibit', 'document_outline_id', 'file_id');
    }

    public function scopeRootParent($query)
    {
        return $query->where('parent_id', 0);
    }
}
