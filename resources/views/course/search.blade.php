@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ __('Course Search') }}</h3>
                    </div>
                    <form method="get" action="{{ route('course.search') }}" autocomplete="off">
                    <div class="card-body">
                        {{-- <select class="form-control form-control-alternative" name="query">
                            <option value>Select Search</option>
                            <option value="teaching_experience"{{ (request()->get('query') == 'teaching_experience') ? ' selected' : '' }}>Teaching Experience</option>
                            <option value="professional_experience"{{ (request()->get('query') == 'professional_experience') ? ' selected' : '' }}>Professional Experience</option>
                        </select> --}}
                        <div class="card mb-4">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">Course Type</h5>
                            </div>
                            <div class="card-body">
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="course_type[]" id="general_course_type" type="checkbox" value="general"{{ (request()->get('course_type') !== null && in_array('general', request()->get('course_type'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="general_course_type">General</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="course_type[]" id="major_course_type" type="checkbox" value="major"{{ (request()->get('course_type') !== null && in_array('major', request()->get('course_type'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="major_course_type">Major</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="course_type[]" id="professional_course_type" type="checkbox" value="professional"{{ (request()->get('course_type') !== null && in_array('professional', request()->get('course_type'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="professional_course_type">Professional elective</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="course_type[]" id="free_course_type" type="checkbox" value="free"{{ (request()->get('course_type') !== null && in_array('free', request()->get('course_type'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="free_course_type">Free elective</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="course_type[]" id="core_course_type" type="checkbox" value="core"{{ (request()->get('course_type') !== null && in_array('core', request()->get('course_type'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="core_course_type">Core subject</label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h5 class="mb-0">College</h5>
                            </div>
                            <div class="card-body">
                                @foreach($college as $c)
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                    <input class="custom-control-input" name="college[]" id="college-{{ $c->id }}" type="checkbox" value="{{ $c->college }}"{{ (request()->get('college') !== null && in_array( $c->college, request()->get('college'))) ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="college-{{ $c->id }}">{{ $c->college }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <a href="{{ route('course.search') }}" class="btn btn-warning">Reset</a>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @if($courses)
            <div class="col-9">
                <div class="card shadow">
                    <div class="table-responsive">
                        @include('course.partials.result')
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $courses->appends(request()->except('page'))->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection