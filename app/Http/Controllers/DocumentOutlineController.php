<?php

namespace App\Http\Controllers;

use App\Accreditation;
use App\DocumentOutline;
use App\OutlineComment;
use App\FileRepository;
use App\AppendixExhibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DocumentOutlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $document_outline = DocumentOutline::with('document','accreditation.agency','accreditation.program');
        // dd($document_outline->paginate(15)->groupBy('accreditation.id'));
        $accreditations = Accreditation::with('document','agency','program')->where('progress','!=','completed')->latest()->get();
        // $document_outline = $accreditation->outlines->load('document','accreditation.agency','accreditation.program');
        // dd($document_outline->paginate(15));
        // dd($document_outline->paginate(15)->groupBy('accreditation.id'));
        return view('document.outline.index', compact('accreditations'));
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
        $document_outline->with('scoring_type','comments','document.agency','accreditation','appendix_exhibit.evidences')->get();
        // $document_files = $document_outline->document->appendix_exhibit->unique()->diff($document_outline->appendix_exhibit);
        
        return view('document-outline.edit', ['outline' => $document_outline]);
        // return view('document-outline.edit', ['outline' => $document_outline, 'document_files' => $document_files->groupBy('file_type')]);
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

        if($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();

            $upload = $request->file('image')->store('media', ['disk' => 'public']);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $filename,
                'file_type'     => 'wysiwyg-uploaded',
                'file'          => trim($upload, 'media/'),
                'directory'     => 'public/media/' . $upload,
                'reference'     => 'DocumentOutline',
                'reference_id'  => $request->outlineId,
            ]);
            $path = asset('storage/' . $upload);

            return $path;
        }
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

    public function outlineUpload(Request $request, DocumentOutline $document_outline)
    {
        $document_outline->with('document','document.accreditation','appendix_exhibit')->get();
    
        // $last = $document_outline->appendix_exhibit->where('type', $request->type)->last();

        // if($last) {
        //     $code = ++$last->code;
        // } else {
        //     if($request->type == 'appendix')
        //         $code = 'Appendix A';
        //     else
        //         $code = 'Exhibit A';
        // }
        
        $appendix_exhibit = AppendixExhibit::create([
            'name'     => $request->name,
            'code'     => $request->name,
            'type'     => $request->type,
        ]);

        $document_outline->appendix_exhibit()->attach($appendix_exhibit->id, ['accreditation_id' => $document_outline->document->accreditation->id]);

        if($request->hasFile('file')) {
            foreach($request->file('file') as $file){
                $filename = $file->getClientOriginalName();
            
                while(Storage::exists('accreditation/' . $document_outline->document->accreditation->id . '/' . $request->type . '/' . $request->name . '/' . $filename)) {
                    $filename = '(1)' . $filename;
                }

                $file->storeAs('accreditation/' . $document_outline->document->accreditation->id . '/' . $request->type . '/' . $request->name, $filename);

                $uploaded = FileRepository::create([
                    'user_id'       => auth()->user()->id,
                    'file_name'     => $filename,
                    'file_type'     => 'Evidence',
                    'file'          => $filename,
                    'directory'     => 'accreditation/' . $document_outline->document->accreditation->id . '/' . $request->type . '/' . $request->name . '/' . $filename,
                    'reference'     => 'AppendixExhibit',
                    'reference_id'  => $appendix_exhibit->id,
                ]);

                $appendix_exhibit->evidences()->attach($uploaded);
            }
            // $document_outline->appendix_exhibit()->attach($uploaded->id, ['document_id' => $document_outline->document->id]);
            // return back()->withToastSuccess(__('File uploaded successfully.'));
        }
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function outlineSelect(Request $request, DocumentOutline $document_outline)
    {
        if($request->selected) {
            $document_outline->with('document.accreditation')->get();
            $appendix_exhibit = collect();
            $string = explode(',',$request->selected);

            foreach($string as $item) {    
                $appendix_exhibit->push(['appendix_exhibits_id' => $item, 'accreditation_id' => $document_outline->document->accreditation->id]);
            }
        }
        $document_outline->appendix_exhibit()->attach($appendix_exhibit);
        return back()->withToastSuccess(__('Action completed successfully.'));
        // if($request->has('checkFiles')) {
        //     $document_outline->with('document')->get();
        //     $files = collect();
        //     foreach($request->checkFiles as $file) {
        //         $files->push(['file_id' => $file, 'document_id' => $document_outline->document->id]);
        //     }
        //     // $document_outline->appendix_exhibit()->attach($files);
        //     return back()->withToastSuccess(__('Action completed successfully.'));
        // }
    }

    public function selectEvidences(Request $request, AppendixExhibit $appendix_exhibit)
    {
        if($request->selected) {
            $appendix_exhibit->evidences()->syncWithoutDetaching(explode(',',$request->selected));
        }
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function evidenceUpload(Request $request, AppendixExhibit $appendix_exhibit)
    {
        // dd($request);
        if($request->hasFile('file')) {
            foreach($request->file('file') as $file){
                $filename = $file->getClientOriginalName();
            
                while(Storage::exists('accreditation/' . $request->accreditation . '/' . $appendix_exhibit->type . '/' . $appendix_exhibit->code . '/' . $filename)) {
                    $filename = '(1)' . $filename;
                }

                $file->storeAs('accreditation/' . $request->accreditation . '/' . $appendix_exhibit->type . '/' . $appendix_exhibit->code, $filename);

                $uploaded = FileRepository::create([
                    'user_id'       => auth()->user()->id,
                    'file_name'     => $filename,
                    'file_type'     => 'Evidence',
                    'file'          => $filename,
                    'directory'     => 'accreditation/' . $request->accreditation . '/' . $appendix_exhibit->type . '/' . $appendix_exhibit->code . '/' . $filename,
                    'reference'     => 'AppendixExhibit',
                    'reference_id'  => $appendix_exhibit->id,
                ]);

                $appendix_exhibit->evidences()->attach($uploaded);
            }
            // $document_outline->appendix_exhibit()->attach($uploaded->id, ['document_id' => $document_outline->document->id]);
            return back()->withToastSuccess(__('Evidence uploaded successfully.'));
        }
    }

    public function evidenceComplete(AppendixExhibit $appendix_exhibit)
    {
        $appendix_exhibit->update([
            'evidence_complete' => true,
        ]);

        return back()->withToastSuccess(__('Evidence successfully completed.'));
    }
}
