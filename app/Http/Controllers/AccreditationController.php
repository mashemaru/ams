<?php

namespace App\Http\Controllers;

use App\Accreditation;
use App\Agency;
use App\Program;
use App\Document;
use App\DocumentTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccreditationController extends Controller
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
        $agency = Agency::select('id','agency_name')->get();
        $program = Program::select('id','program_name')->get();

        return view('accreditation.create',compact('agency','program'));
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
            'agency_id'              => 'required|exists:agencies,id',
            'program_id'             => 'required|exists:programs,id',
            'document_id'            => 'required|exists:documents,id',
            'type'                   => 'required',
            'report_submission_date' => 'required|date_format:Y-m-d|after:now',
            'onsite_visit_date'      => 'required|date_format:Y-m-d|after:now',
        ]);

        if ($validate->fails()) {
            $agency = Agency::findOrFail($request->agency_id);
            $documents = [];
            foreach($agency->document as $document) {
                $documents[] = [
                    'id'    => $document->id,
                    'name'  => $document->document_name,
                ];
            }
            return back()->with('error', $validate->messages())->withInput()->with('document', json_encode($documents));
        }

        $accreditation = Accreditation::create([
            'agency_id'              => $request->agency_id,
            'program_id'             => $request->program_id,
            'document_id'            => $request->document_id,
            'type'                   => $request->type,
            'report_submission_date' => $request->report_submission_date,
            'onsite_visit_date'      => $request->onsite_visit_date,
        ]);

        return redirect()->route('accreditation.create')->withToastSuccess(__('Accreditation successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function show(Accreditation $accreditation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accreditation $accreditation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accreditation $accreditation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accreditation $accreditation)
    {
        //
    }

    public function assign_team(Accreditation $accreditation)
    {
        // DocumentTeam::
    }
}
