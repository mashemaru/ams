@extends('layouts.app', ['title' => __('Roles & Permissions Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $role->label }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roles-permission.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-lg-0 px-lg-5 pb-lg-5">
                        <form method="post" action="{{ route('roles-permission.update', $role) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="mt-5">
                                <label class="form-control-label d-block" for="input-name">Name</label>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline">
                                    <input class="custom-control-input" id="customCheck2" type="checkbox">
                                    <label class="custom-control-label" for="customCheck2">Checked</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline">
                                    <input class="custom-control-input" id="customCheck3" type="checkbox">
                                    <label class="custom-control-label" for="customCheck3">Checked</label>
                                </div>
                                <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline">
                                    <input class="custom-control-input" id="customCheck4" type="checkbox">
                                    <label class="custom-control-label" for="customCheck4">Checked</label>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="form-control-label d-block" for="input-name">Name</label>
                                <div class="pl-md-4 custom-checkbox form-check form-check-inline">
                                    <input class="custom-control-input" id="customCheck3" type="checkbox">
                                    <label class="custom-control-label" for="customCheck3">Checked</label>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('agency_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agency_name">{{ __('Role Name') }}</label>
                                        <input type="text" name="agency_name" id="input-agency_name" class="form-control form-control-alternative{{ $errors->has('agency_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency Name') }}" value="{{ old('agency_name', $agency->agency_name) }}" required>

                                        @if ($errors->has('agency_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('agency_code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agency_code">{{ __('Agency Code') }}</label>
                                        <input type="text" name="agency_code" id="input-agency_code" class="form-control form-control-alternative{{ $errors->has('agency_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency Code') }}" value="{{ old('agency_code', $agency->agency_code) }}" required>

                                        @if ($errors->has('agency_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Scoring Type') }}</label>
                                <select class="scoring_type form-control form-control-alternative select2" name="scoring_type[]" data-toggle="select" multiple data-placeholder="Select scoring type">
                                    @foreach ($scoringType as $score)
                                        <option value="{{$score->id}}" @foreach($agency->score_types as $scoreType) {{ ($scoreType->id == $score->id) ? 'selected="selected"' : '' }} @endforeach>{{ $score->scoring_name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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