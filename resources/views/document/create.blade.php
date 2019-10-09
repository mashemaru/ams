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
                    <div class="card-body">
                        <form method="post" action="{{ route('document.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('program_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-program_name">{{ __('Program Name') }}</label>
                                    <input type="text" name="program_name" id="input-program_name" class="form-control form-control-alternative{{ $errors->has('program_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Program Name') }}" value="{{ old('program_name') }}" required autofocus>

                                    @if ($errors->has('program_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('program_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-program_code">{{ __('Program Code') }}</label>
                                    <input type="text" name="program_code" id="input-program_code" class="form-control form-control-alternative{{ $errors->has('program_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Program Code') }}" value="{{ old('program_code') }}" required autofocus>

                                    @if ($errors->has('program_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program_code') }}</strong>
                                        </span>
                                    @endif
                                </div>

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
                                                        <option value="narrative">Narrative</option>
                                                        <option value="score1">Score Type 1</option>
                                                        <option value="score2">Score Type 2</option>                   
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
    var x = '<li class="dd-item" data-section data-id="'+listCount+'"><div class="form-inline"><div class="dd-handle"><i class="fas fa-arrows-alt"></i></div><div class="form-group mr-3"><div class="input-group input-group-alternative"><input class="form-control section" placeholder="Section" type="text"></div></div><div class="form-group mr-3"><div class="input-group input-group-alternative"><select class="form-control score"><option value="narrative">Narrative</option><option value="score1">Score Type 1</option><option value="score2">Score Type 2</option></select></div></div><button class="btn btn-icon btn-2 btn-danger" type="button">x</button></div></li>';
    document.getElementById('dd-list').insertAdjacentHTML('beforeend', x);
}
$('#dd-list').on('input', 'input.section', function () {
    $(this).closest('.dd-item').data( 'section', this.value );
});
$('select.score').change(function(){
    $(this).closest('.dd-item').data( 'score', this.value );
});
</script>
@endpush