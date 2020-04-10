@extends('layouts.app', ['title' => __('File Repository Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('File Repository') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Add File
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul class="m-0 pl-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table data-table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('File') }}</th>
                                    <th scope="col">{{ __('File Type') }}</th>
                                    <th scope="col">{{ __('Uploaded By') }}</th>
                                    <th scope="col">{{ __('Uploaded on') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{ route('file-repository.upload') }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-control-label">File Name</label>
                        <div class="input-group input-group-alternative">
                            <input class="form-control form-control-alternative" name="fileName" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label">Select File</label>
                        <div class="input-group input-group-alternative">
                            <input type="file" class="form-control form-control-alternative" name="file">
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
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<link href="/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="{{ asset('js/dataTables.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('file-repository.index') }}",
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'file', name: 'file'},
                {data: 'file_type', name: 'file_type'},
                {data: 'user_id', name: 'user_id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
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
    });
</script>
@endpush