<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvidenceList extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function appendix_exhibit()
    {
        return $this->belongsToMany('App\AppendixExhibit', 'evidence_lists_appendix_exhibit', 'evidence_lists_id', 'appendix_exhibit_id');
    }
}
