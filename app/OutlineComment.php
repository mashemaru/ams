<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutlineComment extends Model
{
    protected $fillable = [
        'outline_id', 'user_id', 'comment', 'resolved_by', 'resolved',
    ];

    protected $dates = ['resolved'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function resolved_user()
    {
        return $this->belongsTo('App\User', 'resolved_by');
    }

    public function outline()
    {
        return $this->belongsTo('App\DocumentOutline', 'outline_id');
    }
}
