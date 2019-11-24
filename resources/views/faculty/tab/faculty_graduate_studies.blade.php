
<div class="card-header" id="headingGraduateStudies" data-toggle="collapse" data-target="#collapseGraduateStudies" aria-expanded="false" aria-controls="collapseGraduateStudies">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">IF PURSUING GRADUATE STUDIES</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseGraduateStudies" class="collapse" aria-labelledby="headingGraduateStudies" data-parent="#accordionExample">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#GraduateStudiesModal"
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
                        <th scope="col">Degree being pursued</th>
                        <th scope="col">University</th>
                        <th scope="col">Stage of Graduate Studies</th>
                        <th scope="col">No. of units completed</th>
                        <th scope="col">Inclusive dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_graduate_studies as $data)
                <tr>
                    <td>{{ $data->degrees_pursued }}</td>
                    <td>{{ $data->university }}</td>
                    <td>{{ $data->stage }}</td>
                    <td>{{ $data->units_completed }}</td>
                    <td>{{ $data->inclusive_dates }}</td>
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
<div class="modal fade" id="GraduateStudiesModal" tabindex="-1" role="dialog" aria-labelledby="GraduateStudiesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="GraduateStudiesModalLabel">Add Graduate Studies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('degrees_pursued') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-degrees_pursued">{{ __('Degree being pursued') }}</label>
                        <input type="text" name="degrees_pursued" id="input-degrees_pursued" class="form-control form-control-alternative{{ $errors->has('degrees_pursued') ? ' is-invalid' : '' }}" placeholder="{{ __('Degree being pursued') }}" value="{{ old('degrees_pursued') }}" autofocus>
                        @if ($errors->has('degrees_pursued'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('degrees_pursued') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('university') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-university">{{ __('University') }}</label>
                        <input type="text" name="university" id="input-university" class="form-control form-control-alternative{{ $errors->has('university') ? ' is-invalid' : '' }}" placeholder="{{ __('University') }}" value="{{ old('university') }}">
                        @if ($errors->has('university'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('university') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('stage') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-stage">{{ __('Stage of Graduate Studies') }}</label>
                        <select class="form-control form-control-alternative{{ $errors->has('degrees_earned') ? ' is-invalid' : '' }}" name="stage" required>
                            <option value>Select Stage of Graduate Studies</option>
                            <option value="Dissertation">Dissertation</option>
                            <option value="Thesis">Thesis</option>
                            <option value="Comprehensives">Comprehensives</option>
                            <option value="Academic Courses">Academic Courses</option>
                        </select>
                        @if ($errors->has('stage'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('stage') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('units_completed') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-units_completed">{{ __('No. of units completed') }}</label>
                        <input type="text" name="units_completed" id="input-units_completed" class="form-control form-control-alternative{{ $errors->has('units_completed') ? ' is-invalid' : '' }}" placeholder="{{ __('No. of units completed') }}" value="{{ old('units_completed') }}">
                        @if ($errors->has('units_completed'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('units_completed') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('inclusive_dates') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-inclusive_dates">{{ __('Inclusive Dates') }}</label>
                        <input type="text" name="inclusive_dates" id="input-inclusive_dates" class="form-control form-control-alternative{{ $errors->has('inclusive_dates') ? ' is-invalid' : '' }}" placeholder="{{ __('Inclusive Dates') }}" value="{{ old('inclusive_dates') }}">
                        @if ($errors->has('inclusive_dates'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inclusive_dates') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="graduate_studies" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>