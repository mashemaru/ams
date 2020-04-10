<?php

namespace App\Http\Controllers;

use App\FileRepository;
use App\AppendixExhibit;
use App\DocumentOutline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class FileRepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FileRepository $FileRepository)
    {
        if ($request->ajax()) {
            
            $data = $FileRepository->with('user')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('file_type', function($data){
                    return ($data->file_type) ? ucfirst($data->file_type) : 'N\A';
                })
                ->editColumn('file_name', function($data){
                    return ($data->file_name) ? '<strong>'.$data->file_name.'</strong>' : 'N\A';
                })
                ->editColumn('file', function($data){
                    return ($data->file) ? '<div class="file-icon mr-2" data-file="'.pathinfo($data->file, PATHINFO_EXTENSION).'"></div> ' . $data->file : 'N\A';
                })
                ->editColumn('user_id', function($data) {
                    return $data->user->name;
                })
                ->editColumn('created_at', function($data) {
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    return view('file-repo.partials.action', ['file' => $row->id]);
                    // return '<a href="'.route('file-repository.download', $row->id).'" class="btn btn-dark btn-sm"><i class="fas fa-download"></i> Download</a>';
                })
                ->rawColumns(['file_name','file','action'])
                ->make(true);
        }
        return view('file-repo.index');
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
     * @param  \App\FileRepository  $fileRepository
     * @return \Illuminate\Http\Response
     */
    public function show(FileRepository $fileRepository)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileRepository  $fileRepository
     * @return \Illuminate\Http\Response
     */
    public function edit(FileRepository $fileRepository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileRepository  $fileRepository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileRepository $fileRepository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileRepository  $fileRepository
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileRepository $fileRepository)
    {
        $fileRepository->delete();
        return back()->withToastSuccess(__('File successfully deleted.'));
    }

    public function download(FileRepository $fileRepository)
    {
        if(Storage::exists($fileRepository->directory)) {
            return response()->download(storage_path('app/'. $fileRepository->directory));
        }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();

            while(Storage::exists('uploads/' . $filename)) {
                $filename = '(1)' . $filename;
            }
            $request->file('file')->storeAs('uploads/', $filename);

            FileRepository::create([
                'user_id'       => auth()->user()->id,
                'file_name'     => $request->fileName,
                'file_type'     => 'general',
                'file'          => $filename,
                'directory'     => 'uploads/' . $filename,
                'reference'     => 'FileRepository',
                'reference_id'  => 0,
            ]);
            return back()->withToastSuccess(__('File successfully uploaded.'));
        }
    }

    public function appendicesExhibits(Request $request, FileRepository $FileRepository)
    {
        if ($request->ajax()) {
            $data = AppendixExhibit::with('evidences')->get();
            // $data = $FileRepository->with('user')->whereIn('file_type', ['appendix','exhibit'])->get();
            // <th scope="row">{{ $data->code }}</th>
            // <th scope="row">{{ $data->name }}</th>
            // <td scope="row">{{ ucfirst($data->type) }}</td>
            // <td scope="row">
            //     @if($data->evidences->isNotEmpty())
            //     {!! '<span class="badge badge-dot mr-4"><i class="bg-info"></i> '. $data->evidences->implode('file_name', '</span><br> <span class="badge badge-dot mr-4"><i class="bg-info"></i> ') . '</span>' !!}
            //     @else
            //         N/A
            //     @endif
            // </td>
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('evidences', function($data) {
                    return $data->evidences->map(function($c) {
                        return $c->file_name;
                    })->implode(', ');
                })
                // ->editColumn('file_type', function($data){
                //     return ($data->file_type) ? ucfirst($data->file_type) : 'N\A';
                // })
                // ->editColumn('file_name', function($data){
                //     return ($data->file_name) ? '<strong>'.$data->file_name.'</strong>' : 'N\A';
                // })
                // ->editColumn('file', function($data){
                //     return ($data->file) ? '<div class="file-icon mr-2" data-file="'.pathinfo($data->file, PATHINFO_EXTENSION).'"></div> ' . $data->file : 'N\A';
                // })
                // ->editColumn('user_id', function($data) {
                //     return $data->user->name;
                // })
                // ->editColumn('created_at', function($data) {
                //     return $data->created_at->diffForHumans();
                // })
                ->addColumn('action', function($row){
                    return view('file-repo.partials.indexDropdown', ['appendix_exhibits' => $row]);
                    // return '<a href="'.route('file-repository.download', $row->id).'" class="btn btn-dark btn-sm"><i class="fas fa-download"></i> Download</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('file-repo.appendix-exhibits');
    }

    public function selectAppendicesExhibits(Request $request, DocumentOutline $document_outline)
    {
        if ($request->ajax()) {
            $data = AppendixExhibit::with('evidences')->get()->diff($document_outline->appendix_exhibit);
            // $data = AppendixExhibit::with('evidences')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('evidences', function($data) {
                    return $data->evidences->map(function($c) {
                        return $c->file_name;
                    })->implode(', ');
                })
                ->make(true);
        }
        return view('file-repo.appendix-exhibits');
    }

    public function showEvidences(Request $request)
    {
        if ($request->ajax()) {
            // $document_outline->load('appendix_exhibit.evidences');
            // $items = collect();
            // $document_outline->appendix_exhibit->each(function($q) use(&$items) {
            //     $items = $items->concat($q->evidences);
            // });
            // $evidences = $items->pluck('id');

            // $data = FileRepository::get()->diff($items);
            $data = FileRepository::all();
            // $data = AppendixExhibit::with('evidences')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('evidences', function($data) {
                //     return $data->evidences->map(function($c) {
                //         return $c->file_name;
                //     })->implode(', ');
                // })
                ->make(true);
        }
        // return view('file-repo.evidences');
    }

    public function showFileRepository(Request $request)
    {
        if ($request->ajax()) {
            // $data = FileRepository::get()->diff($items);
            $data = AppendixExhibit::all();
            // $data = AppendixExhibit::with('evidences')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('evidences', function($data) {
                //     return $data->evidences->map(function($c) {
                //         return $c->file_name;
                //     })->implode(', ');
                // })
                ->make(true);
        }
        // return view('file-repo.evidences');
    }

    public function evidenceRemove(AppendixExhibit $appendix_exhibit, FileRepository $file_repository)
    {
        $appendix_exhibit->evidences()->detach($file_repository);
        return back()->withToastSuccess(__('Evidence successfully removed.'));
    }

    public function evidenceDownload(AppendixExhibit $appendix_exhibit)
    {
        $appendix_exhibit->load('evidences');
        if($appendix_exhibit->evidences) {
            $zip_file = storage_path('app/evidences/' . $appendix_exhibit->name . '-' . $appendix_exhibit->type . '-' . now()->format("m-d-Y-his") . '.zip'); // Name of our archive to download

            // Initializing PHP class
            $zip = new \ZipArchive();
            $zip->open( $zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
    
            // Adding file: second parameter is what will the path inside of the archive
            // So it will create another folder called "storage/" inside ZIP, and put the file there.
            foreach($appendix_exhibit->evidences as $evidences) {
                $zip->addFile($evidences->directory, $evidences->file);
            }

            $zip->close();
            return response()->download($zip_file)->deleteFileAfterSend();
            // return response()->download(public_path($zip_file))->deleteFileAfterSend();
        }
    }
}
