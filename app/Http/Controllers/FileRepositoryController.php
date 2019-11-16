<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                    return '<a href="'.route('file-repository.download', $row->id).'" class="btn btn-dark btn-sm"><i class="fas fa-download"></i> Download</a>';
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
        //
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
}
