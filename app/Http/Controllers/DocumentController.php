<?php

namespace App\Http\Controllers;

use App\Document;
use App\Agency;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Document::select('id','agency_id','document_name')->with('agency:id,agency_code');

        return view('document.index', ['documents' => $document->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agency = Agency::all();
        return view('document.create', ['agencies' => $agency]);
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
            'agency_id'        => 'required|exists:agencies,id',
            'document_name'    => 'required',
            'sections'         => 'required',
        ]);

        $document = Document::create($validate);

        // foreach(json_decode($request->sections) as $s) {
        //     $root = $document->outlines()->create([
        //         'parent_id'         => 0,
        //         'root_parent_id'    => 0,
        //         'section'           => $s->section,
        //         'doc_type'          => isset($s->doc_type) ? $s->doc_type : 'Narrative',
        //         'score_type'        => isset($s->score) ? $s->score : 0,
        //     ]);
        //     if(isset($s->children)) {
        //         $document->saveChildrenRecursively($s, $root->id, $root->id);
        //     }
        // }

        return redirect()->route('document.index')->withToastSuccess(__('Document successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $agency = Agency::all();
        return view('document.show', ['agencies' => $agency, 'document' => $document]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $document->load('agency.score_types');
        $agency = Agency::with('score_types')->get();
        return view('document.edit', ['agencies' => $agency, 'document' => $document]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $document->load('accreditation_in_progress');
        if($document->accreditation_in_progress->count()) {
            return back()->withToastError(__('Document has active accreditation.'));
        }

        $validate = $request->validate([
            'agency_id'        => 'required|exists:agencies,id',
            'document_name'    => 'required',
            'sections'         => 'required',
        ]);

        $document->update($validate);

        // foreach(json_decode($request->sections) as $s) {
        //     $root = $document->outlines()->create([
        //         'parent_id'         => 0,
        //         'root_parent_id'    => 0,
        //         'section'           => $s->section,
        //         'doc_type'          => isset($s->doc_type) ? $s->doc_type : 'Narrative',
        //         'score_type'        => isset($s->score) ? $s->score : 0,
        //     ]);
        //     if(isset($s->children)) {
        //         $document->saveChildrenRecursively($s, $root->id, $root->id);
        //     }
        // }

        return redirect()->route('document.index')->withToastSuccess(__('Document successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if($document->accreditation)
            return back()->withToastError(__('Document has active accreditation.'));
        else
            $document->delete();

        return back()->withToastSuccess(__('Document successfully deleted.'));
    }
}
