@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Course Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="{{ route('course.store') }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('course_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-course_name">{{ __('Course Name') }}</label>
                                        <input type="text" name="course_name" id="input-course_name" class="form-control form-control-alternative{{ $errors->has('course_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Course Name') }}" value="{{ old('course_name') }}" required>

                                        @if ($errors->has('course_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('course_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('course_code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-course_code">{{ __('Course Code') }}</label>
                                        <input type="text" name="course_code" id="input-course_code" class="form-control form-control-alternative{{ $errors->has('course_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Course Code') }}" value="{{ old('course_code') }}" required>

                                        @if ($errors->has('course_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('course_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Hard Prerequisite') }}</label>
                                        <select class="form-control form-control-alternative select2" name="hardPrerequisite[]" data-toggle="select" multiple data-placeholder="Select hard prerequisite">
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Soft Prerequisite') }}</label>
                                        <select class="form-control form-control-alternative select2" name="softPrerequisite[]" data-toggle="select" multiple data-placeholder="Select soft prerequisite">
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Co Rerequisite') }}</label>
                                        <select class="form-control form-control-alternative select2" name="coRequisite[]" data-toggle="select" multiple data-placeholder="Select co rerequisite">
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Syllabus') }}</label>
                                        <input type="file" class="form-control form-control-alternative" name="syllabus">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group text-center">
                                        <label class="form-control-label">{{ __('Academic') }}</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="academic" class="custom-control-input" id="academic">
                                            <label class="custom-control-label" for="academic"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Units') }}</label>
                                        <input class="form-control" name="units" type="number" placeholder="0.00" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Faculty Members') }}</label>
                                        <select class="form-control form-control-alternative select2" name="faculty_members[]" data-toggle="select" multiple data-placeholder="Select faculty member">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection