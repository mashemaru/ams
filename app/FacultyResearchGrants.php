<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyResearchGrants extends Model
{
    protected $table = 'faculty_research_grants';

    protected $fillable = [
        'user_id', 'research_project', 'funding_agency', 'inclusive_years',
    ];
}
