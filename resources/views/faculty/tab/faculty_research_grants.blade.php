<div class="card-header" id="headingFacultyResearchGrants" data-toggle="collapse" data-target="#collapseFacultyResearchGrants" aria-expanded="false" aria-controls="collapseFacultyResearchGrants">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">RESEARCH GRANTS, FELLOWSHIPS, SCHOLARSHIPS RECEIVED (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyResearchGrants" class="collapse" aria-labelledby="headingFacultyResearchGrants" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyResearchGrantsModal"
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
                        <th scope="col">Research Projects/Activities</th>
                        <th scope="col">Funding Agency</th>
                        <th scope="col">Inclusive Years</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_research_grants as $data)
                <tr>
                    <td>{{ $data->research_project }}</td>
                    <td>{{ $data->funding_agency }}</td>
                    <td>{{ $data->inclusive_years }}</td>
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
<div class="modal fade" id="FacultyResearchGrantsModal" tabindex="-1" role="dialog" aria-labelledby="FacultyResearchGrantsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyResearchGrantsModalLabel">Add Research Grant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('research_project') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-research_project">{{ __('Research Projects/Activities') }}</label>
                        <input type="text" name="research_project" id="input-research_project" class="form-control form-control-alternative{{ $errors->has('research_project') ? ' is-invalid' : '' }}" placeholder="{{ __('Research Projects/Activities') }}" value="{{ old('research_project') }}" autofocus>
                        @if ($errors->has('research_project'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('research_project') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('funding_agency') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-funding_agency">{{ __('Funding Agency') }}</label>
                        <input type="text" name="funding_agency" id="input-funding_agency" class="form-control form-control-alternative{{ $errors->has('funding_agency') ? ' is-invalid' : '' }}" placeholder="{{ __('Funding Agency') }}" value="{{ old('funding_agency') }}">
                        @if ($errors->has('funding_agency'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('funding_agency') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('inclusive_years') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-inclusive_years">{{ __('Inclusive Years') }}</label>
                        <input type="text" name="inclusive_years" id="input-inclusive_years" class="form-control form-control-alternative{{ $errors->has('inclusive_years') ? ' is-invalid' : '' }}" placeholder="{{ __('Inclusive Years') }}" value="{{ old('inclusive_years') }}">
                        @if ($errors->has('inclusive_years'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inclusive_years') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="research_grants" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>