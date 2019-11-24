<div class="card-header" id="headingFacultySpecialTraining" data-toggle="collapse" data-target="#collapseFacultySpecialTraining" aria-expanded="false" aria-controls="collapseFacultySpecialTraining">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">ADDITIONAL ACADEMIC TRAINING</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultySpecialTraining" class="collapse" aria-labelledby="headingFacultySpecialTraining" data-parent="#accordionExample">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultySpecialTrainingModal"
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
                        <th scope="col">Training Title</th>
                        <th scope="col">Organization/Institution Offering the Training</th>
                        <th scope="col">Venue(City, Country)</th>
                        <th scope="col">Inclusive dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_special_training as $data)
                <tr>
                    <td>{{ $data->training_title }}</td>
                    <td>{{ $data->organization }}</td>
                    <td>{{ $data->venue }}</td>
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
<div class="modal fade" id="FacultySpecialTrainingModal" tabindex="-1" role="dialog" aria-labelledby="FacultySpecialTrainingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultySpecialTrainingModalLabel">Add Additional Academic Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('training_title') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-training_title">{{ __('Training Title') }}</label>
                        <input type="text" name="training_title" id="input-training_title" class="form-control form-control-alternative{{ $errors->has('training_title') ? ' is-invalid' : '' }}" placeholder="{{ __('Training Title') }}" value="{{ old('training_title') }}" autofocus>
                        @if ($errors->has('training_title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('training_title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('organization') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-organization">{{ __('Organization') }}</label>
                        <input type="text" name="organization" id="input-organization" class="form-control form-control-alternative{{ $errors->has('organization') ? ' is-invalid' : '' }}" placeholder="{{ __('Organization') }}" value="{{ old('organization') }}">
                        @if ($errors->has('organization'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('venue') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-venue">{{ __('Venue(City, Country)') }}</label>
                        <input type="text" name="venue" id="input-venue" class="form-control form-control-alternative{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="{{ __('Venue(City, Country)') }}" value="{{ old('venue') }}">
                        @if ($errors->has('venue'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('venue') }}</strong>
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
                    <button type="submit" name="special_training" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>