@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group{{ ($errors->has('firstname') || $errors->has('mi') || $errors->has('surname')) ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name"><strong style="color:red">*</strong>{{ __('Name') }}</label>
                                    <div class="input-group input-group-alternative mb-3" id="input-name">
                                        <input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative col-5{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="Given Name" value="{{ old('firstname', auth()->user()->firstname) }}">
                                        <input type="text" name="mi" id="input-mi" class="form-control form-control-alternative col-2{{ $errors->has('mi') ? ' is-invalid' : '' }}" placeholder="M.I." value="{{ old('mi', auth()->user()->mi) }}">
                                        <input type="text" name="surname" id="input-surname" class="form-control form-control-alternative col-5{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="Surname" value="{{ old('surname', auth()->user()->surname) }}">
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
                                <div class="form-group">
                                    <label class="form-control-label" for="input-gender"><strong style="color:red">*</strong>{{ __('Gender') }}</label>
                                    <select id="input-gender" class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="{{ __('Gender') }}" name="gender" required>
                                        <option value>Select Gender</option>
                                        <option value="male"{{ (auth()->user()->gender == 'male') ? ' selected' : '' }}>Male</option>
                                        <option value="female"{{ (auth()->user()->gender == 'female') ? ' selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-college"><strong style="color:red">*</strong>{{ __('College') }}</label>
                                    <input class="form-control form-control-alternative" id="input-college" name="college" placeholder="College" type="text" value="{{ old('college', auth()->user()->college) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-department"><strong style="color:red">*</strong>{{ __('Department') }}</label>
                                    <input class="form-control form-control-alternative" id="input-department" name="department" placeholder="Department" type="text" value="{{ old('department', auth()->user()->department) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-rank"><strong style="color:red">*</strong>{{ __('Faculty Classification') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('rank') ? ' is-invalid' : '' }}" name="rank">
                                        <option value>Select Rank</option>
                                        <option value="FT"{{ (auth()->user()->rank == 'FT') ? ' selected' : '' }}>FT</option>
                                        <option value="PT"{{ (auth()->user()->rank == 'PT') ? ' selected' : '' }}>PT</option>
                                        <option value="ASF"{{ (auth()->user()->rank == 'ASF') ? ' selected' : '' }}>ASF</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email"><strong style="color:red">*</strong>{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-2">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="col-12 mb-0">Accreditations</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Accreditation</th>
                                <th scope="col">Role</th>
                                <th scope="col">Team</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($accreditations)
                                @foreach ($accreditations as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $item->agency->agency_code }} - {{ $item->program->program_code }}
                                    </th>
                                        @php $break = false; @endphp
                                        @if($teams)
                                        @foreach ($item->teams as $accredition_team)
                                            @foreach ($teams as $team)
                                                @if($accredition_team->id == $team->id)
                                                    <td>{{ ($team->team_head == auth()->user()->id) ? 'Team Head' : 'Member' }}</td>
                                                    <td>{{ $team->team_name }}</td>
                                                    @php $break = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($break) @break @endif
                                        @endforeach
                                        @endif
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection