<div class="card-header" id="headingProfessionalExperience" data-toggle="collapse" data-target="#collapseProfessionalExperience" aria-expanded="false" aria-controls="collapseProfessionalExperience">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">PROFESSIONAL EXPERIENCE</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseProfessionalExperience" class="collapse" aria-labelledby="headingProfessionalExperience" data-parent="#accordionExample2">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ProfessionalExperienceModal"
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
                        <th scope="col">Year Passed</th>
                        <th scope="col">Licensure Examination Passed</th>
                        <th scope="col">License Number</th>
                        <th scope="col">Valid Until</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_professional_experience as $data)
                <tr>
                    <td>{{ $data->year_passed }}</td>
                    <td>{{ $data->license_passed }}</td>
                    <td>{{ $data->license_number }}</td>
                    <td>{{ $data->validity }}</td>
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
<div class="modal fade" id="ProfessionalExperienceModal" tabindex="-1" role="dialog" aria-labelledby="ProfessionalExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="ProfessionalExperienceModalLabel">Add Professional Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('year_passed') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-year_passed">{{ __('Year Passed') }}</label>
                        <input type="text" name="year_passed" id="input-year_passed" class="form-control form-control-alternative{{ $errors->has('year_passed') ? ' is-invalid' : '' }}" placeholder="{{ __('Year Passed') }}" value="{{ old('year_passed') }}" autofocus>
                        @if ($errors->has('year_passed'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year_passed') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('license_passed') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-license_passed">{{ __('Licensure Examination Passed') }}</label>
                        <input type="text" name="license_passed" id="input-license_passed" class="form-control form-control-alternative{{ $errors->has('license_passed') ? ' is-invalid' : '' }}" placeholder="{{ __('Licensure Examination Passed') }}" value="{{ old('license_passed') }}">
                        @if ($errors->has('license_passed'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('license_passed') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('license_number') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-license_number">{{ __('License Number') }}</label>
                        <input type="text" name="license_number" id="input-license_number" class="form-control form-control-alternative{{ $errors->has('license_number') ? ' is-invalid' : '' }}" placeholder="{{ __('License Number') }}" value="{{ old('license_number') }}">
                        @if ($errors->has('license_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('license_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('validity') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-validity">{{ __('Valid Until') }}</label>
                        <input type="text" name="validity" id="input-validity" class="form-control form-control-alternative{{ $errors->has('validity') ? ' is-invalid' : '' }}" placeholder="{{ __('Valid Until') }}" value="{{ old('validity') }}">
                        @if ($errors->has('validity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('validity') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="professional_experience" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>