@extends('layouts.app', ['title' => __('Faculty Information')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-2">
            <div class="card card-profile">
                <div style="height: 175px" class="bg-gradient-info card-img-top"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="/argon/img/theme/team-4-800x800.jpg" width="120px" height="120px" class="rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-header text-right border-0 pt-6 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex8 float-right">
                        <a href="{{ route('faculty.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        @if(auth()->user()->id == $user->id)
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">Edit Profile</a>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="text-center mb-5">
                        <h5 class="h3">{{ $user->name }}</h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{ $user->department }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Given Name</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->firstname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Middle Initial</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->mi }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Surname</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->surname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Email</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->email }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="heading-small text-muted mb-4">&nbsp</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">College/Unit</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->college }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Department/Office</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ $user->department }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">User Type</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ ucfirst($user->user_type) }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">User Role</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ ucwords($roles->implode(', ')) }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Faculty Information Form</h3>
                </div>
                {{-- <div class="col text-right">
                    <a href="#" class="btn btn-sm btn-primary">Download</a>
                </div> --}}
            </div>
        </div>
        <div class="nav-wrapper py-0">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 active rounded-0" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">ACADEMIC BACKGROUND</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">EDUCATIONAL AND PROFESSIONAL EXPERIENCE</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">PROFESSIONAL ACTIVITIES</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">COMMUNITY SERVICE</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="accordion" id="accordionExample">
                        <div class="card-header" id="headingAcademic" data-toggle="collapse" data-target="#collapseAcademic" aria-expanded="false" aria-controls="collapseAcademic">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-0">ACADEMIC BACKGROUND</h5>
                                </div>
                                <div class="col text-right mb-0">
                                    <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
                                </div>
                            </div>
                        </div>
                        <div id="collapseAcademic" class="collapse" aria-labelledby="headingAcademic" data-parent="#accordionExample">
                            <div class="col text-right pt-4 mb-4">
                                <!-- Button trigger modal -->
                                <form method="post" action="{{ route('faculty.exportFacultyAcademicBackground', $user) }}" autocomplete="off">
                                @csrf
                                    <button type="submit" class="btn btn-primary btn-sm" style="float:right">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        Download
                                    </button>
                                </form>
                            </div>
                            <div class="card-body px-0">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Degrees Earned</th>
                                                <th scope="col">Title of Degree</th>
                                                <th scope="col">Area of Specialization</th>
                                                <th scope="col">Year Obtained</th>
                                                <th scope="col">Educational Institution</th>
                                                <th scope="col">Location (City, Country)</th>
                                                <th scope="col">S.O. Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->faculty_academic_background as $data)
                                            <tr>
                                                <td>{{ $data->degrees_earned }}</td>
                                                <td>{{ $data->title_of_degree }}</td>
                                                <td>{{ $data->area_of_specialization }}</td>
                                                <td>{{ $data->year_obtained }}</td>
                                                <td>{{ $data->educational_institution }}</td>
                                                <td>{{ $data->location }}</td>
                                                <td>{{ $data->so_number }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                    <p class="description">Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
