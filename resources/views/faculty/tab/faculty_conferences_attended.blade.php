<div class="card-header" id="headingFacultyConferencesAttended" data-toggle="collapse" data-target="#collapseFacultyConferencesAttended" aria-expanded="false" aria-controls="collapseFacultyConferencesAttended">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">CONFERENCES, WORKSHOPS, SEMINARS, AND TRAINING PROGRAMS ATTENDED (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyConferencesAttended" class="collapse" aria-labelledby="headingFacultyConferencesAttended" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyConferencesAttendedModal"
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
                        <th scope="col">Type</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Venue</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_conferences_attended as $data)
                <tr>
                <td>{{ $data->type }}</td>   
                <td>{{ $data->title }}</td>                        
                <td>{{ $data->date }}</td>               
                <td>{{ $data->venue }}</td>               

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
<div class="modal fade" id="FacultyConferencesAttendedModal" tabindex="-1" role="dialog" aria-labelledby="FacultyConferencesAttendedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyConferencesAttendedModalLabel">Add Conferences, workshops, seminars, and training programs attended</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                        <input type="text" name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="{{ __('Type') }}" value="{{ old('type') }}">
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                        <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>                    
                                                    
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                        <input type="text" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('date') }}">
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('venue') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-venue">{{ __('Venue') }}</label>
                        <input venue="text" name="venue" id="input-venue" class="form-control form-control-alternative{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="{{ __('Venue') }}" value="{{ old('venue') }}">
                        @if ($errors->has('venue'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('venue') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="conferences_attended" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>