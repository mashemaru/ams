<div class="card-header" id="headingFacultyMembership" data-toggle="collapse" data-target="#collapseFacultyMembership" aria-expanded="false" aria-controls="collapseFacultyMembership">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">MEMBERSHIP IN PROFESSIONAL ORGANIZATIONS</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyMembership" class="collapse" aria-labelledby="headingFacultyMembership" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyMembershipModal"
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
                        <th scope="col">Designation/Role</th>
                        <th scope="col">Professional Organization</th>
                        <th scope="col">Inclusive Years</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_membership as $data)
                <tr>
                    <td>{{ $data->role }}</td>
                    <td>{{ $data->professional_organization }}</td>
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
<div class="modal fade" id="FacultyMembershipModal" tabindex="-1" role="dialog" aria-labelledby="FacultyMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyMembershipModalLabel">Add Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-role">{{ __('Designation/Role') }}</label>
                        <input type="text" name="role" id="input-role" class="form-control form-control-alternative{{ $errors->has('role') ? ' is-invalid' : '' }}" placeholder="{{ __('Designation/Role') }}" value="{{ old('role') }}" autofocus>
                        @if ($errors->has('role'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role') }}</strong>
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
                    <button type="submit" name="membership" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>