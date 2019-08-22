@extends('layouts.app', ['title' => __('Agency Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Agency')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Agency Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('agency.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('agency.update', $agency) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('agency_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-agency_name">{{ __('Agency Name') }}</label>
                                    <input type="text" name="agency_name" id="input-agency_name" class="form-control form-control-alternative{{ $errors->has('agency_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency Name') }}" value="{{ old('agency_name', $agency->agency_name) }}" required>

                                    @if ($errors->has('agency_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_name') }}</strong>
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