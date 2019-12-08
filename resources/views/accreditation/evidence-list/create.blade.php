@extends('layouts.app', ['title' => __('Evidence List')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Evidence List') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('accreditation.evidence_list', $accreditation) }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="text-muted text-left mt-2 mb-3">
                                {{-- Recommendations<br><br> --}}
                                <button type="button" class="btn btn-success" id="addRecommendation">Add</button><br>
                            </div><br>
                            <div id="Recommendations">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control recommendation" placeholder="Evidence List" name="evidence_list[0]" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button>
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
@push('js')
<script>
$('#addRecommendation').click(function (e) { //on add input button click
    var Recommendations = $("#Recommendations .row").length;
    $("#Recommendations").append('<div class="row"><div class="col-8"><div class="form-group mb-3"><div class="input-group input-group-alternative"><input class="form-control recommendation" placeholder="Evidence List" name="evidence_list['+Recommendations+']" type="text"></div></div></div><div class="col-1"><button class="btn btn-icon btn-2 btn-danger removeRecommendation" type="button">X</button></div></div>');
});

$("body").on("click",".removeRecommendation", function(e) { //user click on remove text
    if( $("#Recommendations .row").length >= 1 ) {
        $(this).parent().closest('.row').remove();
        var x = 0;
        $("#Recommendations .row").each(function() {
            var recommendation = $(this).find("input.recommendation");
            recommendation.attr('name', 'evidence_list['+x+']');
            x++;
        });
    }
    return false;
});
</script>
@endpush