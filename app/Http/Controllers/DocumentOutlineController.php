<?php

namespace App\Http\Controllers;

use App\DocumentOutline;
use App\OutlineComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentOutlineController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentOutline $document_outline)
    {
        $document_outline->with('scoring_type','comments')->get();
        return view('document-outline.edit', ['outline' => $document_outline]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentOutline $document_outline)
    {
        $document_outline->update([
            'body'  => $request->content,
            'score' => $request->get('custom-radio-score'),
        ]);

        return back()->withToastSuccess(__('Document successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function image_upload(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:500',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages());
        }

        $path = asset('storage/' . $request->file('image')->store('media', ['disk' => 'public']));

        return $path;
    }

    public function insert_comment(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'comment' => 'required|min:4',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        auth()->user()->comments()->create([
            'outline_id'    => $id,
            'comment'       => $request->comment,
        ]);

        return back()->withToastSuccess(__('Comment submitted successfully.'));
    }

    public function resolved_comment($id)
    {
        $comment = OutlineComment::findOrFail($id);
        $comment->update([
            'resolved_by'   => auth()->user()->id,
            'resolved'      => now(),
        ]);
        
        return back()->withToastSuccess(__('Comment resolved successfully.'));
    }
}
