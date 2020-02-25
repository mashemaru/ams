@extends('layouts.app', ['title' => __('Team Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Team Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary mr-3">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('team.store.accreditation', $accreditation) }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('team_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-team_name">{{ __('Team Name') }}</label>
                                        <input type="text" name="team_name" id="input-team_name" class="form-control form-control-alternative{{ $errors->has('team_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Team Name') }}" value="{{ old('team_name') }}" required>

                                        @if ($errors->has('team_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('team_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('team_head') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-team_head">{{ __('Team Head') }}</label>
                                        <select id="input-team_head" class="form-control form-control-alternative{{ $errors->has('team_head') ? ' is-invalid' : '' }}" placeholder="{{ __('Team Head') }}" name="team_head" required>
                                            <option value>Select Team Head</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}" {{ ($user->id == old('team_head')) ? 'selected="selected"' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('team_head'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('team_head') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Team Members') }}</label>
                                <select class="form-control form-control-alternative select2" name="team_members[]" data-toggle="select" multiple data-placeholder="Select team member">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="text-right">
                                <button type="submit" name="save_create" class="btn btn-default">Save &amp; Create New Team</button>
                                <button type="submit" name="save_next" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection