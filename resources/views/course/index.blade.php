@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Course Overview') }}</h3>
                            </div>
                            <div class="col-3 text-right">
                                <form method="post" action="{{ route('course.remindAll') }}" class="d-inline" autocomplete="off">
                                @csrf
                                    <button type="submit" class="btn btn-primary btn-sm mr-4 float-right">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        Remind All Syllabus Update
                                    </button>
                                </form>
                            </div>
                            <div class="col-1 text-right">
                                <a href="{{ route('course.create') }}" class="btn btn-success btn-sm"><span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Course</a>
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
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('Course Name') }}</th>
                                    <th scope="col">{{ __('Course Code') }}</th>
                                    <th scope="col">{{ __('PreRequisite') }}</th>
                                    {{-- <th scope="col">{{ __('Soft PreRequisite') }}</th> --}}
                                    <th scope="col">{{ __('Co Requisite') }}</th>
                                    <th scope="col">{{ __('Units') }}</th>
                                    <th scope="col"></th>
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
        // var e = $(".data-table");
        // e.length && e.on("init.dt", function() {
        //     $("div.dataTables_length select").removeClass("custom-select custom-select-sm")
        // });
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('course.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'course_name', name: 'course_name'},
                {data: 'course_code', name: 'course_code'},
                {data: 'courseHardPreq', name: 'courseHardPreq.course_code', orderable: false, searchable: false},
                // {data: 'courseSoftPreq', name: 'courseSoftPreq.course_code', orderable: false, searchable: false},
                {data: 'courseCoReq', name: 'courseCoReq.course_code', orderable: false, searchable: false},
                {data: 'units', name: 'units'},
                {data: 'is_academic', name: 'is_academic'},
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