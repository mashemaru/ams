<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'agency_id', 'document_name', 'sections',
    ];

    protected $casts = [
        'sections' => 'array',
    ];

    public function outlines()
    {
        return $this->hasMany('App\DocumentOutline', 'document_id');
    }

    public function saveChildrenRecursively($sub, $parent) 
    {
        if (isset($sub->children)) {
            foreach ($sub->children as $c) {
                dd($c->score);
                $root = $this->outlines()->create([
                    'parent_id'     => $parent->id,
                    'section'       => $c->section,
                    'score_type'    => isset($c->score) ?: 1,
                ]);
                $this->saveChildrenRecursively($c, $root);
            }
        }
    }
}
