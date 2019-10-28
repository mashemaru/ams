<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $course->with('courseHardPreq','courseSoftPreq','courseCoReq')->get();
        return view('course.index', ['courses' => $course->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id','course_name')->get();
        $users = User::select('id','name')->role('faculty')->get();
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
            'course_name' => 'required|min:4',
            'course_code' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
        }

        $course = Course::create([
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'is_academic' => ($request->academic) ? 1 : 0,
            'units'       => $request->units,
        ]);

        $requisites = [];
        if($request->hardPrerequisite) {
            foreach($request->hardPrerequisite as $item) {
                $requisites[$item][] = ['requisite' => 'hard'];
            }
        }
        if($request->softPrerequisite) {
            foreach($request->softPrerequisite as $item) {
                $requisites[$item][] = ['requisite' => 'soft'];
                // $requisites[] = [
                //     $item => ['requisite' => 'soft']
                // ];
            }
        }
        if($request->coRequisite) {
            foreach($request->coRequisite as $item) {
                $requisites[$item][] = ['requisite' => 'co'];
                // $requisites[] = [
                //     $item => ['requisite' => 'co']
                // ];
            }
        }
        // dd(collect($requisites));
        $course->requisites()->sync($requisites);
        $course->faculty()->sync($request->faculty_members);

        if($request->hasFile('syllabus')) {
            $filename = $request->syllabus->getClientOriginalName();
            $exists = Storage::disk('public')->exists('course/' . $course->course_code . '/' . $filename);

            if($exists) {
                $filename = '(1)' . $filename;
            }
            $request->file('syllabus')->storeAs('course/' . $course->course_code, $filename, ['disk' => 'public']);
            $course->syllabus = $filename;
            $course->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}