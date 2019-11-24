<div class="card-header" id="headingProfessionalPracticeDlsu" data-toggle="collapse" data-target="#collapseProfessionalPracticeDlsu" aria-expanded="false" aria-controls="collapseProfessionalPracticeDlsu">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">EMPLOYMENT/PROFESSIONAL PRACTICE IN DLSU OTHER THAN TEACHING</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseProfessionalPracticeDlsu" class="collapse" aria-labelledby="headingProfessionalPracticeDlsu" data-parent="#accordionExample2">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ProfessionalPracticeDlsuModal"
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
                        <th scope="col">Position/Designation</th>
                        <th scope="col">Unit/Department/College</th>
                        <th scope="col">No. of Years</th>
                        <th scope="col">Inclusive Dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_professional_practice_dlsu as $data)
                <tr>
                    <td>{{ $data->position }}</td>
                    <td>{{ $data->college }}</td>
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
<div class="modal fade" id="ProfessionalPracticeDlsuModal" tabindex="-1" role="dialog" aria-labelledby="ProfessionalPracticeDlsuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="ProfessionalPracticeDlsuModalLabel">Add Professional Practice in DLSU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-position">{{ __('Position/Designation') }}</label>
                        <input type="text" name="position" id="input-position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" placeholder="{{ __('Position/Designation') }}" value="{{ old('position') }}" autofocus>
                        @if ($errors->has('position'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('college') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-college">{{ __('Unit/Department/College') }}</label>
                        <input type="text" name="college" id="input-college" class="form-control form-control-alternative{{ $errors->has('college') ? ' is-invalid' : '' }}" placeholder="{{ __('Unit/Department/College') }}" value="{{ old('college') }}">
                        @if ($errors->has('college'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('college') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('years') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-years">{{ __('No. of Years') }}</label>
                        <input type="text" name="years" id="input-years" class="form-control form-control-alternative{{ $errors->has('years') ? ' is-invalid' : '' }}" placeholder="{{ __('No. of Years') }}" value="{{ old('years') }}">
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
                    <button type="submit" name="professional_practice_dlsu" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>