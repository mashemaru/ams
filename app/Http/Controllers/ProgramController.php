<?php

namespace App\Http\Controllers;

use App\Program;
use App\ScoringType;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Program $program)
    {
        return view('program.index', ['programs' => $program->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'program_name' => 'required|min:4',
            'program_code' => 'required',
        ]);

        Program::create($validate);

        return redirect()->route('program.index')->withToastSuccess(__('Program successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $program = Program::with('score_types')->firstOrFail();
        $scoringType = ScoringType::all();
        return view('program.edit', compact('program','scoringType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validate = $request->validate([
            'program_name' => 'required|min:4',
            'program_code' => 'required',
        ]);

        $program->score_types()->sync($request->scoring_type);
        $program->update($validate);

        return redirect()->route('program.index')->withToastSuccess(__('Program successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('program.index')->withToastSuccess(__('Program successfully deleted.'));
    }
}
