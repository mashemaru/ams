<?php

namespace App\Http\Controllers;

use App\ScoringType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScoringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScoringType $scoring)
    {
        return view('scoring.index', ['scoring_type' => $scoring->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scoring.create');
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
            'scoring_name'          => 'required|min:4',
            'scoring_description'   => 'nullable',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        ScoringType::create([
            'scoring_name'          => $request->scoring_name,
            'scoring_description'   => $request->scoring_description,
            'scores'                => $request->scoring,
        ]);

        return redirect()->route('scoring.index')->withToastSuccess(__('Scoring Type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function show(ScoringType $scoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoringType $scoring)
    {
        return view('scoring.edit', compact('scoring'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoringType $scoring)
    {
        $validate = Validator::make($request->all(), [
            'scoring_name'          => 'required|min:4',
            'scoring_description'   => 'nullable',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        $scoring->update([
            'scoring_name'          => $request->scoring_name,
            'scoring_description'   => $request->scoring_description,
            'scores'                => $request->scoring,
        ]);

        return redirect()->route('scoring.index')->withToastSuccess(__('Scoring Type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoringType $scoring)
    {
        $scoring->delete();

        return back()->withToastSuccess(__('Scoring Type successfully deleted.'));
    }
}
