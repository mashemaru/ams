@extends('layouts.app', ['title' => __('Curriculum Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Curriculum for ') . $curriculum->program->program_name }} {{ $curriculum->start_year }} - {{ $curriculum->end_year }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('curriculum.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    @foreach ($terms as $key => $term)
                        <table class="table align-items-center table-flush">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="7" style="text-align: center; color: #DDDDDD">TERM {{ $key }}</th>
                                </tr>
                            </thead>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Course Title</th>
                                    <th scope="col">Prerequisites(Hard)</th>
                                    <th scope="col">Prerequisites(Soft)</th>
                                    <th scope="col">Co-requisites</th>
                                    <th scope="col">Number of Units</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($term as $t)
                                <tr>
                                    <th scope="row">{{ $t->course_code }}</th>
                                    <td>{{ $t->course_name }}</td>
                                    <td>{{ $t->courseHardPreq->implode('course_code', ', ') }}</td>
                                    <td>{{ $t->courseSoftPreq->implode('course_code', ', ') }}</td>
                                    <td>{{ $t->courseCoReq->implode('course_code', ', ') }}</td>
                                    <td>{{ $t->units }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('course.show', $t) }}">View Course</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection