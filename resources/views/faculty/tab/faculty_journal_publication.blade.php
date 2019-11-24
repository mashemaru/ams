<div class="card-header" id="headingFacultyJournalPublication" data-toggle="collapse" data-target="#collapseFacultyJournalPublication" aria-expanded="false" aria-controls="collapseFacultyJournalPublication">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">JOURNAL PUBLICATIONS (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyJournalPublication" class="collapse" aria-labelledby="headingFacultyJournalPublication" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyJournalPublicationModal"
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
                        <th scope="col">Journal Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Volume Number</th>
                        <th scope="col">Issue Number</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_journal_publication as $data)
                <tr>
                    <td>{{ $data->author }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->journal_name }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->volume_number }}</td>        
                    <td>{{ $data->issue_number }}</td>
                    <td>{{ $data->pages }}</td>
                    <td>{{ $data->type }}</td>
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
<div class="modal fade" id="FacultyJournalPublicationModal" tabindex="-1" role="dialog" aria-labelledby="FacultyJournalPublicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyJournalPublicationModalLabel">Add Journal Publication</h5>
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
                    <div class="form-group{{ $errors->has('journal_name') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-journal_name">{{ __('Journal Name') }}</label>
                        <input type="text" name="journal_name" id="input-journal_name" class="form-control form-control-alternative{{ $errors->has('journal_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Journal Name') }}" value="{{ old('journal_name') }}">
                        @if ($errors->has('journal_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('journal_name') }}</strong>
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
                    <div class="form-group{{ $errors->has('volume_number') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-volume_number">{{ __('Volume Number') }}</label>
                        <input type="text" name="volume_number" id="input-volume_number" class="form-control form-control-alternative{{ $errors->has('volume_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Volume Number') }}" value="{{ old('volume_number') }}">
                        @if ($errors->has('volume_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('volume_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('issue_number') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-issue_number">{{ __('Issue Number') }}</label>
                        <input type="text" name="issue_number" id="input-issue_number" class="form-control form-control-alternative{{ $errors->has('issue_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Issue Number') }}" value="{{ old('issue_number') }}">
                        @if ($errors->has('issue_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('issue_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('pages') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-pages">{{ __('Pages') }}</label>
                        <input type="text" name="pages" id="input-pages" class="form-control form-control-alternative{{ $errors->has('pages') ? ' is-invalid' : '' }}" placeholder="{{ __('Pages') }}" value="{{ old('pages') }}">
                        @if ($errors->has('pages'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pages') }}</strong>
                            </span>
                        @endif
                    </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                        <input type="text" name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="{{ __('Type') }}" value="{{ old('type') }}">
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="journal_publication" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>