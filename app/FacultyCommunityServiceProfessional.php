<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCommunityServiceProfessional extends Model
{
    protected $table = 'faculty_community_service_professional';

    protected $fillable = [
        'user_id', 'service_description', 'professional_organization', 'project_site', 'inclulsive_dates',
    ];
}
