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
                            <div class="col-4 text-right">
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
                                    <th scope="col">{{ __('Course Name') }}</th>
                                    <th scope="col">{{ __('Course Code') }}</th>
                                    <th scope="col">{{ __('Hard PreRequisite') }}</th>
                                    <th scope="col">{{ __('Soft PreRequisite') }}</th>
                                    <th scope="col">{{ __('Co Requisite') }}</th>
                                    <th scope="col">{{ __('Units') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->course_code }}</td>
                                        <td>
                                            @foreach($course->courseHardPreq as $c)
                                                <span class="badge badge-dot mr-4"><i class="bg-info"></i> {{ $c->course_code }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($course->courseSoftPreq as $c)
                                                <span class="badge badge-dot mr-4"><i class="bg-info"></i> {{ $c->course_code }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($course->courseCoReq as $c)
                                                <span class="badge badge-dot mr-4"><i class="bg-info"></i> {{ $c->course_code }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>{{ $course->units }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('course.destroy', $course) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="dropdown-item" href="{{ route('course.show', $course) }}">{{ __('View Course') }}</a>
                                                        <a class="dropdown-item" href="{{ route('course.edit', $course) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this course?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
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
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/vendor/datatables/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.bootstrap4.min.js"></script>
<script src="/vendor/datatables/buttons.html5.min.js"></script>
<script src="/vendor/datatables/buttons.flash.min.js"></script>
<script src="/vendor/datatables/buttons.print.min.js"></script>
<script src="/vendor/datatables/dataTables.select.min.js"></script>
<script type="text/javascript">
    $(function () {
        var e = $(".data-table");
        e.length && e.on("init.dt", function() {
            $("div.dataTables_length select").removeClass("custom-select custom-select-sm")
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('course.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            keys: !0,
            select: {
                style: "multi"
            },
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