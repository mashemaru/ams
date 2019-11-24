<div class="card-header" id="headingTeachingExperienceDlsu" data-toggle="collapse" data-target="#collapseTeachingExperienceDlsu" aria-expanded="false" aria-controls="collapseTeachingExperienceDlsu">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">TEACHING EXPERIENCE AT DLSU</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseTeachingExperienceDlsu" class="collapse" aria-labelledby="headingTeachingExperienceDlsu" data-parent="#accordionExample2">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#TeachingExperienceDlsuModal"
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
                        <th scope="col">Level</th>
                        <th scope="col">Years</th>
                        <th scope="col">Inclusive Dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_teaching_experience_dlsu as $data)
                <tr>
                    <td>{{ $data->level }}</td>
                    <td>{{ $data->years }}</td>
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
<div class="modal fade" id="TeachingExperienceDlsuModal" tabindex="-1" role="dialog" aria-labelledby="TeachingExperienceDlsuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="TeachingExperienceDlsuModalLabel">Add Teaching Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-level">{{ __('Level') }}</label>
                        <select class="form-control form-control-alternative{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" required>
                            <option value>Select Level</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Secondary">Secondary</option>
                            <option value="Tertiary">Tertiary</option>
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('years') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-years">{{ __('Years') }}</label>
                        <input type="text" name="years" id="input-years" class="form-control form-control-alternative{{ $errors->has('years') ? ' is-invalid' : '' }}" placeholder="{{ __('Years') }}" value="{{ old('years') }}">
                        @if ($errors->has('years'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('years') }}</strong>
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
                    <button type="submit" name="teaching_experience_dlsu" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>