<?php

namespace App\Http\Controllers;

use App\ScoringType;
use Illuminate\Http\Request;

class ScoringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScoringType $scoring_type)
    {
        return view('scoring.index', ['scoring_type' => $scoring_type->paginate(15)]);
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
        $validate = $request->validate([
            'scoring_name' => 'required|min:4',
        ]);
        $validate['scoring_description'] = $request->scoring_description;
        $validate['scores'] = $request->scoring;

        ScoringType::create($validate);

        return redirect()->route('scoring.index')->withToastSuccess(__('Scoring Type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function show(ScoringType $scoringType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoringType $scoringType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoringType $scoringType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScoringType  $scoringType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoringType $scoringType)
    {
        //
    }
}
