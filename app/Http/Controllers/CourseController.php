<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Notification;
use App\Events\LiveNotification;
use App\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Course $course)
    {
        if ($request->ajax()) {
            $data = $course->with('courseHardPreq','courseSoftPreq','courseCoReq')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('is_academic', function($data){
                    return ($data->is_academic) ? '<span class="badge badge-lg badge-success">Academic</span>' : '<span class="badge badge-lg badge-dark">Non-academic</span>';
                })
                ->addColumn('courseHardPreq', function($data) {
                    $softPreq = '';
                    if($data->courseSoftPreq->isNotEmpty()) {
                        $softPreq = ' (' . $data->courseSoftPreq->map(function($c) {
                            return $c->course_code;
                        })->implode(', ') . ')';
                    }
                    // ($data->courseSoftPreq) ? ' (' . $data->courseSoftPreq->map(function($c) { return $c->course_code; })->implode(', ') . ')' : '';
                    return $data->courseHardPreq->map(function($c) {
                        return $c->course_code;
                    })->implode(', ') . $softPreq;
                })
                // ->addColumn('courseSoftPreq', function($data) {
                //     return $data->courseSoftPreq->map(function($c) {
                //         return $c->course_code;
                //     })->implode(', ');
                // })
                ->addColumn('courseCoReq', function($data) {
                    return $data->courseCoReq->map(function($c) {
                        return $c->course_code;
                    })->implode(', ');
                })
                ->addColumn('action', function($row){
                    return view('course.partials.indexDropdown', ['course' => $row->id]);
                })
                ->rawColumns(['action','is_academic'])
                ->make(true);
        }
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id','course_name')->get();
        $users = User::select('id','firstname','mi','surname')->role('faculty')->get();
        return view('course.create',compact('courses','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'course_name'   => 'required|min:4',
            'course_code'   => 'required',
            'units'         => 'numeric|min:0',
        ], ['units.min'     => 'Units must be a positive number.']);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
        }

        $course = Course::create([
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'college'     => $request->college,
            'course_type' => $request->course_type,
            'is_academic' => ($request->academic) ? true : false,
            'units'       => ($request->units) ? $request->units : 0,
        ]);

        $requisites = array();
        if($request->hardPrerequisite) {
            foreach($request->hardPrerequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'hard'];
            }
        }
        if($request->softPrerequisite) {
            foreach($request->softPrerequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'soft'];
            }
        }
        if($request->coRequisite) {
            foreach($request->coRequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'co'];
            }
        }
        $course->requisites()->detach();
        $course->requisites()->attach($requisites);
        // $course->faculty()->sync($request->faculty_members);

        if($request->hasFile('syllabus')) {
            $filename = $course->course_code . '_syllabus_' .now()->format("m-d-Y-his") .'.'. $request->syllabus->getClientOriginalExtension();

            while(Storage::exists('course/' . $course->course_code . '/' . $filename)) {
                $filename = '(1)' . $filename;
            }
            $request->file('syllabus')->storeAs('course/' . $course->course_code, $filename);
            $course->syllabus = $filename;
            $course->save();

            $course->syllabus_history()->create([
                'syllabus'     => $filename,
                'user_id'      => auth()->user()->id,
            ]);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $request->syllabus->getClientOriginalName(),
                'file_type'     => 'syllabus',
                'file'          => $filename,
                'directory'     => 'course/' . $course->course_code . '/' . $filename,
                'reference'     => 'Course',
                'reference_id'  => $course->id,
            ]);
        }
        return redirect()->route('course.index')->withToastSuccess(__('Course successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->load('courseHardPreq','courseSoftPreq','courseCoReq','faculty','syllabus_history');

        if($course->course_type == 'general') {
            $course->course_type = 'General';
        } else if($course->course_type == 'major') {
            $course->course_type = 'Major';
        } else if($course->course_type == 'professional') {
            $course->course_type = 'Professional elective';
        } else if($course->course_type == 'free') {
            $course->course_type = 'Free elective';
        } else if($course->course_type == 'core') {
            $course->course_type = 'Core subject';
        }

        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $course->load('courseHardPreq','courseSoftPreq','courseCoReq','faculty');
        $courses = Course::select('id','course_name')->get()->except($course->id);
        $users = User::select('id','firstname','mi','surname')->role('faculty')->get();
        return view('course.edit', compact('course','courses','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validate = Validator::make($request->all(), [
            'course_name'   => 'required|min:4',
            'course_code'   => 'required',
            'units'         => 'numeric|min:0',
        ], ['units.min'     => 'Units must be a positive number.']);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
        }

        $course->update([
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'college'     => $request->college,
            'course_type' => $request->course_type,
            'is_academic' => ($request->academic) ? true : false,
            'units'       => $request->units,
        ]);

        $requisites = array();
        if($request->hardPrerequisite) {
            foreach($request->hardPrerequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'hard'];
            }
        }
        if($request->softPrerequisite) {
            foreach($request->softPrerequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'soft'];
            }
        }
        if($request->coRequisite) {
            foreach($request->coRequisite as $item) {
                $requisites[] = ['requisite_id' => $item, 'requisite' => 'co'];
            }
        }
        $course->requisites()->detach();
        $course->requisites()->attach($requisites);
        $course->faculty()->sync($request->faculty_members);

        if($request->hasFile('syllabus')) {
            $filename = $course->course_code . '_syllabus_' .now()->format("m-d-Y-his") .'.'. $request->syllabus->getClientOriginalExtension();

            while(Storage::exists('course/' . $course->course_code . '/' . $filename)) {
                $filename = '(1)' . $filename;
            }
            $request->file('syllabus')->storeAs('course/' . $course->course_code, $filename);
            $course->syllabus = $filename;
            $course->save();

            $course->syllabus_history()->create([
                'syllabus'     => $filename,
                'user_id'      => auth()->user()->id,
            ]);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $request->syllabus->getClientOriginalName(),
                'file_type'     => 'syllabus',
                'file'          => $filename,
                'directory'     => 'course/' . $course->course_code . '/' . $filename,
                'reference'     => 'Course',
                'reference_id'  => $course->id,
            ]);
        }

        return redirect()->route('course.index')->withToastSuccess(__('Course successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return back()->withToastSuccess(__('Course successfully deleted.'));
    }

    public function updateSyllabus(Request $request, Course $course)
    {
        if($request->hasFile('syllabus')) {
            $filename = $course->course_code . '_syllabus_' .now()->format("m-d-Y-his") .'.'. $request->syllabus->getClientOriginalExtension();

            while(Storage::exists('course/' . $course->course_code . '/' . $filename)) {
                $filename = '(1)' . $filename;
            }
            $request->file('syllabus')->storeAs('course/' . $course->course_code, $filename);
            $course->syllabus = $filename;
            $course->save();

            $course->syllabus_history()->create([
                'syllabus'     => $filename,
                'user_id'      => auth()->user()->id,
            ]);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $request->syllabus->getClientOriginalName(),
                'file_type'     => 'syllabus',
                'file'          => $filename,
                'directory'     => 'course/' . $course->course_code . '/' . $filename,
                'reference'     => 'Course',
                'reference_id'  => $course->id,
            ]);
        }
        return back()->withToastSuccess(__('Syllabus successfully updated.'));
    }

    public function downloadSyllabus(Request $request, Course $course)
    {
        return response()->download(storage_path('app/course/' . $course->course_code . '/' . $course->syllabus));
    }

    function courseSearch(Request $request)
    {
        $courses = Course::query();

        $college = Course::select('college')->distinct()->get();

        if ($request->filled('course_type')) {
            $courses->where('course_type', $request->get('course_type'));
        }
    
        if ($request->filled('college')) {
            $courses->where('college', $request->get('college'));
        }

        return view('course.search', ['college' => $college, 'courses' => $courses->paginate(10) ]);
    }

    public function courseSearchDownload(Request $request)
    {
        $courses = Course::query();

        if ($request->filled('course_type')) {
            $courses->where('course_type', $request->course_type);
        }
    
        if ($request->filled('college')) {
            $courses->where('college', $request->college);
        }
        $pdf = \PDF::loadView('course.partials.download', ['courses' => $courses->get()]);
        return $pdf->download(now()->format("m-d-Y-his") . '_course-search-result.pdf');
    }

    public function courseRemind(Course $course)
    {
        $course->load('faculty');
        if($course->faculty) {
            foreach($course->faculty as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'text'    => 'Update <strong>Course ('.$course->course_code.') Syllabus</strong>',
                ]);
                event(new LiveNotification('Update Course ('.$course->course_code.') Syllabus',$user->id));
            }
        }
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function allCourseRemind()
    {
        $courses = Course::with('faculty')->get();
        $users = User::role('department-secretary')->get();

        foreach($courses as $course) {
            if(!$course->faculty->isEmpty()) {
                foreach($course->faculty as $user) {
                    Notification::create([
                        'user_id' => $user->id,
                        'text'    => 'Update <strong>Course ('.$course->course_code.') Syllabus</strong>',
                    ]);
                    event(new LiveNotification('Update Course ('.$course->course_code.') Syllabus',$user->id));
                }
            } else {
                foreach($users as $secretary) {
                    Notification::create([
                        'user_id' => $secretary->id,
                        'text'    => 'Update <strong>Course ('.$course->course_code.') Syllabus</strong>',
                    ]);
                    event(new LiveNotification('Update Course ('.$course->course_code.') Syllabus',$user->id));
                }
            }
        }
        
        return back()->withToastSuccess(__('Action completed successfully.'));
    }
}
