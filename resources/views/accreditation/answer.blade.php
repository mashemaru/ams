@extends('layouts.app', ['title' => __('Answer Recommendations')])

@section('content')
@include('users.partials.header')

<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row mt-5">
        <div class="col-xl-9 mb-5 mb-xl-0">
            @if ($accreditation->type == 'reaccredit')
            <div class="card shadow mb-3">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Recommendations</h3>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('answer.recommendation', $accreditation) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="card-body px-lg-4 py-lg-4">
                    @if($accreditation->recommendations)
                    <div class="accordion" id="accordionExample">
                    @foreach ($accreditation->recommendations as $key => $item)
                        <div class="card">
                            <div class="card-header" id="heading{{$key}}" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                <h5 class="mb-0">{{ $item['label'] }}</h5>
                            </div>
                            <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input name="recommendation[{{$key}}][label]" type="text" class="form-control" placeholder="Recommendation" value="{{ $item['label'] }}">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="recommendation[{{$key}}][answer]">{{ $item['answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    {{-- <hr>
                    <h2>Evidence List</h2>
                    <div class="text-muted text-left mt-2 mb-3">
                        <button type="button" class="btn btn-success" id="addRecommendation">Add</button><br>
                    </div><br>
                    <div id="Recommendations">
                        @if($accreditation->evidence_list)
                        @foreach ($accreditation->evidence_list as $key => $evidence)
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <input class="form-control recommendation" placeholder="Evidence List" name="evidence_list[{{$key}}]" type="text" value="{{ $evidence }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div> --}}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mb-5 mb-xl-0">
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
                                    <th scope="col" width="2%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accreditation->recommendations_appendix_exhibits as $data)
                                <tr>
                                    <th scope="row">{{ $data->code }}</th>
                                    <th scope="row">{{ $data->name }}</th>
                                    <td scope="row">{{ ucfirst($data->type) }}</td>
                                    <td class="text-right">
                                        @if(!$data->evidence_complete)
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#evidenceModal{{ $data->id }}">Add Evidences</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#selectEvidenceModal{{ $data->id }}">Add Evidences from File Repo</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewEvidences{{ $data->id }}">View Evidence List</a>
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
                                                            <label class="form-control-label" style="float: left">Select File(s)</label>
                                                            <input type="hidden" name="accreditation" value="{{ $accreditation->id }}">
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
                                        <div class="modal fade" id="selectEvidenceModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="selectEvidenceModal{{ $data->id }}Label" aria-hidden="true">
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
                                        <div class="modal fade" id="viewEvidences{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="viewEvidences{{ $data->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewEvidences{{ $data->id }}Label">Evidences of {{ $data->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        {!! '<span class="badge badge-dot mr-4"><i class="bg-info"></i> '. $data->evidences->implode('file_name', '</span><br> <span class="badge badge-dot mr-4"><i class="bg-info"></i> ') . '</span>' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
    <div class="modal fade" id="selectModal1" tabindex="-1" role="dialog" aria-labelledby="selectModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectModalLabel">Select Appendix/Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" id="outline_select" action="{{ route('accreditation.recommendation.evidence.select', $accreditation) }}" autocomplete="off">
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Appendix/Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{ route('accreditation.recommendation.evidence.upload', $accreditation) }}" autocomplete="off">
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
                            <label class="form-control-label">File(s)</label>
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
</div>
@endsection

@push('js')
<script src="/vendor/nestable/jquery.nestable.min.js"></script>
<link href="/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="{{ asset('js/dataTables.js') }}"></script>
<script>
$(document).ready(function () {
    var dataTable = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('show.file.repo') }}",
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
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
    $('#addRecommendation').click(function (e) { //on add input button click
        var Recommendations = $("#Recommendations .row").length;
        $("#Recommendations").append('<div class="row"><div class="col-8"><div class="form-group mb-3"><div class="input-group input-group-alternative"><input class="form-control recommendation" placeholder="Evidence List" name="evidence_list['+Recommendations+']" type="text"></div></div></div><div class="col-1"><button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button></div></div>');
    });

    $("body").on("click",".removeRecommendation", function(e) { //user click on remove text
        if( $("#Recommendations .row").length >= 1 ) {
            $(this).parent().closest('.row').remove();
            var x = 0;
            $("#Recommendations .row").each(function() {
                var recommendation = $(this).find("input.recommendation");
                recommendation.attr('name', 'evidence_list['+x+']');
                x++;
            });
        }
        return false;
    });
});
</script>
@endpush