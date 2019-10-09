@extends('layouts.app', ['title' => __('Document Outlines')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Document')])   

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
                    <div class="card-body px-lg-5 py-lg-5">
                        <form id="document" method="post" action="{{ route('document.store') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="sections">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('agency_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agency_id">{{ __('Agency') }}</label>
                                        <select class="form-control form-control-alternative{{ $errors->has('agency_id') ? ' is-invalid' : '' }}" name="agency_id" required autofocus>
                                            @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->agency_name }}</option>
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
                                        <input type="text" name="document_name" id="input-document_name" class="form-control form-control-alternative{{ $errors->has('document_name') ? ' is-invalid' : '' }}" placeholder="{{ __('e.g. ABET CAC Self-Survey Report') }}" value="{{ old('document_name') }}" required>

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
                                    <li class="dd-item" data-section data-id="1">
                                        <div class="form-inline">
                                            <div class="dd-handle"><i class="fas fa-arrows-alt"></i></div>
                                            <div class="form-group mr-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control section" placeholder="Section" type="text">
                                            </div>
                                            </div>
                                            <div class="form-group mr-3">
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control score">
                                                    <option value="1">Narrative</option>
                                                    <option value="2">Score Type 1</option>
                                                    <option value="3">Score Type 2</option>                   
                                                </select>
                                            </div>
                                            </div>
                                            <button class="btn btn-icon btn-2 btn-danger" type="button">x</button>
                                        </div>
                                    </li>
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
var listCount = $('#dd-list .dd-item').length;
$(function () {
    $('.dd').nestable({
        group: 1,
        maxDepth: 10,
        expandBtnHTML: '',
        collapseBtnHTML: '',
    });
});
function addSection(){
    listCount++;
    var x = '<li class="dd-item" data-section data-id="'+listCount+'"><div class="form-inline"><div class="dd-handle"><i class="fas fa-arrows-alt"></i></div><div class="form-group mr-3"><div class="input-group input-group-alternative"><input class="form-control section" placeholder="Section" type="text"></div></div><div class="form-group mr-3"><div class="input-group input-group-alternative"><select class="form-control score"><option value="1">Narrative</option><option value="2">Score Type 1</option><option value="3">Score Type 2</option></select></div></div><button class="btn btn-icon btn-2 btn-danger" type="button">x</button></div></li>';
    document.getElementById('dd-list').insertAdjacentHTML('beforeend', x);
}
$('#dd-list').on('input', 'input.section', function () {
    $(this).closest('.dd-item').data( 'section', this.value );
});
$('#dd-list').on('change', 'select.score', function () {
    $(this).closest('.dd-item').data( 'score', this.value );
});
</script>
@endpush