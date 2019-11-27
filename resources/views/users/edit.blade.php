@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="row text-center">
                                <div class="col-lg-5"><h4 class="heading-small text-muted mb-4">{{ __('User information') }}</h4></div>
                                <div class="col-lg-7"><h4 class="heading-small text-muted mb-4">{{ __('User permission') }}</h4></div>
                            </div>
                            
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group{{ ($errors->has('firstname') || $errors->has('mi') || $errors->has('surname')) ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <div class="input-group input-group-alternative mb-3" id="input-name">
                                                <input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative col-5{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="Given Name" value="{{ old('firstname', $user->firstname) }}">
                                                <input type="text" name="mi" id="input-mi" class="form-control form-control-alternative col-2{{ $errors->has('mi') ? ' is-invalid' : '' }}" placeholder="M.I." value="{{ old('mi', $user->mi) }}">
                                                <input type="text" name="surname" id="input-surname" class="form-control form-control-alternative col-5{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="Surname" value="{{ old('surname', $user->surname) }}">
                                            </div>
                                            @if ($errors->has('firstname'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('mi'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('mi') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('surname'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('surname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
                                            <select id="input-gender" class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="{{ __('Gender') }}" name="gender" required>
                                                <option value>Select Gender</option>
                                                <option value="male"{{ ($user->gender == 'male') ? ' selected' : '' }}>Male</option>
                                                <option value="female"{{ ($user->gender == 'female') ? ' selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-college">{{ __('College') }}</label>
                                            <input class="form-control form-control-alternative" id="input-college" name="college" placeholder="College" type="text" value="{{ old('college', $user->college) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-department">{{ __('Department') }}</label>
                                            <input class="form-control form-control-alternative" id="input-department" name="department" placeholder="Department" type="text" value="{{ old('department', $user->department) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-rank">{{ __('Faculty Classification') }}</label>
                                            <select class="form-control form-control-alternative{{ $errors->has('rank') ? ' is-invalid' : '' }}" name="rank">
                                                <option value>Select Rank</option>
                                                <option value="FT"{{ ($user->rank == 'FT') ? ' selected' : '' }}>FT</option>
                                                <option value="PT"{{ ($user->rank == 'PT') ? ' selected' : '' }}>PT</option>
                                                <option value="ASF"{{ ($user->rank == 'ASF') ? ' selected' : '' }}>ASF</option>
                                            </select>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                            <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Roles') }}</label>
                                            <select class="scoring_type form-control form-control-alternative select2" name="roles[]" data-toggle="select" multiple data-placeholder="Select roles">
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}" @foreach($user->roles as $user_role) {{ ($user_role->id == $role->id) ? 'selected="selected"' : '' }} @endforeach>{{ $role->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="row justify-content-center">
                                            @foreach ($permissions as $permission)
                                                <div class="mt-3 col-md-4">
                                                    <label class="form-control-label d-block" for="input-name">{{ ucfirst($permission) }}</label>
                                                    <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                                        <input class="custom-control-input" name="permission[]" id="create-{{ $permission }}" type="checkbox" value="create {{ $permission }}"{{ ($user->hasDirectPermission('create ' . $permission)) ? ' checked' : '' }}>
                                                        <label class="custom-control-label" for="create-{{ $permission }}">create {{ $permission }}</label>
                                                    </div>
                                                    <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                                        <input class="custom-control-input" name="permission[]" id="edit-{{ $permission }}" type="checkbox" value="edit {{ $permission }}"{{ ($user->hasDirectPermission('edit ' . $permission)) ? ' checked' : '' }}>
                                                        <label class="custom-control-label" for="edit-{{ $permission }}">edit {{ $permission }}</label>
                                                    </div>
                                                    <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                                        <input class="custom-control-input" name="permission[]" id="view-{{ $permission }}" type="checkbox" value="view {{ $permission }}"{{ ($user->hasDirectPermission('view ' . $permission)) ? ' checked' : '' }}>
                                                        <label class="custom-control-label" for="view-{{ $permission }}">view {{ $permission }}</label>
                                                    </div>
                                                    <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                                        <input class="custom-control-input" name="permission[]" id="delete-{{ $permission }}" type="checkbox" value="delete {{ $permission }}"{{ ($user->hasDirectPermission('delete ' . $permission)) ? ' checked' : '' }}>
                                                        <label class="custom-control-label" for="delete-{{ $permission }}">delete {{ $permission }}</label>
                                                    </div> 
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
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