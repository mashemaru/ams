<?php

namespace App\Http\Controllers;

use App\Accreditation;
use App\Agency;
use App\Program;
use App\Team;
use App\Timeline;
use App\FileRepository;
use App\Document;
use App\DocumentTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Accreditation $accreditation)
    {
        $accreditation->with('agency','program','document','timeline')->get();
        return view('accreditation.index', ['accreditations' => $accreditation->paginate(15)]);
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
            'onsite_visit_date'      => 'required|date_format:Y-m-d|after:report_submission_date',
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

        return redirect()->route('timeline.view', $accreditation)->withToastSuccess(__('Accreditation successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function show(Accreditation $accreditation)
    {
        $accreditation->with('agency','program','document','teams','teams.head','teams.users')->get();
        return view('accreditation.show', compact('accreditation'));
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
        $accreditation->delete();

        return redirect()->route('accreditation.index')->withToastSuccess(__('Accreditation successfully deleted.'));
    }

    public function assign_team(Accreditation $accreditation)
    {
        $allTeams = Team::all();
        $accreditation->with('agency','teams','program','document','document.outline_root')->get();
        return view('team.assign',compact('accreditation','allTeams'));
    }

    public function generateDocument(Accreditation $accreditation)
    {
        $accreditation->with('agency','program','document','document.outlines')->get();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        foreach($accreditation->document->outlines as $outline) {
            $section = $phpWord->addSection();
            $section->addText($outline->section,array('name'=>'Arial','size' => (($outline->parent_id == 0) ? 24 : 20),'bold' => true));
    
            $html = str_replace('<table class="table table-bordered">','<table style="width: 100%; border: 4px #000000 single;">',$outline->body);
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        if(!Storage::exists('accreditation/'. $accreditation->id)) {
            Storage::makeDirectory('accreditation/'. $accreditation->id);
        }
        $objWriter->save(storage_path('app/accreditation/'. $accreditation->id . '/' . $accreditation->agency->agency_code . '-' . $accreditation->program->program_code . '-' . $accreditation->created_at->format('Y') . '.docx'));

        FileRepository::create([
            'user_id'       => auth()->user()->id,
            'file_name'     => $accreditation->agency->agency_code . '-' . $accreditation->program->program_code . '-' . $accreditation->created_at->format('Y') . '.docx',
            'file_type'     => 'generated-document',
            'file'          => $accreditation->agency->agency_code . '-' . $accreditation->program->program_code . '-' . $accreditation->created_at->format('Y') . '.docx',
            'directory'     => 'accreditation/'. $accreditation->id . '/' . $accreditation->agency->agency_code . '-' . $accreditation->program->program_code . '-' . $accreditation->created_at->format('Y') . '.docx',
            'reference'     => 'Accreditation',
            'reference_id'  => $accreditation->id,
        ]);
        return response()->download(storage_path('app/accreditation/'. $accreditation->id . '/' . $accreditation->agency->agency_code . '-' . $accreditation->program->program_code . '-' . $accreditation->created_at->format('Y') . '.docx'));
    }

    public function showCompleteAccreditation(Timeline $timeline)
    {
        return view('accreditation.complete',compact('timeline'));
    }

    public function completeAccreditation(Request $request, Timeline $timeline)
    {
        $timeline->with('accreditation')->get();

        $validate = Validator::make($request->all(), [
            'accreditation_result' => 'required|min:2',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        $timeline->update([
            'is_complete' => true
        ]);

        $filename = '';
        if($request->hasFile('complete_document')) {
            $filename = $request->complete_document->getClientOriginalName();

            while(Storage::exists('accreditation/' . $timeline->accreditation->id . '/' . $filename)) {
                $filename = '(1)' . $filename;
            }
            $request->file('complete_document')->storeAs('accreditation/' . $timeline->accreditation->id, $filename);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $filename,
                'file_type'     => 'completed-document',
                'file'          => $filename,
                'directory'     => 'accreditation/' . $timeline->accreditation->id . '/' . $filename,
                'reference'     => 'Timeline',
                'reference_id'  => $timeline->id,
            ]);
        }

        $timeline->accreditation->update([
            'result'                => $request->accreditation_result,
            'recommendations'       => $request->recommendation,
            'completed_document'    => $filename,
            'progress'              => 'completed',
            'end_date'              => now(),
        ]);

        return redirect()->route('accreditation.index')->withToastSuccess(__('Accreditation successfully completed.'));
    }
}
