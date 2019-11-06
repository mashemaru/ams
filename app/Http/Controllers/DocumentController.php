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
        $document = Document::select('id','agency_id','document_name')->with('agency:id,agency_name');
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
                'parent_id'         => 0,
                'root_parent_id'    => 0,
                'section'           => $s->section,
                'doc_type'          => isset($s->doc_type) ? $s->doc_type : 'Narrative',
                'score_type'        => isset($s->score) ? $s->score : 0,
            ]);
            if(isset($s->children)) {
                $document->saveChildrenRecursively($s, $root->id, $root->id);
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

    public function mashDoc()
    {
        $doc = \App\DocumentOutline::find(1);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText($doc->section,array('name'=>'Arial','size' => 20,'bold' => true));

        $html = str_replace('<table class="table table-bordered">','<table style="width: 100%; border: 4px #000000 single;">',$doc->body);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');

        return response()->download(public_path('Appdividend.docx'));
    }
}
