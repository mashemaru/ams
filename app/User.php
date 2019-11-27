<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'mi', 'surname', 'gender', 'college', 'department', 'college', 'rank', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function team_head()
    {
        return $this->hasMany('App\Team', 'team_head');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'user_team', 'user_id', 'team_id');
    }

    public function comments()
    {
        return $this->hasMany('App\OutlineComment', 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_faculty', 'user_id', 'course_id');
    }

    public function getNameAttribute() {
        return ucfirst($this->firstname) . ' ' . $this->mi . ' ' . ucfirst($this->surname);
    }

    public function faculty_academic_background()
    {
        return $this->hasMany('App\FacultyAcademicBackground', 'user_id');
    }

    public function faculty_graduate_studies()
    {
        return $this->hasMany('App\FacultyGraduateStudies', 'user_id');
    }

    public function faculty_special_training()
    {
        return $this->hasMany('App\FacultySpecialTraining', 'user_id');
    }
    
    public function faculty_teaching_experience_dlsu()
    {
        return $this->hasMany('App\FacultyTeachingExperienceDlsu', 'user_id');
    }

    public function faculty_teaching_experience_other()
    {
        return $this->hasMany('App\FacultyTeachingExperienceOther', 'user_id');
    }
    
    public function faculty_professional_experience()
    {
        return $this->hasMany('App\FacultyProfessionalExperience', 'user_id');
    }

    public function faculty_professional_practice_dlsu()
    {
        return $this->hasMany('App\FacultyProfessionalPracticeDlsu', 'user_id');
    }
    
    public function faculty_professional_practice()
    {
        return $this->hasMany('App\FacultyProfessionalPractice', 'user_id');
    }
    
    public function faculty_leadership()
    {
        return $this->hasMany('App\FacultyLeadership', 'user_id');
    }
    
    public function faculty_membership()
    {
        return $this->hasMany('App\FacultyMembership', 'user_id');
    }
    
    public function faculty_achievements()
    {
        return $this->hasMany('App\FacultyAchievements', 'user_id');
    }
    
    public function faculty_internally_funded_research()
    {
        return $this->hasMany('App\FacultyInternallyFundedResearch', 'user_id');
    }
    
    public function faculty_externally_funded_research()
    {
        return $this->hasMany('App\FacultyExternallyFundedResearch', 'user_id');
    }
    
    public function faculty_research_grants()
    {
        return $this->hasMany('App\FacultyResearchGrants', 'user_id');
    }
    
    public function faculty_journal_publication()
    {
        return $this->hasMany('App\FacultyJournalPublication', 'user_id');
    }
    
    public function faculty_prototypes()
    {
        return $this->hasMany('App\FacultyPrototypes', 'user_id');
    }
    
    public function faculty_patents()
    {
        return $this->hasMany('App\FacultyPatents', 'user_id');
    }

    public function faculty_books_and_textbooks()
    {
        return $this->hasMany('App\FacultyBooksAndTextbooks', 'user_id');
    }
    
    public function faculty_chapter_in_edited_book()
    {
        return $this->hasMany('App\FacultyChapterInEditedBook', 'user_id');
    }
    
    public function faculty_conference_proceedings_papers()
    {
        return $this->hasMany('App\FacultyConferenceProceedingsPapers', 'user_id');
    }
    
    public function faculty_published_creative_work()
    {
        return $this->hasMany('App\FacultyPublishedCreativeWork', 'user_id');
    }
    
    public function faculty_creative_work_performed()
    {
        return $this->hasMany('App\FacultyCreativeWorkPerformed', 'user_id');
    }
    
    public function faculty_programs_developeds()
    {
        return $this->hasMany('App\FacultyProgramsDeveloped', 'user_id');
    }

    public function faculty_other_research_outputs()
    {
        return $this->hasMany('App\FacultyOtherResearchOutputs', 'user_id');
    }
    
    public function faculty_conferences_attended()
    {
        return $this->hasMany('App\FacultyConferencesAttended', 'user_id');
    }
    
    public function faculty_community_service_dlsu()
    {
        return $this->hasMany('App\FacultyCommunityServiceDlsu', 'user_id');
    }
    
    public function faculty_community_service_professional()
    {
        return $this->hasMany('App\FacultyCommunityServiceProfessional', 'user_id');
    }
    
    public function faculty_community_service_government()
    {
        return $this->hasMany('App\FacultyCommunityServiceGovernment', 'user_id');
    }
    
    public function faculty_community_service_others()
    {
        return $this->hasMany('App\FacultyCommunityServiceOthers', 'user_id');
    }
    
}