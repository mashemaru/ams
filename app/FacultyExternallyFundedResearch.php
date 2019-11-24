<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyExternallyFundedResearch extends Model
{
    protected $table = 'faculty_externally_funded_research';

    protected $fillable = [
        'user_id', 'research_project', 'funding_agency', 'grant_currency', 'grant_amount', 'inclusive_years',
    ];
}
