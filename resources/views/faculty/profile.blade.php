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
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">Edit Profile</a>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="text-center mb-5">
                        <h5 class="h3">{{ auth()->user()->name }}</h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{ auth()->user()->department }}
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
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->firstname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Middle Initial</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->mi }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Surname</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->surname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Email</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->email }}</b></p>
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
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->college }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Department/Office</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->department }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">User Type</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ ucfirst(auth()->user()->user_type) }}</b></p>
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
                    <a href="#!" class="btn btn-sm btn-primary">Download</a>
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
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AcademicModal"
                                    style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Add
                                </button>
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
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(auth()->user()->faculty_academic_background as $data)
                                        <tr>
                                            <td>{{ $data->degrees_earned }}</td>
                                            <td>{{ $data->title_of_degree }}</td>
                                            <td>{{ $data->area_of_specialization }}</td>
                                            <td>{{ $data->year_obtained }}</td>
                                            <td>{{ $data->educational_institution }}</td>
                                            <td>{{ $data->location }}</td>
                                            <td>{{ $data->so_number }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="AcademicModal" tabindex="-1" role="dialog" aria-labelledby="AcademicModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AcademicModalLabel">Add Academic Background</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="{{ route('faculty.store', auth()->user()->id) }}" autocomplete="off">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group{{ $errors->has('degrees_earned') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-degrees_earned">{{ __('Degrees Earned') }}</label>
                                                <input type="text" name="degrees_earned" id="input-degrees_earned" class="form-control form-control-alternative{{ $errors->has('degrees_earned') ? ' is-invalid' : '' }}" placeholder="{{ __('Degrees Earned') }}" value="{{ old('degrees_earned') }}" autofocus>
                                                @if ($errors->has('degrees_earned'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('degrees_earned') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('title_of_degree') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-title_of_degree">{{ __('Title of Degree') }}</label>
                                                <input type="text" name="title_of_degree" id="input-title_of_degree" class="form-control form-control-alternative{{ $errors->has('title_of_degree') ? ' is-invalid' : '' }}" placeholder="{{ __('Title of Degree') }}" value="{{ old('title_of_degree') }}">
                                                @if ($errors->has('title_of_degree'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title_of_degree') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('area_of_specialization') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-area_of_specialization">{{ __('Area of Specialization') }}</label>
                                                <input type="text" name="area_of_specialization" id="input-area_of_specialization" class="form-control form-control-alternative{{ $errors->has('area_of_specialization') ? ' is-invalid' : '' }}" placeholder="{{ __('Area of Specialization') }}" value="{{ old('area_of_specialization') }}">
                                                @if ($errors->has('area_of_specialization'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('area_of_specialization') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('year_obtained') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-year_obtained">{{ __('Year Obtained') }}</label>
                                                <input type="text" name="year_obtained" id="input-year_obtained" class="form-control form-control-alternative{{ $errors->has('year_obtained') ? ' is-invalid' : '' }}" placeholder="{{ __('Year Obtained') }}" value="{{ old('year_obtained') }}">
                                                @if ($errors->has('year_obtained'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year_obtained') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('educational_institution') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-educational_institution">{{ __('Educational Institution') }}</label>
                                                <input type="text" name="educational_institution" id="input-educational_institution" class="form-control form-control-alternative{{ $errors->has('educational_institution') ? ' is-invalid' : '' }}" placeholder="{{ __('Educational Institution') }}" value="{{ old('educational_institution') }}">
                                                @if ($errors->has('educational_institution'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('educational_institution') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-location">{{ __('Location (City, Country)') }}</label>
                                                <input type="text" name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('Location (City, Country)') }}" value="{{ old('location') }}">
                                                @if ($errors->has('location'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('location') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('so_number') ? ' has-danger' : '' }} mb-3">
                                                <label class="form-control-label" for="input-so_number">{{ __('S.O. Number') }}</label>
                                                <input type="text" name="so_number" id="input-so_number" class="form-control form-control-alternative{{ $errors->has('so_number') ? ' is-invalid' : '' }}" placeholder="{{ __('S.O. Number') }}" value="{{ old('so_number') }}">
                                                @if ($errors->has('so_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('so_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="academic_background" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
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
