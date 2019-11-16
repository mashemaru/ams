<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileRepository extends Model
{
    protected $fillable = [
        'user_id', 'file_name', 'file_type', 'file', 'directory', 'reference', 'reference_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
