<div class="card-header" id="headingFacultyPatents" data-toggle="collapse" data-target="#collapseFacultyPatents" aria-expanded="false" aria-controls="collapseFacultyPatents">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">PATENTS (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyPatents" class="collapse" aria-labelledby="headingFacultyPatents" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyPatentsModal"
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
                        <th scope="col">Date</th>
                        <th scope="col">Issuing Country</th>
                        <th scope="col">Patent Number</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_patents as $data)
                <tr>
                    <td>{{ $data->author }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->issuing_country }}</td>        
                    <td>{{ $data->patent_number }}</td>
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
<div class="modal fade" id="FacultyPatentsModal" tabindex="-1" role="dialog" aria-labelledby="FacultyPatentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyPatentsModalLabel">Add Patent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-author">{{ __('Author') }}</label>
                        <input type="text" name="author" id="input-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Author') }}" value="{{ old('author') }}" autofocus>
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
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                        <input type="text" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('date') }}">
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('issuing_country') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-issuing_country">{{ __('Issuing Country') }}</label>
                        <input type="text" name="issuing_country" id="input-issuing_country" class="form-control form-control-alternative{{ $errors->has('issuing_country') ? ' is-invalid' : '' }}" placeholder="{{ __('Issuing Country') }}" value="{{ old('issuing_country') }}">
                        @if ($errors->has('issuing_country'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('issuing_country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('patent_number') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-patent_number">{{ __('Patent Number') }}</label>
                        <input type="text" name="patent_number" id="input-patent_number" class="form-control form-control-alternative{{ $errors->has('patent_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Patent Number') }}" value="{{ old('patent_number') }}">
                        @if ($errors->has('patent_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('patent_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="patents" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>