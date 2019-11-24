<div class="card-header" id="headingFacultyConferenceProceedingsPapers" data-toggle="collapse" data-target="#collapseFacultyConferenceProceedingsPapers" aria-expanded="false" aria-controls="collapseFacultyConferenceProceedingsPapers">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">PAPERS PUBLISHED IN CONFERENCE PROCEEDINGS (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyConferenceProceedingsPapers" class="collapse" aria-labelledby="headingFacultyConferenceProceedingsPapers" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyConferenceProceedingsPapersModal"
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
                        <th scope="col">Authors(s)</th>
                        <th scope="col">Title of Paper</th>
                        <th scope="col">Title of Conference Proceedings</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Place of Publication</th>
                        <th scope="col">Pages</th>
                        <th scope="col">ISBN</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_conference_proceedings_papers as $data)
                <tr>
                    <td>{{ $data->paper_authors }}</td>
                    <td>{{ $data->paper_title }}</td>
                    <td>{{ $data->conference_proceedings }}</td>
                    <td>{{ $data->paper_publisher }}</td>
                    <td>{{ $data->publication_place }}</td>
                    <td>{{ $data->pages }}</td>
                    <td>{{ $data->isbn }}</td>
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
<div class="modal fade" id="FacultyConferenceProceedingsPapersModal" tabindex="-1" role="dialog" aria-labelledby="FacultyConferenceProceedingsPapersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyConferenceProceedingsPapersModalLabel">Add Paper</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('paper_authors') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-paper_authors">{{ __('Authors(s)') }}</label>
                        <input type="text" name="paper_authors" id="input-paper_authors" class="form-control form-control-alternative{{ $errors->has('paper_authors') ? ' is-invalid' : '' }}" placeholder="{{ __('Authors(s)') }}" value="{{ old('paper_authors') }}" autofocus>
                        @if ($errors->has('paper_authors'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('paper_authors') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('paper_title') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-paper_title">{{ __('Title of Paper') }}</label>
                        <input type="text" name="paper_title" id="input-paper_title" class="form-control form-control-alternative{{ $errors->has('paper_title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title of Paper') }}" value="{{ old('paper_title') }}">
                        @if ($errors->has('paper_title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('paper_title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('conference_proceedings') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-conference_proceedings">{{ __('Title of Conference Proceedings') }}</label>
                        <input type="text" name="conference_proceedings" id="input-conference_proceedings" class="form-control form-control-alternative{{ $errors->has('conference_proceedings') ? ' is-invalid' : '' }}" placeholder="{{ __('Title of Conference Proceedings') }}" value="{{ old('conference_proceedings') }}">
                        @if ($errors->has('conference_proceedings'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('conference_proceedings') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('paper_publisher') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-paper_publisher">{{ __('Publisher') }}</label>
                        <input type="text" name="paper_publisher" id="input-paper_publisher" class="form-control form-control-alternative{{ $errors->has('paper_publisher') ? ' is-invalid' : '' }}" placeholder="{{ __('Publisher') }}" value="{{ old('paper_publisher') }}">
                        @if ($errors->has('paper_publisher'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('paper_publisher') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('publication_place') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-publication_place">{{ __('Place of Publication') }}</label>
                        <input type="text" name="publication_place" id="input-publication_place" class="form-control form-control-alternative{{ $errors->has('publication_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Place of Publication') }}" value="{{ old('publication_place') }}">
                        @if ($errors->has('publication_place'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('publication_place') }}</strong>
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
                    <div class="form-group{{ $errors->has('isbn') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-isbn">{{ __('ISBN') }}</label>
                        <input type="text" name="isbn" id="input-isbn" class="form-control form-control-alternative{{ $errors->has('isbn') ? ' is-invalid' : '' }}" placeholder="{{ __('ISBN') }}" value="{{ old('isbn') }}">
                        @if ($errors->has('isbn'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('isbn') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="conference_proceedings_papers" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>