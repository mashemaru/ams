<?php

namespace App\Http\Controllers;

use App\Agency;
use App\ScoringType;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Agency $agency)
    {
        return view('agency.index', ['agencies' => $agency->paginate(15)]);
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
            'agency_name' => 'required|min:4',
            'agency_code' => 'required|min:4',
        ]);

        Agency::create($validate);

        return redirect()->route('agency.index')->withToastSuccess(__('Agency successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $agency = Agency::with('score_types')->firstOrFail();
        $scoringType = ScoringType::all();
        return view('agency.edit', compact('agency','scoringType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        $validate = $request->validate([
            'agency_name' => 'required|min:4',
            'agency_code' => 'required|min:4',
        ]);

        $agency->score_types()->sync($request->scoring_type);
        $agency->update($validate);

        return redirect()->route('agency.index')->withToastSuccess(__('Agency successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();

        return redirect()->route('agency.index')->withToastSuccess(__('Agency successfully deleted.'));
    }
}
