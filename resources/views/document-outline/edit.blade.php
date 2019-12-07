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
                    <h4>{{ $outline->doc_type }}</h4>
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
            @if ($outline->accreditation->type == 'reaccredit')
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
            @endif
            @if ($outline->accreditation->progress == 'initial')
            <div class="card shadow mb-3">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="dd">
                        <ol id="dd-list" class="dd-list">
                            {!! renderDocumentSections(json_decode($outline->document->sections), $outline->document->agency->score_types ) !!}
                        </ol>
                    </div>
                </div>
            </div>
            @else
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
                        <h4>Score: <span class="score">{{ ($outline->score) ?? 'N/A' }}</span>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#scoreModal" style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Score Section
                                </button>
                            </h4>
                            <br>
                        @endif
                        <textarea name="content" id="content">{{ $outline->body }}</textarea>
                    </div>
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
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
            @endif
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
                                    <th scope="col">Type</th>
                                    <th scope="col">Evidences</th>
                                    <th scope="col" width="2%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($outline->appendix_exhibit as $data)
                                <tr>
                                    <th scope="row">{{ $data->code }}</th>
                                    <th scope="row">{{ $data->name }}</th>
                                    <td scope="row">{{ ucfirst($data->type) }}</td>
                                    <td scope="row">
                                        @if($data->evidences->isNotEmpty())
                                        {!! '<span class="badge badge-dot mr-4"><i class="bg-info"></i> '. $data->evidences->implode('file_name', '</span><br> <span class="badge badge-dot mr-4"><i class="bg-info"></i> ') . '</span>' !!}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    @if (!$outline->accreditation->evidence_can_upload)
                                    <td class="text-right">
                                        @if(!$data->evidence_complete)
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#evidenceModal{{ $data->id }}">Add Evidences</a>
                                                {{-- <a class="dropdown-item" href="#">Remove</a> --}}
                                            </div>
                                        </div>
                                        @endif
                                        <div class="modal fade" id="evidenceModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="evidenceModal{{ $data->id }}Label" aria-hidden="true">
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
                                                            <label class="form-control-label" style="float: left">Select File</label>
                                                            <input type="hidden" name="accreditation" value="{{ $outline->accreditation->id }}">
                                                            <input type="file" class="form-control" name="file">
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
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"
                        style="float:right">
                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                        Add Appendix/Exhibit
                    </button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectModal1"
                        style="float:right; margin-right: 2%">
                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                        Select Existing Appendix/Exhibit
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    @if (!$outline->accreditation->evidence_can_upload)
    <!-- Modal -->
    <div class="modal fade" id="selectModal1" tabindex="-1" role="dialog" aria-labelledby="selectModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectModalLabel">Select Appendix/Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" id="outline_select" action="{{ route('outline.select', $outline) }}" autocomplete="off">
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
                                    <th scope="col">Evidences</th>
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Appendix/Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{ route('outline.upload', $outline) }}" autocomplete="off">
                @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-control-label">Name</label>
                            <div class="input-group input-group-alternative">
                                <input class="form-control" name="name" type="text">
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
                        <div class="form-group mb-3">
                            <label class="form-control-label">File</label>
                            <input type="file" class="form-control" name="file">
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
    @endif
</div>
@endsection

@push('js')
<script src="/vendor/nestable/jquery.nestable.min.js"></script>
<link href="/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="{{ asset('js/dataTables.js') }}"></script>
<script>
$(document).ready(function () {
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
            {data: 'evidences', name: 'evidences.file_name', orderable: false, searchable: false},
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
});
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})
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
</script>
@endpush