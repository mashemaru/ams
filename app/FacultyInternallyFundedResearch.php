<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyInternallyFundedResearch extends Model
{
    protected $table = 'faculty_internally_funded_research';

    protected $fillable = [
        'user_id', 'research_project', 'funding_agency', 'grant_amount', 'inclusive_years',
    ];
}
