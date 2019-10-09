@extends('layouts.app', ['title' => __('Program Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Program')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Program Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('program.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('program.update', $program) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('program_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-program_name">{{ __('Program Name') }}</label>
                                    <input type="text" name="program_name" id="input-program_name" class="form-control form-control-alternative{{ $errors->has('program_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Program Name') }}" value="{{ old('program_name', $program->program_name) }}" required>

                                    @if ($errors->has('program_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('program_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-program_code">{{ __('Program Code') }}</label>
                                    <input type="text" name="program_code" id="input-program_code" class="form-control form-control-alternative{{ $errors->has('program_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Program Name') }}" value="{{ old('program_code', $program->program_code) }}" required>

                                    @if ($errors->has('program_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program_code') }}</strong>
                                        </span>
                                    @endif
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