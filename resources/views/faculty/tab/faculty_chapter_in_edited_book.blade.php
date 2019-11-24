<div class="card-header" id="headingFacultyChapterInEditedBook" data-toggle="collapse" data-target="#collapseFacultyChapterInEditedBook" aria-expanded="false" aria-controls="collapseFacultyChapterInEditedBook">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">CHAPTER IN EDITED BOOK (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyChapterInEditedBook" class="collapse" aria-labelledby="headingFacultyChapterInEditedBook" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyChapterInEditedBookModal"
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
                        <th scope="col">Title of Work</th>
                        <th scope="col">Title of Book</th>
                        <th scope="col">Editor(s)</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Place of Publication</th>
                        <th scope="col">Date of Publication</th>
                        <th scope="col">Pages</th>
                        <th scope="col">ISBN</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_chapter_in_edited_book as $data)
                <tr>
                    <td>{{ $data->author }}</td>    
                    <td>{{ $data->title_of_work }}</td>
                    <td>{{ $data->title_of_book }}</td>
                    <td>{{ $data->editor }}</td>
                    <td>{{ $data->publisher }}</td>
                    <td>{{ $data->place_of_publication }}</td>
                    <td>{{ $data->date_of_publication }}</td>
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
<div class="modal fade" id="FacultyChapterInEditedBookModal" tabindex="-1" role="dialog" aria-labelledby="FacultyChapterInEditedBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyChapterInEditedBookModalLabel">Add Chapter In Edited Book</h5>
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
                    

                    <div class="form-group{{ $errors->has('publisher') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-publisher">{{ __('Publisher') }}</label>
                        <input type="text" name="publisher" id="input-publisher" class="form-control form-control-alternative{{ $errors->has('publisher') ? ' is-invalid' : '' }}" placeholder="{{ __('Publisher') }}" value="{{ old('publisher') }}">
                        @if ($errors->has('publisher'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('publisher') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('title_of_work') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-title_of_work">{{ __('Title of Work') }}</label>
                        <input type="text" name="title_of_work" id="input-title_of_work" class="form-control form-control-alternative{{ $errors->has('title_of_work') ? ' is-invalid' : '' }}" placeholder="{{ __('Title of Work') }}" value="{{ old('title_of_work') }}">
                        @if ($errors->has('title_of_work'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title_of_work') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('title_of_book') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-title_of_book">{{ __('Title of Book') }}</label>
                        <input type="text" name="title_of_book" id="input-title_of_book" class="form-control form-control-alternative{{ $errors->has('title_of_book') ? ' is-invalid' : '' }}" placeholder="{{ __('Title of Book') }}" value="{{ old('title_of_book') }}">
                        @if ($errors->has('title_of_book'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title_of_book') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('editor') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-editor">{{ __('Editor') }}</label>
                        <input type="text" name="editor" id="input-editor" class="form-control form-control-alternative{{ $errors->has('editor') ? ' is-invalid' : '' }}" placeholder="{{ __('Editor') }}" value="{{ old('editor') }}">
                        @if ($errors->has('editor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('editor') }}</strong>
                            </span>
                        @endif
                    </div>


                        <div class="form-group{{ $errors->has('publisher') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-publisher">{{ __('Publisher') }}</label>
                        <input type="text" name="publisher" id="input-publisher" class="form-control form-control-alternative{{ $errors->has('publisher') ? ' is-invalid' : '' }}" placeholder="{{ __('Publisher') }}" value="{{ old('publisher') }}">
                        @if ($errors->has('publisher'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('publisher') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('place_of_publication') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-place_of_publication">{{ __('Place of Publication') }}</label>
                        <input type="text" name="place_of_publication" id="input-place_of_publication" class="form-control form-control-alternative{{ $errors->has('place_of_publication') ? ' is-invalid' : '' }}" placeholder="{{ __('Place of Publication') }}" value="{{ old('place_of_publication') }}">
                        @if ($errors->has('place_of_publication'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('place_of_publication') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('date_of_publication') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-date_of_publication">{{ __('Date of Publication') }}</label>
                        <input type="text" name="date_of_publication" id="input-date_of_publication" class="form-control form-control-alternative{{ $errors->has('date_of_publication') ? ' is-invalid' : '' }}" placeholder="{{ __('Date of Publication') }}" value="{{ old('date_of_publication') }}">
                        @if ($errors->has('date_of_publication'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date_of_publication') }}</strong>
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
                    <button type="submit" name="chapter_in_edited_book" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>