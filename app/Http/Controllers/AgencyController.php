<?php

namespace App\Http\Controllers;

use App\Agency;
use App\ScoringType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validate = Validator::make($request->all(), [
            'agency_name' => 'required|min:4',
            'agency_code' => 'required|min:4',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        $agency = Agency::create([
            'agency_name' => $request->agency_name,
            'agency_code' => $request->agency_code,
        ]);
    
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
    public function edit(Agency $agency)
    {
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
        $validate = Validator::make($request->all(), [
            'agency_name' => 'required|min:4',
            'agency_code' => 'required|min:4',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        $agency->score_types()->sync($request->scoring_type);
        $agency->update([
            'agency_name' => $request->agency_name,
            'agency_code' => $request->agency_code,
        ]);

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

    public function get_agency_scoring(Agency $agency)
    {
        $scores = [];
        foreach($agency->score_types as $score) {
            $scores[] = [
                'id'    => $score->id,
                'name'  => $score->scoring_name,
            ];
        }
        return response()->json($scores);
    }

    public function get_agency_document(Agency $agency)
    {
        $documents = [];
        foreach($agency->document as $document) {
            $documents[] = [
                'id'    => $document->id,
                'name'  => $document->document_name,
            ];
        }
        return response()->json($documents);
    }
}
