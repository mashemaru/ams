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
    public function index(Document $document)
    {
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

        foreach(json_decode($request->sections) as $s) {
            $root = $document->outlines()->create([
                'parent_id'     => 0,
                'section'       => $s->section,
                'score_type'    => isset($s->score) ?: 1,
            ]);
            if(isset($s->children)) {
                $document->saveChildrenRecursively($s, $root);
            }
        }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
