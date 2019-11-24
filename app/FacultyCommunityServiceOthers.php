<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCommunityServiceOthers extends Model
{
    protected $table = 'faculty_community_service_others';

    protected $fillable = [
        'user_id', 'service_description', 'other_organization', 'project_site', 'inclulsive_dates',
    ];
}
