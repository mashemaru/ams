<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentOutline extends Model
{
    protected $table = 'document_outline';

    protected $fillable = [
        'document_id', 'parent_id', 'section', 'score_type',
    ];
}
