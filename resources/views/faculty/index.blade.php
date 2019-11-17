@extends('layouts.app', ['title' => __('Faculty Information Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Faculty Information Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                
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
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Department') }}</th>
                                    <th scope="col">{{ __('Rank') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
            ajax: "{{ route('faculty.index') }}",
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'name', name: 'name'},
                {data: 'department', name: 'department'},
                {data: 'rank', name: 'rank'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order:[0,'desc'],
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            }
        });
    });
</script>
@endpush