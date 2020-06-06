@extends('layouts.app', ['title' => __('Document Outlines')])

@section('content')
@include('users.partials.header')

<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row mt-5">
        <div class="col-xl-3 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">References</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4><strong>Doc Type:</strong> {{ $outline->doc_type }}</h4>
                    @if(auth()->user()->hasRole('super-admin'))
                    <a class="btn btn-primary btn-sm mt-2" href="#" data-toggle="modal" data-target="#EditEvidenceList">Edit Evidence List</a>
                    <div class="modal fade" id="EditEvidenceList" tabindex="-1" role="dialog" aria-labelledby="EditEvidenceListLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sEditEvidenceListLabel">Edit Evidence List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <form method="post" action="{{ route('accreditation.evidence_list.update', $outline) }}" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="modal-body p-lg-5">
                                    <div class="text-muted text-left mt-2 mb-3">
                                        <button type="button" class="btn btn-success" id="addRecommendation">Add</button><br>
                                    </div><br>
                                    <div id="Recommendations">
                                        @if($outline->evidences)
                                        @foreach($outline->evidences as $list)
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group mb-4">
                                                    <div class="input-group input-group-alternative">
                                                        <input class="form-control recommendation" placeholder="Evidence List" name="evidence[{{ $list->id }}][list]" type="text" value="{{ $list->name }}">
                                                    </div>
                                                    <textarea class="form-control form-control-sm mt-3" rows="2" name="evidence[{{ $list->id }}][desc]" placeholder="Description...">{{ $list->description }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-1">
                                                <button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button>
                                            </div> --}}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card shadow mt-4">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Comments</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="comments">
                        <div class="timeline-block">
                            <div class="timeline-content">
                                @if($outline->comments->count())
                                    @foreach ($outline->comments as $c)
                                        <div class="timeline-comment mb-3{{ ($c->user_id != auth()->user()->id) ? '' : ' text-right' }}">
                                            <h5 class="mb-0">{{ $c->user->name . ' - ' }}<small>{{ $c->created_at->diffForHumans() }}</small></h5>
                                            <p class="text-sm mt-1 mb-0">{{ $c->comment }}</p>
                                            @if($c->user_id != auth()->user()->id && is_null($c->resolved))
                                                <form method="post" action="{{ route('outlineResolve', $c->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Resolve Comment</button>
                                                </form>
                                            @elseif(!is_null($c->resolved))
                                                <small class="font-italic text-xs font-weight-light">Resolved by: {{ $c->resolved_user->name . ' - ' .  $c->resolved->diffForHumans() }}</small>
                                            @endif
                                        </div>
                                    @endforeach
                                    <hr class="my-4">
                                @endif
                            </div>
                        </div>
                        <form method="post" action="{{ route('outlineComment.store', $outline) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control form-control-sm" rows="2" name="comment" placeholder="Place your comment here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                Add Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 mb-5 mb-xl-0">
            {{-- @if ($outline->accreditation->type == 'reaccredit')
            <div class="card shadow mb-3">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Recommendations</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body px-lg-4 py-lg-4">
                    @if($outline->accreditation->recommendations)
                    <ol>
                    @foreach ($outline->accreditation->recommendations as $key => $item)
                        <li>{{ $item['label'] }}</li>
                    @endforeach
                    </ol>
                    @endif
                </div>
            </div>
            @endif --}}
            {{-- @if ($outline->accreditation->progress == 'initial')
            <div class="card shadow mb-3">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="dd">
                        <ol id="dd-list" class="dd-list">
                            {!! renderDocumentSections(json_decode($outline->document->sections), $outline->document->agency->score_types ) !!}
                        </ol>
                    </div>
                </div>
            </div>
            @else --}}
            <form method="post" action="{{ route('document-outline.update', $outline) }}" autocomplete="off">
            @csrf
            @method('put')
                <div class="card shadow mb-3">
                    <div class="card-header border-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ $outline->section }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">
                        @if ($outline->score_type != 0)
                        @role('team-head')
                            @if($collection)
                            <h4>Score Breakdown</h4>
                            <ul>
                                @foreach( $collection->groupby('score') as $key => $score)
                                    @if($key == '')
                                        <li><strong>No Answer</strong> - {{ $score->count() }}</li>
                                    @else
                                        <li><strong>{{ $key }}</strong> - {{ $score->count() }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            @endif
                            <h4>Score: <span class="score">{{ ($outline->score) ? $outline->score : 'N/A' }}</span>
                        @endrole
                        @unlessrole('team-head')
                            @hasanyrole('member|super-admin')
                            <h4>Score: <span class="score">{{ ($outline_user) ? $outline_user->pivot->score : 'N/A' }}</span>
                            @endrole
                        @endunlessrole
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#scoreModal" style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Score Section
                                </button>
                            </h4>
                            <br>
                        @endif
                        {{-- @role('member') --}}
                        @unlessrole('team-head')
                            @hasanyrole('member|super-admin')
                                @if ($outline->accreditation->progress != 'initial')
                                    @if ($outline->description)
                                    <p><em>{{ $outline->description }}</em></p>
                                    @endif
                                    <textarea name="content" id="content">{{ ($outline_user) ? $outline_user->pivot->body : '' }}</textarea>
                                @endif
                            @endrole
                        @endunlessrole

                        {{-- @role('super-admin') --}}
                        @role('team-head')
                            @if ($outline->accreditation->progress != 'initial')
                                @if ($outline->description)
                                    <p><em>{{ $outline->description }}</em></p>
                                @endif
                                <textarea name="content" id="content">{{ $outline->body }}</textarea>
                            @endif
                            {{-- <div class="custom-control custom-radio mb-3 mt-4">
                                <input name="user-outline" class="custom-control-input" id="customRadio0" type="radio" value=""{{ (null == $outline_selected_user) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="customRadio0"><strong>---</strong></label>
                            </div> --}}
                            <p class="mt-4"></p>
                            @foreach($outline->outline_user as $user)
                                <div class="mb-3">
                                    {{-- <input name="user-outline" class="custom-control-input" id="customRadio{{ $user->id }}" type="radio" value="{{ $user->id }}"{{ ($outline_selected_user && $user->id == $outline_selected_user->id) ? ' checked' : '' }}> --}}
                                    <label><strong>{{ $user->name }}</strong></label>
                                    <a data-toggle="modal" id="getMessage" data-target="#messageBoard" class="btn btn-primary btn-sm ml-4" data-id="{{ $user->id }}" href="#"> View </a>
                                    <button type="submit" name="user_{{ $user->id }}" class="btn btn-success btn-sm ml-1">Copy</button>
                                </div>
                                
                                <div class="modal fade" id="messageBoard" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <!-- Modal content-->
                                        <div class="modal-content message-modal p-4">
                                            <div class="modal-body">
                                                test
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endrole
                    </div>
                    @if ($outline->accreditation->progress == 'formal')
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($outline->score_type != 0)      
                <!-- Modal -->     
                <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog"
                    aria-labelledby="scoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scoreModalLabel">Score Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label">Scoring Name: {{ $outline->scoring_type->scoring_name }}</label><br>
                                        @foreach($outline->scoring_type->scores as $key => $s)
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="custom-radio-score" class="custom-control-input" id="customRadio{{ $key }}" type="radio" value="{{ $s['score'] }}"{{ ($s['score'] == $outline->score) ? ' checked' : '' }}>
                                                <label class="custom-control-label" for="customRadio{{ $key }}"><strong>{{ $s['score'] }}</strong> - {{ $s['description'] }}</label>
                                            </div>
                                            <h4></h4>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary cancelScore">Cancel</button>
                                <button type="button" class="btn btn-primary saveScore" data-dismiss="modal">Save Score</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
            {{-- @endif --}}

            @if($outline->evidences)
                <div class="accordion search-accordion" id="accordionExample">
                    @foreach($outline->evidences as $list)
                    <div class="card">
                        <div class="card-header{{ (request()->get('appendix') == $list->id) ? ' collapsed' : '' }}" id="heading{{$list->id}}" data-toggle="collapse" data-target="#collapse{{$list->id}}" aria-expanded="false" aria-controls="collapse{{$list->id}}">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0">{{ $list->name }} <small><em>{{ '- ' . $list->description }}</em></small></h5>
                                <span class="ml-auto mr-5"><a class="btn btn-primary btn-sm mt-2" href="#" data-toggle="modal" data-target="#taskModal{{$list->id}}">Assign Task</a></span>
                            </div>
                        </div>
                        <div id="collapse{{$list->id}}" class="collapse{{ (request()->get('appendix') == $list->id) ? ' show' : '' }}" aria-labelledby="heading{{$list->id}}" data-parent="#accordionExample">
                            <div class="card shadow">
                                <div class="card-header border-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="mb-0">Appendices/Exhibits</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-lg-4 py-lg-4">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Files</th>
                                                    {{-- <th scope="col">Evidences</th> --}}
                                                    <th scope="col" width="2%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list->appendix_exhibit as $data)
                                                <tr>
                                                    <th scope="row">{{ $data->code }}</th>
                                                    <th scope="row">{{ $data->name }}</th>
                                                    <th scope="row">{{ $data->description }}</th>
                                                    <td scope="row">{{ ucfirst($data->type) }}</td>
                                                    <td scope="row">{{ ($data->evidences) ? count($data->evidences) : '0'  }}</td>
                                                    {{-- <td scope="row">
                                                        @if($data->evidences->isNotEmpty())
                                                        {!! '<span class="badge badge-dot mr-4"><i class="bg-info"></i> '. $data->evidences->implode('file_name', '</span><br> <span class="badge badge-dot mr-4"><i class="bg-info"></i> ') . '</span>' !!}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td> --}}
                                                    @if (!$outline->accreditation->evidence_can_upload)
                                                    <td class="text-right">
                                                        @if(!$data->evidence_complete)
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                {{-- @if ($outline->accreditation->progress != 'initial') --}}
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#evidenceModal{{$list->id}}-{{ $data->id }}">Add Evidences</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#selectEvidenceModal{{$list->id}}-{{ $data->id }}">Add Evidences from File Repo</a>
                                                                {{-- @endif --}}
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewEvidences{{$list->id}}-{{ $data->id }}">View Evidence List</a>
                                                                {{-- <a class="dropdown-item" href="#">Remove</a> --}}
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="modal fade" id="evidenceModal{{$list->id}}-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="evidenceModal{{ $data->id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <form enctype="multipart/form-data" method="post" action="{{ route('evidence.upload', $data) }}" autocomplete="off">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="evidenceModal{{ $data->id }}Label">Add Evidence</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group mb-3">
                                                                            <label class="form-control-label" style="float: left">Select File(s)</label>
                                                                            <input type="hidden" name="accreditation" value="{{ $outline->accreditation->id }}">
                                                                            <input type="hidden" name="evidences" value="{{ $list->name }}">
                                                                            <input type="file" class="form-control" name="file[]" multiple>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-success">Add</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="selectEvidenceModal{{$list->id}}-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="selectEvidenceModal{{ $data->id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="selectEvidenceModal{{ $data->id }}Label">Select Evidences from File Repo</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                <form method="post" class="evidence_select" action="{{ route('evidence.select', $data) }}" autocomplete="off">
                                                                    @csrf
                                                                    <input type="hidden" name="selected">
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <table class="data-table2 align-items-center table-flush w-100">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th scope="col"></th>
                                                                                        <th scope="col">File Name</th>
                                                                                        <th scope="col">File Type</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-success">Save</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="viewEvidences{{$list->id}}-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="viewEvidencesLabel{{ $data->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="viewEvidencesLabel{{ $data->id }}">Evidences of {{ $data->name }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-left">
                                                                        @if($data->evidences)
                                                                            @foreach($data->evidences as $evidences)
                                                                            <form method="post" action="/evidenceRemove/{{$data->id}}/{{$evidences->id}}" autocomplete="off">
                                                                            @csrf
                                                                                <p><span class="badge badge-dot mr-4"><i class="bg-info"></i> <a href="#" class="file-repo-download text-primary" data-id="{{ $evidences->id }}">{{ $evidences->file_name }}</a></span> <button type="submit" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove"></i></button></p>
                                                                            </form>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    {{-- <div class="modal-body text-left">
                                                                        {!! '<span class="badge badge-dot mr-4"><i class="bg-info"></i> '. $data->evidences->implode('file_name', '</span><br> <span class="badge badge-dot mr-4"><i class="bg-info"></i> ') . '</span>' !!}
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (!$outline->accreditation->evidence_can_upload)
                                    <br>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal{{$list->id}}"
                                        style="float:right">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        Add Appendix/Exhibit
                                    </button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectModal{{$list->id}}"
                                        style="float:right; margin-right: 2%">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        Select Existing Appendix/Exhibit
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="selectModal{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="selectModalLabel{{$list->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="selectModalLabel{{$list->id}}">Select Appendix/Exhibit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <form method="post" id="outline_select" action="{{ route('outline.select', $list) }}" autocomplete="off">
                                                @csrf
                                                <input type="hidden" name="selected">
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table data-table align-items-center table-flush w-100">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Code</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Type</th>
                                                                    {{-- <th scope="col">Evidences</th> --}}
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    {{-- @foreach($document_files as $key => $files)
                                                    <h6 class="heading-small text-muted mb-2">{{ $key }}</h6>
                                                        @foreach($files as $file)
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input type="checkbox" class="custom-control-input" name="checkFiles[]" id="customCheck{{ $file->id }}" value="{{ $file->id }}">
                                                            <label class="custom-control-label" for="customCheck{{ $file->id }}">{{ $file->file_name }}</label>
                                                        </div>
                                                        @endforeach
                                                    @endforeach --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addModal{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="addModalLabel{{$list->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel{{$list->id}}">Add Appendix/Exhibit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form enctype="multipart/form-data" method="post" action="/document-outlineUpload/{{$outline->id}}/{{$list->id}}" autocomplete="off">
                                                @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label">Name</label>
                                                            <div class="input-group input-group-alternative">
                                                                <input class="form-control" name="name" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label">Description</label>
                                                            <div class="input-group input-group-alternative">
                                                                <input class="form-control" name="description" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label">Type</label>
                                                            <div class="input-group input-group-alternative">
                                                                <select class="form-control" name="type">
                                                                    <option value="appendix">Appendix</option>
                                                                    <option value="exhibit">Exhibit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- @if ($outline->accreditation->progress != 'initial') --}}
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label">File(s)</label>
                                                            <input type="file" class="form-control" name="file[]" multiple>
                                                        </div>
                                                        {{-- @endif --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="taskModal{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="taskModal{{$list->id}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="taskModal{{$list->id}}Label">Add Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form method="post" action="{{ route('task.appendix.store', $outline->id) }}" autocomplete="off">
                                @csrf
                                    <input type="hidden" name="appendix_id" value="{{$list->id}}">
                                    <input type="hidden" name="appendix_name" value="{{$list->name}}">
                                    <div class="modal-body">
                                        <div class="form-group{{ $errors->has('task_name') ? ' has-danger' : '' }} mb-3">
                                            <label class="form-control-label" for="input-task_name">{{ __('Task Name') }}</label>
                                            <input type="text" name="task_name" id="input-task_name" class="form-control form-control-alternative{{ $errors->has('task_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Task Name') }}" value="{{ old('task_name') }}" required autofocus>
                                            @if ($errors->has('task_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('task_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                        <label class="form-control-label">Assign to</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control form-control-alternative select2" name="assign_to[]" data-toggle="select" multiple >
                                            @if($users)
                                                @foreach ($users as $user)
                                                    @if($user->id != auth()->user()->id)
                                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Assign to team</label>
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control form-control-alternative select2" name="assign_to_team[]" data-toggle="select" multiple>
                                                @if($teams)
                                                    @foreach ($teams as $team)
                                                        <option value="{{$team->id}}">{{ $team->team_name }}</option>
                                                    @endforeach
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Due Date</label>
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control datepicker" name="due_date" data-date-format="yyyy-mm-dd" placeholder="Select due date" type="text" value="{{ old('due_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Priority</label>
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control form-control-alternative" name="priority">
                                                    <option value="low">Low</option>
                                                    <option value="med">Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label class="form-control-label">Remarks</label>
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control form-control-alternative" name="remarks" type="text">
                                            </div>
                                        </div> --}}
                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customRecurring" name="recurring">
                                                <label class="custom-control-label" for="customRecurring">Recurring</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3" id="customRecurringFrequency" style="display: none;">
                                            <div class="custom-checkbox">
                                                <input type="number" name="recurring_freq" id="input-name" min="1" class="form-control form-control-alternative" placeholder="Input number of days">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="/vendor/nestable/jquery.nestable.min.js"></script>
<link href="/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="{{ asset('js/dataTables.js') }}"></script>
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script>
$(".datepicker").datepicker();
$(document).ready(function () {
    @if ($outline->accreditation->progress != 'formal')
    $('#content').summernote('disable');
    @endif
    // @role('team-head')
    // $('#content').summernote('disable');
    // @endrole
    $('.dd-list .removeclass').remove();
    $('.dd-list input').attr('disabled', true);
    $('.dd-list select').attr('disabled', true);
    $('.dd').nestable({handleClass:'123'});
    $('#content').summernote({
        height: 450,
        followingToolbar: true,
        maximumImageFileSize: 500*1024, // 500 KB
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
        }
    });

    var dataTable = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('appendices-exhibits.select',$outline->id) }}",
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            // {data: 'evidences', name: 'evidences.file_name', orderable: false, searchable: false},
        ],
        order:[0,'desc'],
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(2)').attr('class', 'text-primary d-flex align-items-center');
        }
    });
    $('.data-table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
        $('#outline_select input[name="selected"]').val(dataTable.rows('.selected').data().pluck('id').toArray());
    } );

    var dataTable2 = $('.data-table2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('evidence.show') }}",
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'file_name', name: 'file_name'},
            {data: 'file_type', name: 'file_type'},
        ],
        order:[0,'desc'],
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        }
    });
    $('.data-table2 tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
        $('.evidence_select input[name="selected"]').val(dataTable2.rows('.selected').data().pluck('id').toArray());
    });

    $(document).on('click', '#getMessage', function(e){
        e.preventDefault();
        var url = $(this).data('id');
        $('.message-modal').html('');   
        $.ajax({
            url: '/getDocument_outline_users/' + {{ $outline->id }} + '/?user=' + url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.message-modal').html('');    
            $('.message-modal').html(data); // load response 
        })
        .fail(function(){
            $('.message-modal').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        });
    });
});
// const Toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000
// })
function uploadImage(image) {
    var data = new FormData();
    data.append("image", image);
    data.append("outlineId", {{ $outline->id }});
    window.axios.post('/uploadImage', data)
    .then(function (response) {
        var image = $('<img>').attr('src', response.data);
        $('#content').summernote("insertNode", image[0]);
    })
    .catch(function (error) {
        Toast.fire({
            type: 'error',
            title: error.response.data.errors.image[0]
        })
    })
}
$('#addRecommendation').click(function (e) { //on add input button click
    var Recommendations = $("#Recommendations .row").length;
    $("#Recommendations").append('<div class="row"><div class="col-8"><div class="form-group mb-4"><div class="input-group input-group-alternative"><input class="form-control recommendation" placeholder="Evidence List" name="new_evidence['+ Recommendations +'][list]" type="text"></div><textarea class="form-control form-control-sm mt-3" rows="2" name="new_evidence['+ Recommendations +'][desc]" placeholder="Description..."></textarea></div></div><div class="col-1"><button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button></div></div>');
});

$("body").on("click",".removeRecommendation", function(e) { //user click on remove text
    if( $("#Recommendations .row").length >= 1 ) {
        $(this).parent().closest('.row').remove();
        // var x = 0;
        // $("#Recommendations .row").each(function() {
        //     var recommendation = $(this).find("input.recommendation");
        //     recommendation.attr('name', 'evidence_list['+x+']');
        //     x++;
        // });
    }
    return false;
});
</script>
@endpush