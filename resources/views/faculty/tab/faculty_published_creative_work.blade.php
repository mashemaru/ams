<div class="card-header" id="headingFacultyPublishedCreativeWork" data-toggle="collapse" data-target="#collapseFacultyPublishedCreativeWork" aria-expanded="false" aria-controls="collapseFacultyPublishedCreativeWork">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">PUBLISHED SHORT STORIES, NOVEL, POETRY, PLAY, SCREENPLAY, CREATIVE WORK (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyPublishedCreativeWork" class="collapse" aria-labelledby="headingFacultyPublishedCreativeWork" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyPublishedCreativeWorkModal"
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
                        <th scope="col">Published In</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Place of Publication</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_published_creative_work as $data)
                <tr>
                <td>{{ $data->author }}</td>    
                <td>{{ $data->title }}</td>
                <td>{{ $data->published_in }}</td>
                <td>{{ $data->publisher }}</td>
                <td>{{ $data->place_of_publication }}</td>
                <td>{{ $data->pages }}</td>
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
<div class="modal fade" id="FacultyPublishedCreativeWorkModal" tabindex="-1" role="dialog" aria-labelledby="FacultyPublishedCreativeWorkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyPublishedCreativeWorkModalLabel">Add Published Short Stories, Novels, Poetry, Play, Screenplay, Creative Work</h5>
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
                    

                    <div class="form-group{{ $errors->has('published_in') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-published_in">{{ __('Published In') }}</label>
                        <input type="text" name="published_in" id="input-published_in" class="form-control form-control-alternative{{ $errors->has('published_in') ? ' is-invalid' : '' }}" placeholder="{{ __('Published In') }}" value="{{ old('published_in') }}">
                        @if ($errors->has('published_in'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('published_in') }}</strong>
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

                    <div class="form-group{{ $errors->has('pages') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-pages">{{ __('Pages') }}</label>
                        <input type="text" name="pages" id="input-pages" class="form-control form-control-alternative{{ $errors->has('pages') ? ' is-invalid' : '' }}" placeholder="{{ __('Pages') }}" value="{{ old('pages') }}">
                        @if ($errors->has('pages'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pages') }}</strong>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="published_creative_work" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>