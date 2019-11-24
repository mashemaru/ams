<div class="card-header" id="headingFacultyCommunityServiceDlsu" data-toggle="collapse" data-target="#collapseFacultyCommunityServiceDlsu" aria-expanded="false" aria-controls="collapseFacultyCommunityServiceDlsu">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">COMMUNITY SERVICE IN DLSU (Department, Unit, College, University) ACTIVITIES SINCE 2005</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyCommunityServiceDlsu" class="collapse" aria-labelledby="headingFacultyCommunityServiceDlsu" data-parent="#accordionExample4">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyCommunityServiceDlsuModal"
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
                        <th scope="col">Description of  Involvement/Service/Work Done</th>
                        <th scope="col">Unit/Committee</th>
                        <th scope="col">Inclusive Dates</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_community_service_dlsu as $data)
                <tr>
                    <td>{{ $data->service_description }}</td>
                    <td>{{ $data->service_unit }}</td>
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
<div class="modal fade" id="FacultyCommunityServiceDlsuModal" tabindex="-1" role="dialog" aria-labelledby="FacultyCommunityServiceDlsuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyCommunityServiceDlsuModalLabel">Add Community Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('service_description') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-service_description">{{ __('Description of  Involvement/Service/Work Done') }}</label>
                        <input type="text" name="service_description" id="input-service_description" class="form-control form-control-alternative{{ $errors->has('service_description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description of  Involvement/Service/Work Done') }}" value="{{ old('service_description') }}" autofocus>
                        @if ($errors->has('service_description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('service_unit') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-service_unit">{{ __('Unit/Committee') }}</label>
                        <input type="text" name="service_unit" id="input-service_unit" class="form-control form-control-alternative{{ $errors->has('service_unit') ? ' is-invalid' : '' }}" placeholder="{{ __('Unit/Committee') }}" value="{{ old('service_unit') }}">
                        @if ($errors->has('service_unit'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_unit') }}</strong>
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
                    <button type="submit" name="community_service_dlsu" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>