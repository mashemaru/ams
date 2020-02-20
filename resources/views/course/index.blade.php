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
                                <button type="button" class="btn btn-primary btn-sm mr-4 float-right" data-toggle="modal" data-target="#reminderModal">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Remind All Syllabus Update
                                </button>
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
        
        <!-- Modal -->
        <div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="reminderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reminderModalLabel">Schedule Reminder for Syllabus Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="{{ route('course.remindAll') }}" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group{{ $errors->has('number_freq') ? ' has-danger' : '' }} mb-3">
                                <label class="form-control-label" for="input-name">{{ __('Day') }}</label>  <small>0 daily | 0 (sun) - 6 (sat) Weekly | 1 - 31 (day) Monthly</small>
                                <input type="number" name="number_freq" id="input-name" class="form-control form-control-alternative{{ $errors->has('number_freq') ? ' is-invalid' : '' }}" placeholder="{{ __('Day') }}" value="{{ old('number_freq', ($notifs) ?? $notifs->number_freq) }}" required autofocus>
                                @if ($errors->has('number_freq'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number_freq') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Frequency') }}</label>
                                <select class="form-control form-control-alternative" name="frequency">
                                    <option value="daily"{{ ($notifs) ?? (($notifs->frequency == 'daily') ? ' selected' : '') }}>Everyday</option>
                                    <option value="weekly"{{ ($notifs) ?? (($notifs->frequency == 'weekly') ? ' selected' : '') }}>Weekly</option>
                                    <option value="monthly"{{ ($notifs) ?? (($notifs->frequency == 'monthly') ? ' selected' : '') }}>Monthly</option>
                                </select>
                            </div>
                            <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                <input class="custom-control-input" name="enabled" id="enabled" type="checkbox" {{ old('enabled', ($notifs) ?? ($notifs->enabled) ? 'checked' : '') }}>
                                <label class="custom-control-label" for="enabled">Enabled</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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