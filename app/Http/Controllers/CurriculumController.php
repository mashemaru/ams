<?php

namespace App\Http\Controllers;

use App\Curriculum;
use App\Program;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program = Program::all();
        return view('curriculum.create', compact('program'));
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
            'program_id'        => 'required|exists:programs,id',
            'term'              => 'required',
            'start_year'        => 'required|before_or_equal:end_year',
            'end_year'          => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withErrors($validate)->withInput();
        }

        $curriculum = Curriculum::create([
            'program_id'        => $request->program_id,
            'term'              => $request->term,
            'start_year'        => $request->start_year,
            'end_year'          => $request->end_year,
        ]);
        
        $c = [];
        if($request->courses) {
            foreach($request->courses as $key => $courses) {
                foreach($courses as $course) {
                    $c[] = ['course_id' => $course, 'term' => $key];
                }
            }
        }
        
        $curriculum->curriculum_courses()->sync($c);

        return redirect()->route('curriculum.index')->withToastSuccess(__('Curriculum successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function show(Curriculum $curriculum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function edit(Curriculum $curriculum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curriculum $curriculum)
    {
        //
    }

    public function getCurriculumCourses(Request $request, $count)
    {
        if ($request->ajax()) {
            $courses = Course::all();
            $view = view('curriculum.partials.courses', ['courses' => $courses, 'count' => $count])->render();
            return json_encode($view);
        }
    }
}
