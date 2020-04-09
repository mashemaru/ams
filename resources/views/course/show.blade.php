@extends('layouts.app', ['title' => $course->course_name])

@section('content')
    @include('users.partials.header')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col">
                        <h3 class="mb-0">{{ $course->course_name }}</h3>
                        </div>
                        <div class="col text-right">
                        <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="float:right"{{ (auth()->check() && auth()->user()->hasAnyRole('department-staff|department-secretary')) ? '' : ' disabled' }}>
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                            Update Syllabus
                        </button>
                        </div>

                        @if(auth()->check() && auth()->user()->hasAnyRole('department-staff|department-secretary'))
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form enctype="multipart/form-data" method="post" action="{{ route('courseSyllabus.update', $course) }}" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Syllabus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form">
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Select File</label>
                                            <div class="input-group input-group-alternative">
                                            <input class="form-control form-control-alternative" type="file" name="syllabus">
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                <br>
                <h6 class="heading-small text-muted mb-4">Basic Information</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Course Name</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{{ $course->course_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Course Code</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{{ $course->course_code }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">No. of Units</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{{ $course->units }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Course Type</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{{ $course->course_type }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">College</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{{ $course->college }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Department</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">[department here]</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Academic</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">{!! ($course->is_academic) ? '<span class="badge badge-lg badge-success">Academic</span>' : '<span class="badge badge-lg badge-dark">Non-academic</span>' !!}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <p class="mb-3 text-sm text-muted">Hard Pre Requisites</p>
                            </div>
                            <div class="col-7">
                                <p class="mb-0 text-sm font-weight-bold">
                                @if($course->courseHardPreq->isNotEmpty())
                                    {{ $course->courseHardPreq->implode('course_code', ', ') }}
                                @else
                                    N/A
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Soft Pre Requisites</p>
                            </div>
                            <div class="col-7">
                                <p class="mb-0 text-sm font-weight-bold">
                                @if($course->courseSoftPreq->isNotEmpty())
                                    {{ $course->courseSoftPreq->implode('course_code', ', ') }}
                                @else
                                    N/A
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Co Requisites</p>
                            </div>
                            <div class="col-7">
                                <p class="mb-0 text-sm font-weight-bold">
                                @if($course->courseCoReq->isNotEmpty())
                                    {{ $course->courseCoReq->implode('course_code', ', ') }}
                                @else
                                    N/A
                                @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Syllabus</p>
                            </div>
                            <div class="col-7">
                                <form method="post" action="{{ route('course.syllabus', $course) }}" autocomplete="off">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm border-0">{{ $course->syllabus }}</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            <p class="mb-3 text-sm text-muted">Description</p>
                            </div>
                            <div class="col-7">
                            <p class="mb-0 text-sm font-weight-bold">[description here]</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        {{-- <br>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header border-0">
                <div class="row">
                    <div class="col">
                    <h3 class="mb-0">Faculty</h3>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">College</th>
                            <th scope="col">Department</th>
                            <th scope="col">Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->faculty as $faculty)
                            <tr>
                            <td>{{ $faculty->name }}</td>
                            <td>{{ $faculty->college }}</td>
                            <td>{{ $faculty->department }}</td>
                            <td>{{ $faculty->rank }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            </div>
        </div> --}}
        <br>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header border-0">
                <div class="row">
                    <div class="col">
                    <h3 class="mb-0">Syllabus History</h3>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Filename</th>
                                <th scope="col">Uploaded by</th>
                                <th scope="col">Date Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->syllabus_history as $s)
                            <tr>
                                <td>{{ $s->syllabus }}</td>
                                <td>{{ $s->user->name }}</td>
                                <td>{{ $s->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            </div>
        </div>
    @include('layouts.footers.auth')
    </div>
@endsection