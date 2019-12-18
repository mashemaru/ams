<?php

namespace App\Http\Controllers;

use App\Accreditation;
use App\Agency;
use App\User;
use App\Program;
use App\Team;
use App\Timeline;
use App\Task;
use App\FileRepository;
use App\Document;
use App\DocumentTeam;
use App\AppendixExhibit;
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
        $accreditation->load('agency','program','document','timeline');
        if(!auth()->user()->hasRole('super-admin')) {
            $accreditation = $accreditation->where('progress','!=','completed')->whereHas('teams', function ($query) {
                $query->whereIn('team_id', auth()->user()->teams->merge(auth()->user()->team_head)->pluck('id')->toArray());
            });
        }

        return view('accreditation.index', ['accreditations' => $accreditation->latest()->paginate(15)]);
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
            // 'document_id'            => 'required|exists:documents,id|unique:accreditations',
            'type'                   => 'required',
            // 'report_submission_date' => 'required|date_format:Y-m-d|after:now',
            // 'onsite_visit_date'      => 'required|date_format:Y-m-d|after:report_submission_date',
        // ], ['document_id.unique'     => 'Document already attached to an existing Accreditation.']);
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
            'progress'               => 'initial',
            // 'report_submission_date' => $request->report_submission_date,
            // 'onsite_visit_date'      => $request->onsite_visit_date,
        ]);

        foreach(json_decode($accreditation->document->sections) as $s) {
            $root = $accreditation->document->outlines()->create([
                'accred_id'         => $accreditation->id,
                'parent_id'         => 0,
                'root_parent_id'    => 0,
                'section'           => $s->section,
                'doc_type'          => isset($s->doc_type) ? $s->doc_type : 'Narrative',
                'score_type'        => isset($s->score) ? $s->score : 0,
            ]);
            if(isset($s->children)) {
                $accreditation->document->saveChildrenRecursively($s, $root->id, $root->id, $accreditation->id);
            }
        }

        if($accreditation->type == 'reaccredit') {
            $result = Accreditation::where('id','!=',$accreditation->id)->where('agency_id', $accreditation->agency_id)->where('program_id', $accreditation->program_id)->latest()->first();
            if($result) {
                $accreditation->update([
                    'recommendations'   =>  $result->recommendations,
                ]);
            } else {
                return view('accreditation.recommendation',compact('accreditation'));
            }
        }

        // return redirect()->route('accreditation.index')->withToastSuccess(__('Accreditation successfully created.'));
        // return redirect()->route('accreditation.evidence_list.create', $accreditation)->withToastSuccess(__('Accreditation successfully created.'));
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
        $accreditation->load('agency','program','document','teams','teams.head','teams.users');
        $team_head = User::has('team_head')->get();
        $users = User::select('id','firstname','mi','surname')->role('member')->get();

        return view('accreditation.show', compact('accreditation','team_head','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accreditation  $accreditation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accreditation $accreditation)
    {
        $agency = Agency::select('id','agency_name')->get();
        $program = Program::select('id','program_name')->get();
        $documents = Document::select('id','document_name')->get();
        return view('accreditation.edit',compact('accreditation','agency','program','documents'));
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
        $accreditation->update([
            'document_id'            => $request->document_id,
            'progress'               => 'formal',
            'report_submission_date' => $request->report_submission_date,
            'onsite_visit_date'      => $request->onsite_visit_date,
        ]);
        return redirect()->route('accreditation.index', $accreditation)->withToastSuccess(__('Accreditation formally started.'));
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
        $accreditation->load('agency','teams.document_teams','program','document','outlines','document_teams');

        return view('team.assign',compact('accreditation','allTeams'));
    }

    public function generateDocument(Accreditation $accreditation)
    {
        $accreditation->load('agency','program','document','document.outlines');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        if ($accreditation->type == 'reaccredit') {
            if($accreditation->recommendations) {
                $output = '<ol>';
                foreach ($accreditation->recommendations as $key => $item) {
                    $output .= '<li>'.$item['label'].'<ul><li>'.$item['answer'].'</li></ul>'.'</li>';
                }
                $output .= '</ol>';
                $section = $phpWord->addSection();
                $section->addText('Recommendations',array('name'=>'Arial','size' => 24,'bold' => true));
                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $output);
            }
        }

        foreach($accreditation->outlines as $outline) {
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
        $timeline->load('accreditation');

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
            // 'recommendations'       => $request->recommendation,
            'completed_document'    => $filename,
            'progress'              => 'completed',
            'end_date'              => now(),
        ]);

        return redirect()->route('accreditation.index')->withToastSuccess(__('Accreditation successfully completed.'));
    }

    public function evidenceComplete(Accreditation $accreditation)
    {
        $accreditation->update([
            'evidence_complete' => true,
        ]);

        return redirect()->route('accreditation.index')->withToastSuccess(__('Evidence successfully completed.'));
    }

    public function showAccreditationRecommendation(Accreditation $accreditation)
    {
        return view('accreditation.recommendation',compact('accreditation'));
    }

    public function accreditationRecommendation(Request $request, Accreditation $accreditation)
    {
        $accreditation->update([
            'recommendations'   =>  $request->recommendation,
        ]);

        if(!$accreditation->timeline) {
            // return redirect()->route('accreditation.evidence_list.create', $accreditation)->withToastSuccess(__('Recommendation successfully updated.'));
            return redirect()->route('timeline.view', $accreditation)->withToastSuccess(__('Recommendation successfully updated.'));
        }

        return redirect()->route('accreditation.index')->withToastSuccess(__('Recommendation successfully updated.'));
    }

    public function showAnswerRecommendation(Accreditation $accreditation)
    {
        return view('accreditation.answer',compact('accreditation'));
    }

    public function answerRecommendation(Request $request, Accreditation $accreditation)
    {
        $accreditation->update([
            'recommendations'   =>  $request->recommendation,
        ]);

        return back()->withToastSuccess(__('Recommendation successfully updated.'));
        // return redirect()->route('accreditation.index')->withToastSuccess(__('Recommendation successfully updated.'));
    }

    public function generateAppendixExhibitList(Accreditation $accreditation)
    {
        $accreditation->load('appendix_exhibit');
        $pdf = \PDF::loadView('accreditation.appendix-exhibits-export', compact('accreditation'));
        return $pdf->download(now()->format("m-d-Y-his") . '_AppendixExhibit-List.pdf');
    }

    public function teamTask(Request $request, Accreditation $accreditation)
    {
        $validate = Validator::make($request->all(), [
            'task_name'     => 'required|max:255',
            'assign_to'     => 'required',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        foreach($request->assign_to as $assign) {
            Task::create([
                'task_name'  => $request->task_name,
                'assigner'   => auth()->user()->id,
                'asigned_to' => $assign,
                'due_date'   => $request->due_date,
                'remarks'    => $request->remarks,
            ]);
        }

        $team = Team::whereIn('team_head', $request->assign_to)->get();
        $accreditation->teams()->syncWithoutDetaching($team);
    
        return back()->withToastSuccess(__('Task successfully created.'));
    }

    public function showEvidenceList(Accreditation $accreditation)
    {
        return view('accreditation.evidence-list.create',compact('accreditation'));
    }

    // public function createEvidenceList(Request $request, Accreditation $accreditation)
    // {
    //     $accreditation->update([
    //         'evidence_list' => $request->evidence_list,
    //     ]);
    //     return redirect()->route('timeline.view', $accreditation)->withToastSuccess(__('Evidence List successfully created.'));
    // }

    // public function updateEvidenceList(Request $request, Accreditation $accreditation)
    // {
    //     $accreditation->update([
    //         'evidence_list' => $request->evidence_list,
    //     ]);
    //     return back()->withToastSuccess(__('Evidence List successfully updated.'));
    // }

    public function accreditationRecommendationEvidenceSelect(Request $request, Accreditation $accreditation)
    {
        if($request->selected) {
            $appendix_exhibit = collect();
            $string = explode(',',$request->selected);

            foreach($string as $item) {    
                $appendix_exhibit->push(['appendix_exhibits_id' => $item, 'accreditation_id' => $accreditation->id]);
            }
        }
        $accreditation->recommendations_appendix_exhibits()->syncWithoutDetaching($appendix_exhibit);
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function accreditationRecommendationEvidenceUpload(Request $request, Accreditation $accreditation)
    {
        $appendix_exhibit = AppendixExhibit::create([
            'name'     => $request->name,
            'code'     => $request->name,
            'type'     => $request->type,
        ]);

        $accreditation->recommendations_appendix_exhibits()->attach($appendix_exhibit->id);

        if($request->hasFile('file')) {
            foreach($request->file('file') as $file){
                $filename = $file->getClientOriginalName();
            
                while(Storage::exists('accreditation/' . $accreditation->id . '/' . $request->type . '/' . $request->name . '/' . $filename)) {
                    $filename = '(1)' . $filename;
                }

                $file->storeAs('accreditation/' . $accreditation->id . '/' . $request->type . '/' . $request->name, $filename);

                $uploaded = FileRepository::create([
                    'user_id'       => auth()->user()->id,
                    'file_name'     => $filename,
                    'file_type'     => 'Evidence',
                    'file'          => $filename,
                    'directory'     => 'accreditation/' . $accreditation->id . '/' . $request->type . '/' . $request->name . '/' . $filename,
                    'reference'     => 'AppendixExhibit',
                    'reference_id'  => $appendix_exhibit->id,
                ]);

                $appendix_exhibit->evidences()->attach($uploaded);
            }
        }
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function createSubTeam(Request $request, Accreditation $accreditation)
    {
        $validate = Validator::make($request->all(), [
            'team_name'     => 'required|min:4',
            'team_head'     => 'required',
            'team_members'  => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        foreach($request->team_members as $members) {
            if($members == $request->team_head)
                return back()->with('error', 'User cannot be both Team Head and Member')->withInput();
        }

        $team = Team::create([
            'team_name' => $request->team_name,
            'team_head' => $request->team_head,
        ]);
        $team_head = User::where('id', $request->team_head)->first();
        $team_head->assignRole('team-head');

        $team->users()->sync($request->team_members);
        $accreditation->teams()->syncWithoutDetaching($team);

        $result = \DB::table('document_team')->where('accreditation_id', $accreditation->id)->whereIn('team_id', auth()->user()->teams->diff(auth()->user()->team_head)->pluck('id')->toArray())->distinct()->get();
        $documents = [];
        if($result) {
            foreach($result as $item) {
                $documents[] = ['document_id' => $item->document_id, 'document_outline_id' => $item->document_outline_id, 'team_id' => $team->id];
            }
        }
        $accreditation->document_teams()->attach($documents);

        return back()->withToastSuccess(__('Sub Team successfully created.'));
    }
}
