<div class="card-header" id="headingFacultyProgramsDeveloped" data-toggle="collapse" data-target="#collapseFacultyProgramsDeveloped" aria-expanded="false" aria-controls="collapseFacultyProgramsDeveloped">
        <div class="row">
            <div class="col">
                <h5 class="mb-0">PROGRAMS, MODULES DEVELOPED</h5>
            </div>
            <div class="col text-right mb-0">
                <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
            </div>
        </div>
    </div>
    <div id="collapseFacultyProgramsDeveloped" class="collapse" aria-labelledby="headingFacultyProgramsDeveloped" data-parent="#accordionExample3">
        <div class="col text-right pt-4 mb-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyProgramsDevelopedModal"
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
                            <th scope="col">Author(s)</th>
                            <th scope="col">Title</th>                    
                            <th scope="col">Remarks</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($faculty->faculty_programs_developeds as $data)
                    <tr>    
                        <td>{{ $data->author }}</td>
                        <td>{{ $data->title }}</td>            
                        <td>{{ $data->remarks }}</td>        
                        <td>{{ $data->date }}</td>        
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
    <div class="modal fade" id="FacultyProgramsDevelopedModal" tabindex="-1" role="dialog" aria-labelledby="FacultyProgramsDevelopedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="FacultyProgramsDevelopedModalLabel">Add PROGRAMS, MODULES DEVELOPED</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }} mb-3">
                            <label class="form-control-label" for="input-author">{{ __('Author(s)') }}</label>
                            <input type="text" name="author" id="input-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Author(s)') }}" value="{{ old('author') }}" autofocus>
                            @if ($errors->has('author'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('author') }}</strong>
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
                        <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }} mb-3">
                            <label class="form-control-label" for="input-remarks">{{ __('Remarks') }}</label>
                            <input type="text" name="remarks" id="input-remarks" class="form-control form-control-alternative{{ $errors->has('remarks') ? ' is-invalid' : '' }}" placeholder="{{ __('Remarks') }}" value="{{ old('remarks') }}">
                            @if ($errors->has('remarks'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('remarks') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} mb-3">
                            <label class="form-control-label" for="input-date">{{ __('Dates') }}</label>
                            <input type="text" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Dates') }}" value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="programs_developeds" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>