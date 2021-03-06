<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['program_name', 'program_code'];

    public function accreditation()
    {
        return $this->hasMany('App\Accreditation', 'program_id');
    }
}