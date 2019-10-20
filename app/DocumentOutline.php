<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentOutline extends Model
{
    protected $table = 'document_outline';

    protected $fillable = [
        'document_id', 'parent_id', 'section', 'body', 'score', 'score_type',
    ];

    public function scoring_type()
    {
        return $this->belongsTo('App\ScoringType', 'score_type');
    }

    public function comments()
    {
        return $this->hasMany('App\OutlineComment', 'outline_id');
    }
}
