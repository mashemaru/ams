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
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="mt-5 col-md-3">
                                        <label class="form-control-label d-block" for="input-name">{{ ucfirst($permission) }}</label>
                                        <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                            <input class="custom-control-input" name="permission[]" id="create-{{ $permission }}" type="checkbox" value="create {{ $permission }}"{{ ($role->hasPermissionTo('create ' . $permission)) ? ' checked' : '' }}>
                                            <label class="custom-control-label" for="create-{{ $permission }}">create {{ $permission }}</label>
                                        </div>
                                        <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                            <input class="custom-control-input" name="permission[]" id="edit-{{ $permission }}" type="checkbox" value="edit {{ $permission }}"{{ ($role->hasPermissionTo('edit ' . $permission)) ? ' checked' : '' }}>
                                            <label class="custom-control-label" for="edit-{{ $permission }}">edit {{ $permission }}</label>
                                        </div>
                                        <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                            <input class="custom-control-input" name="permission[]" id="view-{{ $permission }}" type="checkbox" value="view {{ $permission }}"{{ ($role->hasPermissionTo('view ' . $permission)) ? ' checked' : '' }}>
                                            <label class="custom-control-label" for="view-{{ $permission }}">view {{ $permission }}</label>
                                        </div>
                                        <div class="pl-md-4 mr-5 custom-checkbox form-check form-check-inline d-block">
                                            <input class="custom-control-input" name="permission[]" id="delete-{{ $permission }}" type="checkbox" value="delete {{ $permission }}"{{ ($role->hasPermissionTo('delete ' . $permission)) ? ' checked' : '' }}>
                                            <label class="custom-control-label" for="delete-{{ $permission }}">delete {{ $permission }}</label>
                                        </div> 
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-5">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection