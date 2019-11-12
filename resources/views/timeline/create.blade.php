@extends('layouts.app', ['title' => __('Timeline Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Timeline Management') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-lg-5">
                        <form method="post" action="{{ route('timeline.store', $accreditation) }}" autocomplete="off">
                            @csrf
                            <button type="button" class="btn btn-success mb-3" id="addTimeline">+</button>
                            <div id="TimelineWrapper">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control" placeholder="Task" type="text" name="task[0][task]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control datepicker" data-date-format="mm/dd/yyyy" placeholder="Select date" name="task[0][date]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-icon btn-2 btn-danger removeTimeline" type="button">X</button>
                                    </div>
                                </div>
                            </div>
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
$('#addTimeline').click(function (e) { //on add input button click
    $('#addCurriculumfield').attr("disabled", true);
    var TimelineWrapper = $("#TimelineWrapper .row").length;
    $("#TimelineWrapper").append('<div class="row"><div class="col-6"><div class="form-group mb-3"><div class="input-group input-group-alternative"><input class="form-control task" placeholder="Task" type="text" name="task['+TimelineWrapper+'][task]"></div></div></div><div class="col-3"><div class="form-group"><div class="input-group input-group-alternative"><input class="form-control datepicker" data-date-format="mm/dd/yyyy" placeholder="Select date" name="task['+TimelineWrapper+'][date]"></div></div></div><div class="col-1"><button class="btn btn-icon btn-2 btn-danger removeTimeline" type="button">X</button></div></div>');
    $(".datepicker").datepicker();
});

$("body").on("click",".removeTimeline", function(e) { //user click on remove text
    if( $("#TimelineWrapper .row").length >= 1 ) {
        $(this).parent().closest('.row').remove();
        var x = 0;
        $("#TimelineWrapper .row").each(function() {
            var task = $(this).find("input.task");
            task.attr('name', 'task['+x+'][task]');
            var datepicker = $(this).find("input.datepicker");
            datepicker.attr('name', 'task['+x+'][date]');
            x++;
        });
    }
    return false;
});
</script>
@endpush