<div class="card-header" id="headingFacultyCommunityServiceProfessional" data-toggle="collapse" data-target="#collapseFacultyCommunityServiceProfessional" aria-expanded="false" aria-controls="collapseFacultyCommunityServiceProfessional">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">COMMUNITY SERVICE IN PROFESSIONAL ORGANIZATIONS (Local and International) SINCE 2005</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyCommunityServiceProfessional" class="collapse" aria-labelledby="headingFacultyCommunityServiceProfessional" data-parent="#accordionExample4">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyCommunityServiceProfessionalModal"
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
                        <th scope="col">Description of Involvement/Service/Work Done</th>
                        <th scope="col">Professional Organization</th>
                        <th scope="col">Project/Activity Site</th>
                        <th scope="col">Inclusive Dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_community_service_professional as $data)
                <tr>
                    <td>{{ $data->service_description }}</td>
                    <td>{{ $data->professional_organization }}</td>
                    <td>{{ $data->project_site }}</td>
                    <td>{{ $data->inclulsive_dates }}</td>
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
<div class="modal fade" id="FacultyCommunityServiceProfessionalModal" tabindex="-1" role="dialog" aria-labelledby="FacultyCommunityServiceProfessionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyCommunityServiceProfessionalModalLabel">Add Community Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('service_description') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-service_description">{{ __('Description of Involvement/Service/Work Done') }}</label>
                        <input type="text" name="service_description" id="input-service_description" class="form-control form-control-alternative{{ $errors->has('service_description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description of Involvement/Service/Work Done') }}" value="{{ old('service_description') }}" autofocus>
                        @if ($errors->has('service_description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('professional_organization') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-professional_organization">{{ __('Professional Organization') }}</label>
                        <input type="text" name="professional_organization" id="input-professional_organization" class="form-control form-control-alternative{{ $errors->has('professional_organization') ? ' is-invalid' : '' }}" placeholder="{{ __('Professional Organization') }}" value="{{ old('professional_organization') }}">
                        @if ($errors->has('professional_organization'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('professional_organization') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('project_site') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-project_site">{{ __('Project/Activity Site') }}</label>
                        <input type="text" name="project_site" id="input-project_site" class="form-control form-control-alternative{{ $errors->has('project_site') ? ' is-invalid' : '' }}" placeholder="{{ __('Project/Activity Site') }}" value="{{ old('project_site') }}">
                        @if ($errors->has('project_site'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('project_site') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('inclulsive_dates') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-inclulsive_dates">{{ __('Inclusive Dates') }}</label>
                        <input type="text" name="inclulsive_dates" id="input-inclulsive_dates" class="form-control form-control-alternative{{ $errors->has('inclulsive_dates') ? ' is-invalid' : '' }}" placeholder="{{ __('Inclusive Dates') }}" value="{{ old('inclulsive_dates') }}">
                        @if ($errors->has('inclulsive_dates'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inclulsive_dates') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="community_service_professional" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>