<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTeam extends Model
{
    protected $table = 'document_team';

    protected $fillable = [
        'document_id', 'document_outline_id', 'team_id',
    ];
}
