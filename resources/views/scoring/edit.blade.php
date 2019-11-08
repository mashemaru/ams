@extends('layouts.app', ['title' => __('Scoring Type Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Scoring Type Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('scoring.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-lg-5">
                        <form method="post" action="{{ route('scoring.update', $scoring) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('scoring_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-scoring_name">{{ __('Scoring Name') }}</label>
                                        <input type="text" name="scoring_name" id="input-scoring_name" class="form-control form-control-alternative{{ $errors->has('scoring_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Scoring Name') }}" value="{{ old('scoring_name', $scoring->scoring_name) }}" required autofocus>

                                        @if ($errors->has('scoring_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('scoring_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('scoring_description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-scoring_description">{{ __('Scoring Description') }}</label>
                                        <input type="text" name="scoring_description" id="input-scoring_description" class="form-control form-control-alternative{{ $errors->has('scoring_description') ? ' is-invalid' : '' }}" placeholder="{{ __('Scoring Description') }}" value="{{ old('scoring_description', $scoring->scoring_description) }}" required>

                                        @if ($errors->has('scoring_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('scoring_description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mb-3" id="addfield">+</button>
                            <div id="InputsWrapper">
                                @foreach($scoring->scores as $key => $s)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                            <input class="form-control score" name="scoring[{{$key}}][score]" placeholder="Score" type="text" value="{{$s['score']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control description" name="scoring[{{$key}}][description]" placeholder="Description" type="text" value="{{$s['description']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-icon btn-2 btn-danger removeclass">x</button>
                                    </div>
                                </div>
                                @endforeach
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