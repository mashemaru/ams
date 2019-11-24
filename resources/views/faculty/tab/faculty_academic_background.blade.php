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
                    @foreach($faculty->faculty_academic_background as $data)
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
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('degrees_earned') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-degrees_earned">{{ __('Degrees Earned') }}</label>
                        <select class="form-control form-control-alternative{{ $errors->has('degrees_earned') ? ' is-invalid' : '' }}" name="degrees_earned" required>
                            <option value>Select Degrees Eearned</option>
                            <option value="Bachelor's">Bachelor's</option>
                            <option value="Masteral 's">Masteral 's</option>
                            <option value="Doctoral">Doctoral</option>
                        </select>
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