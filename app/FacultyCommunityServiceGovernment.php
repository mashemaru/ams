<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCommunityServiceGovernment extends Model
{
    protected $table = 'faculty_community_service_government';

    protected $fillable = [
        'user_id', 'service_description', 'government_organization', 'project_site', 'inclulsive_dates',
    ];
}
