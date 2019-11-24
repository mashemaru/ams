<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCommunityServiceDlsu extends Model
{
    protected $table = 'faculty_community_service_dlsu';

    protected $fillable = [
        'user_id', 'service_description', 'service_unit', 'inclusive_dates',
    ];
}
