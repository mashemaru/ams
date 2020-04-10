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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('agency_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-agency_id">{{ __('Agency') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('agency_id') ? ' is-invalid' : '' }}" name="agency_id" disabled autofocus>
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
                                    <input type="text" name="document_name" id="input-document_name" class="form-control form-control-alternative{{ $errors->has('document_name') ? ' is-invalid' : '' }}" placeholder="{{ __('e.g. ABET CAC Self-Survey Report') }}" value="{{ old('document_name', $document->document_name) }}" disabled>

                                    @if ($errors->has('document_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('document_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if(isset($document->sections))
                            <ul class="dd-list">
                                {!! renderViewDocumentSections(json_decode($document->sections)) !!}
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection