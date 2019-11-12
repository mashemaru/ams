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
                                <h3 class="mb-0">{{ __('Curriculum Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('curriculum.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-lg-5">
                        <form method="post" action="{{ route('curriculum.store') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3"{{ $errors->has('program_id') ? ' has-danger' : '' }}>
                                        <label class="form-control-label">Degree Program</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control form-control-alternative{{ $errors->has('program_id') ? ' is-invalid' : '' }}" name="program_id" required>
                                                <option value>Select Program</option>
                                                @foreach ($program as $p)
                                                <option value="{{ $p->id }}">{{ $p->program_name }}</option> 
                                                @endforeach
                                            </select>
                                            @if ($errors->has('program_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('program_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3"{{ $errors->has('term') ? ' has-danger' : '' }}>
                                        <label class="form-control-label">Academic Term</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control form-control-alternative{{ $errors->has('term') ? ' is-invalid' : '' }}" name="term" required>
                                                <option value="semester">Semester</option> 
                                                <option value="trimester">Trimester</option>
                                                <option value="quarter">Quarter</option>            
                                            </select>
                                            @if ($errors->has('term'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('term') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group{{ $errors->has('start_year') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Start</label>
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control datepicker{{ $errors->has('start_year') ? ' is-invalid' : '' }}" name="start_year" placeholder="Select Start Year" type="text" value="{{ old('start_year') }}" required>
                                            @if ($errors->has('start_year'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('start_year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group{{ $errors->has('end_year') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">End</label>
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control datepicker{{ $errors->has('end_year') ? ' is-invalid' : '' }}" name="end_year" placeholder="Select End Year" type="text" value="{{ old('end_year') }}" required>
                                            @if ($errors->has('end_year'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <button type="button" class="btn btn-success mb-3" id="addCurriculumfield">+</button>
                            <div id="CoursesWrapper"></div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script>
$(".datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});

$('#addCurriculumfield').click(function (e) { //on add input button click
    $('#addCurriculumfield').attr("disabled", true);
    var CoursesWrapper = ++$("#CoursesWrapper .row").length;
    $.ajax({
        dataType: 'json',
        url: "/getCurriculumCourses/" + CoursesWrapper,
    }).done(function(data) {
        $("#CoursesWrapper").append(data);
        $('.select2').select2();
    }).always(function() {
        $('#addCurriculumfield').attr("disabled", false);
    });
});

$("body").on("click",".removeCurriculumfield", function(e) { //user click on remove text
    if( $("#CoursesWrapper .row").length >= 1 ) {
        $(this).parent().closest('.row').remove(); //remove text box
        var x = 1;
        $("#CoursesWrapper .row").each(function() {
            var selectCourses = $(this).find("select.select2");
            selectCourses.attr('name', 'courses['+x+'][]');
            selectCourses.data('placeholder', 'Select Academic Term ' + x );
            var spanCourses = $(this).find(".select2-search__field");
            spanCourses.attr('placeholder', 'Select Academic Term ' + x );
            x++;
        });
    }
    return false;
});
</script>
@endpush