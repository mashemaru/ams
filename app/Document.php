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

    public function outline_root()
    {
        return $this->outlines()->rootParent();
    }

    public function agency()
    {
        return $this->hasOne('App\Agency', 'id', 'agency_id');
    }

    public function saveChildrenRecursively($sub, $parent, $root_parent_id, $accred_id) 
    {
        if (isset($sub->children)) {
            foreach ($sub->children as $c) {
                $root = $this->outlines()->create([
                    'accred_id'         => $accred_id,
                    'parent_id'         => $parent,
                    'root_parent_id'    => $root_parent_id,
                    'section'           => $c->section,
                    'description'       => isset($c->description) ? $c->description : null,
                    'doc_type'          => isset($c->doc_type) ? $c->doc_type : 'Narrative',
                    'score_type'        => isset($c->score) ? $c->score : 0,
                ]);
                $this->saveChildrenRecursively($c, $root->id, $root_parent_id, $accred_id);
            }
        }
    }

    public function accreditation()
    {
        return $this->hasMany('App\Accreditation', 'document_id');
    }

    public function accreditation_in_progress()
    {
        return $this->hasMany('App\Accreditation', 'document_id')->where('progress','<>','completed');
    }
}
