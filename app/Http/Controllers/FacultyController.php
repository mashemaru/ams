<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\FacultyExport;
use App\Exports\FacultyAcademicBackgroundExport;
use App\Exports\FacultyEducationalBackgroundExport;
use App\Exports\FacultyProfessionalActivitiesExport;
use App\Exports\FacultyCommunityServiceExport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class FacultyController extends Controller
{
    public function facultyIndex(Request $request)
    {
        if ($request->ajax()) {
            
            $data = User::role('faculty')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    return $data->name;
                })
                ->addColumn('action', function($row){
                    return '<div class="dropdown"><a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><a class="dropdown-item" href="'. route('faculty.show', $row->id) .'">View Profile</a><a class="dropdown-item" href="#" data-toggle="modal" data-target="#otherModal">Remind FIF Update</a></div></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('faculty.index');
    }

    public function facultyShow(User $user)
    {
        $user->with('faculty_academic_background')->get();
        $roles = $user->getRoleNames();
        return view('faculty.show', compact('user','roles'));
    }

    public function facultyProfile()
    {
        auth()->user()->load('faculty_academic_background');
        $roles = auth()->user()->getRoleNames();
        return view('faculty.profile', compact('roles'));
    }

    public function facultyStore(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            '*' =>  'max:255',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
        }

        if($request->has('academic_background')) {
            $user->faculty_academic_background()->create($request->all());
        } else if($request->has('graduate_studies')) {
            $user->faculty_graduate_studies()->create($request->all());
        }  else if($request->has('special_training')) {
            $user->faculty_special_training()->create($request->all());
        }  else if($request->has('teaching_experience_dlsu')) {
            $user->faculty_teaching_experience_dlsu()->create($request->all());
        }  else if($request->has('teaching_experience_other')) {
            $user->faculty_teaching_experience_other()->create($request->all());
        }  else if($request->has('professional_experience')) {
            $user->faculty_professional_experience()->create($request->all());
        }  else if($request->has('professional_practice_dlsu')) {
            $user->faculty_professional_practice_dlsu()->create($request->all());
        }  else if($request->has('professional_practice')) {
            $user->faculty_professional_practice()->create($request->all());
        }  else if($request->has('leadership')) {
            $user->faculty_leadership()->create($request->all());
        }  else if($request->has('membership')) {
            $user->faculty_membership()->create($request->all());
        }  else if($request->has('achievements')) {
            $user->faculty_achievements()->create($request->all());
        }  else if($request->has('internally_funded_research')) {
            $user->faculty_internally_funded_research()->create($request->all());
        }  else if($request->has('externally_funded_research')) {
            $user->faculty_externally_funded_research()->create($request->all());
        }  else if($request->has('research_grants')) {
            $user->faculty_research_grants()->create($request->all());
        }  else if($request->has('journal_publication')) {
            $user->faculty_journal_publication()->create($request->all());
        }  else if($request->has('prototypes')) {
            $user->faculty_prototypes()->create($request->all());
        }  else if($request->has('patents')) {
            $user->faculty_patents()->create($request->all());
        }  else if($request->has('books_and_textbooks')) {
            $user->faculty_books_and_textbooks()->create($request->all());
        }  else if($request->has('chapter_in_edited_book')) {
            $user->faculty_chapter_in_edited_book()->create($request->all());
        }  else if($request->has('conference_proceedings_papers')) {
            $user->faculty_conference_proceedings_papers()->create($request->all());
        }  else if($request->has('published_creative_work')) {
            $user->faculty_published_creative_work()->create($request->all());
        }  else if($request->has('creative_work_performed')) {
            $user->faculty_creative_work_performed()->create($request->all());
        }  else if($request->has('programs_developeds')) {
            $user->faculty_programs_developeds()->create($request->all());
        }  else if($request->has('other_research_outputs')) {
            $user->faculty_other_research_outputs()->create($request->all());
        }  else if($request->has('conferences_attended')) {
            $user->faculty_conferences_attended()->create($request->all());
        }  else if($request->has('community_service_dlsu')) {
            $user->faculty_community_service_dlsu()->create($request->all());
        }  else if($request->has('community_service_professional')) {
            $user->faculty_community_service_professional()->create($request->all());
        }  else if($request->has('community_service_government')) {
            $user->faculty_community_service_government()->create($request->all());
        }  else if($request->has('community_service_others')) {
            $user->faculty_community_service_others()->create($request->all());
        }
        
        return back()->withToastSuccess(__('Faculty Profile successfully updated.'));
    }

    function exportFacultyAcademicBackground(User $user)
    {
        $user->with('faculty_academic_background','faculty_graduate_studies','faculty_special_training')->get();
        return Excel::download(new FacultyAcademicBackgroundExport($user), str_slug($user->name).'-AcademicBackground-' . time() . '.xlsx');
    }

    function exportFacultyEducationalBackgroundExport(User $user)
    {
        $user->with('faculty_teaching_experience_dlsu','faculty_teaching_experience_other','faculty_professional_experience','faculty_professional_practice_dlsu','faculty_professional_practice')->get();
        return Excel::download(new FacultyEducationalBackgroundExport($user), str_slug($user->name).'-EducationalExperience-' . time() . '.xlsx');
    }
    
    function exportFacultyProfessionalActivitiesExport(User $user)
    {
        $user->with('faculty_leadership','faculty_membership','faculty_achievements','faculty_internally_funded_research','faculty_externally_funded_research',
        'faculty_research_grants','faculty_journal_publication','faculty_prototypes','faculty_patents','faculty_books_and_textbooks','faculty_chapter_in_edited_book',
        'faculty_conference_proceedings_papers','faculty_published_creative_work','faculty_creative_work_performed','faculty_programs_developeds','faculty_other_research_outputs','faculty_conferences_attended')->get();
        return Excel::download(new FacultyProfessionalActivitiesExport($user), str_slug($user->name).'-ProfessionalActivities-' . time() . '.xlsx');
    }
    
    function exportFacultyCommunityServiceExport(User $user)
    {
        $user->with('faculty_community_service_dlsu','faculty_community_service_professional','faculty_community_service_government','faculty_community_service_others')->get();
        return Excel::download(new FacultyCommunityServiceExport($user), str_slug($user->name).'-CommunityService-' . time() . '.xlsx');
    }
    
    function exportFaculty(User $user)
    {
        $user->with('faculty_community_service_dlsu')->get();
        return (new FacultyExport($user))->download(str_slug($user->name).'-FacultyInformation-' . time() . '.xlsx');
        // return Excel::download(new FacultyCommunityServiceExport($user), str_slug($user->name).'-CommunityService-' . time() . '.xlsx');
    }
    
    function facultySearch(Request $request)
    {
        $users = User::role('faculty');
        $teaching_experience = array();

        if ($request->has('query')) {
            if($request->get('query') == 'teaching_experience') {
                $teaching_experience = $users->select("users.rank",
                \DB::raw('(SELECT SUM(years) FROM faculty_teaching_experience_dlsu WHERE faculty_teaching_experience_dlsu.user_id = users.id) as faculty_experience_dlsu'),
                \DB::raw('(SELECT SUM(years) FROM faculty_teaching_experience_other WHERE faculty_teaching_experience_other.user_id = users.id) as faculty_experience_other'))
                ->get()
                ->groupBy('rank')
                ->toArray();
            }
            // dd($teaching_experience);
        }

        // $users = User::role('faculty')->paginate(15);
        return view('faculty.search', compact('teaching_experience'));
    }
}
