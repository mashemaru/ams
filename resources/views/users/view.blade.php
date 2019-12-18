@extends('layouts.app', ['title' => __('User Profile - ') . $user->name ])

@section('content')
@include('users.partials.header')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('User Profile')}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Name') }}</label><br>
                                {{ $user->name }}
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Gender') }}</label><br>
                                {{ ucfirst($user->gender) }}
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('College') }}</label><br>
                                {{ $user->college }}
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Department') }}</label><br>
                                {{ $user->department }}
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Faculty Classification') }}</label><br>
                                {{ $user->rank }}
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Email') }}</label><br>
                                {{ $user->email }}
                            </div>
                        </div>
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