<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\FacultyAcademicBackgroundExport;
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
        if($request->has('academic_background')) {
            $validate = Validator::make($request->all(), [
                'degrees_earned'            => 'max:255',
                'title_of_degree'           => 'max:255',
                'area_of_specialization'    => 'max:255',
                'year_obtained'             => 'max:255',
                'educational_institution'   => 'max:255',
                'location'                  => 'max:255',
                'so_number'                 => 'max:255',
            ]);
    
            if ($validate->fails()) {
                return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
            }

            $user->faculty_academic_background()->create([
                'degrees_earned'            => $request->degrees_earned,
                'title_of_degree'           => $request->title_of_degree,
                'area_of_specialization'    => $request->area_of_specialization,
                'year_obtained'             => $request->year_obtained,
                'educational_institution'   => $request->educational_institution,
                'location'                  => $request->location,
                'so_number'                 => $request->so_number,
            ]);
        }
        return back()->withToastSuccess(__('Faculty Profile successfully updated.'));
    }

    function exportFacultyAcademicBackground(User $user)
    {
        $user->with('faculty_academic_background')->get();
        return Excel::download(new FacultyAcademicBackgroundExport($user), str_slug($user->name).'-AcademicBackground-' . time() . '.xlsx');
    }
}
