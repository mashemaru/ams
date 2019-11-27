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
                        <div class="accordion search-accordion" id="search-accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h5 class="mb-0">Course Type</h5>
                                </div>
                                <div id="collapseOne" class="collapse{{ (request()->get('course_type')) ? ' show' : '' }}" aria-labelledby="headingOne" data-parent="#search-accordion">
                                    <div class="card-body">
                                        <select class="form-control form-control-alternative" name="course_type">
                                            <option value>Select Course Type</option>
                                            <option value="general"{{ (request()->get('course_type') == 'general') ? ' selected' : '' }}>General</option>
                                            <option value="major"{{ (request()->get('course_type') == 'major') ? ' selected' : '' }}>Major</option>
                                            <option value="professional"{{ (request()->get('course_type') == 'professional') ? ' selected' : '' }}>Professional elective</option>
                                            <option value="free"{{ (request()->get('course_type') == 'free') ? ' selected' : '' }}>Free elective</option>
                                            <option value="core"{{ (request()->get('course_type') == 'core') ? ' selected' : '' }}>Core subject</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="mb-0">College</h5>
                                </div>
                                <div id="collapseTwo" class="collapse{{ (request()->get('college')) ? ' show' : '' }}" aria-labelledby="headingTwo" data-parent="#search-accordion">
                                    <div class="card-body">
                                        <select class="form-control form-control-alternative" name="college">
                                            <option value>Select College</option>
                                            @foreach($college as $c)
                                            <option value="{{ $c->college }}"{{ (request()->get('college') == $c->college) ? ' selected' : '' }}>{{ $c->college }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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