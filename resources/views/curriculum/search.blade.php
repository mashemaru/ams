@extends('layouts.app', ['title' => __('Curriculum Management')])

@section('content')
    {{-- @include('layouts.headers.cards') --}}
    <div class="header bg-gradient-primary py-7 py-lg-8">
        @if ($number_course_type)
        <div class="container">
            <div class="header-body text-center">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h1 class="text-white">Total Number of courses per type in a curriculum as of <small><em>{{ now()->setTimezone('Asia/Singapore')->toDayDateTimeString() }}</em></small></h1>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Curriculum Search') }}</h3>
                            </div>
                            @if(request()->get('query'))
                            {{-- <div class="col-4 text-right">
                                <form method="post" action="{{ route('curriculum.search-download') }}" class="float-right">
                                    @csrf
                                    <input type="hidden" name="query" value="{{ request()->get('query') }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Download</button>
                                </form>
                            </div> --}}
                            @endif
                        </div>
                    </div>
                    <form method="get" action="{{ route('curriculum.search') }}" autocomplete="off">
                    <div class="card-body">
                        <select class="form-control form-control-alternative" name="query">
                            <option value>Select Search</option>
                            <option value="number_course_type"{{ (request()->get('query') == 'number_course_type') ? ' selected' : '' }}>Total no of courses per type in a curriculum</option>
                            {{-- <option value="professional_experience"{{ (request()->get('query') == 'professional_experience') ? ' selected' : '' }}>Professional Experience</option> --}}
                        </select>
                    </div>
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <a href="{{ route('curriculum.search') }}" class="btn btn-warning">Reset</a>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @if ($number_course_type)
                @include('curriculum.search.number_course_type')
            @endif

        </div>
        @include('layouts.footers.auth')
    </div>
@endsection