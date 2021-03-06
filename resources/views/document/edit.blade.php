@extends('layouts.app', ['title' => __('Document Outlines')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Document Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('document.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-lg-5">
                        <form id="document" method="post" action="{{ route('document.update', $document) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <input type="hidden" name="sections">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('agency_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agency_id">{{ __('Agency') }}</label>
                                        <select class="form-control form-control-alternative{{ $errors->has('agency_id') ? ' is-invalid' : '' }}" name="agency_id" required autofocus>
                                            <option value>Select Agency</option>
                                            @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}"{{ ($document->agency_id == $agency->id) ? ' selected' : '' }}>{{ $agency->agency_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('agency_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('document_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-document_name">{{ __('Document Name') }}</label>
                                        <input type="text" name="document_name" id="input-document_name" class="form-control form-control-alternative{{ $errors->has('document_name') ? ' is-invalid' : '' }}" placeholder="{{ __('e.g. ABET CAC Self-Survey Report') }}" value="{{ old('document_name', $document->document_name) }}" required>

                                        @if ($errors->has('document_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('document_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-default mb-4" onclick="addSection()">Add Section</button>
                            <div class="dd">
                                <ol id="dd-list" class="dd-list">
                                    {!! renderDocumentSections(json_decode($document->sections), $document->agency->score_types ) !!}
                                </ol>
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
        <div class="d-none agency-score-type">
            <option value='0'>Narrative Only</option>
            <optgroup label='Narrative w/ Table'><option value='0'>w/ Table</option></optgroup>
            <optgroup label='Narrative w/ Score'>
                @foreach($document->agency->score_types as $score)
                    <option value='{{ $score['id'] }}'>{{ $score['scoring_name'] }}</option>
                @endforeach
            </optgroup>
            <optgroup label='Narrative w/ Table & Score'>
                @foreach($document->agency->score_types as $score)
                    <option value='{{ $score['id'] }}'>{{ $score['scoring_name'] }}</option>
                @endforeach
            </optgroup>
        </div>
    </div>
@endsection

@push('js')
<script src="/vendor/nestable/jquery.nestable.min.js"></script>
<script>
$("#document button[type='submit']").click(function(e) {
    e.preventDefault();
    $('#document input[name="sections"]').val(JSON.stringify($(".dd").nestable('serialize')));
    $('#document').submit();
});
$(function () {
    $('.dd').nestable({
        group: 1,
        maxDepth: 10,
        expandBtnHTML: '',
        collapseBtnHTML: '',
    });
});
function addSection(){
    if($('select[name="agency_id"]').val()) {
        var scores = $( ".agency-score-type").html();
        var x = '<li class="dd-item" data-section> <div class="form-inline mb-3"> <div class="dd-handle"><i class="fas fa-arrows-alt"></i></div><div class="form-group mr-3"> <div class="input-group input-group-alternative"> <input class="form-control section" placeholder="Section" type="text"> </div></div><div class="form-group mr-3"> <div class="input-group input-group-alternative"> <select class="form-control score">'+scores+'</select> </div></div><button class="btn btn-icon btn-2 btn-danger removeclass" type="button">x</button><div class="flex-break"></div><textarea class="form-control doc-textarea" rows="3" placeholder="Description"></textarea> </div></li>';
        document.getElementById('dd-list').insertAdjacentHTML('beforeend', x);
    }
}
$('#dd-list').on('input', 'input.section', function () {
    $(this).closest('.dd-item').data( 'section', this.value );
});
$('#dd-list').on('change', 'select.score', function () {
    var opt = $(this).find(':selected').closest('optgroup').attr('label');
    $(this).closest('.dd-item').data( 'doc_type', opt );
    $(this).closest('.dd-item').data( 'score', this.value );
});
$('#dd-list').on('input', 'textarea.doc-textarea', function () {
    $(this).closest('.dd-item').data( 'description', this.value );
});
$('#document').on('change', 'select[name="agency_id"]', function () {
    $("#dd-list").html('');
    if(this.value) {
        $.getJSON( "/getAgencyScoring/" + this.value, function( data ) {
            var items = [];
            var score_type = [];
            $.each( data, function( key, value) {
                score_type.push( "<option value='" + value.id + "'>" +  value.name + "</option>" );
            });

            items.push( "<option value='0'>Narrative Only</option>" );
            items.push( "<optgroup label='Narrative w/ Table'><option value='0'>w/ Table</option></optgroup>" );
            items.push( "<optgroup label='Narrative w/ Score'>" + score_type.join() + "</optgroup>" );
            items.push( "<optgroup label='Narrative w/ Table & Score'>" + score_type.join() + "</optgroup>" );
            
            $( ".agency-score-type").html( items );
        });
    }
});
</script>
@endpush