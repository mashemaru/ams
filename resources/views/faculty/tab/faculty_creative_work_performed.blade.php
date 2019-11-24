<div class="card-header" id="headingFacultyCreativeWorkPerformed" data-toggle="collapse" data-target="#collapseFacultyCreativeWorkPerformed" aria-expanded="false" aria-controls="collapseFacultyCreativeWorkPerformed">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">PLAY, SCREENPLAY, FILM, CREATIVE WORK PERFORMED OR PRESENTED (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyCreativeWorkPerformed" class="collapse" aria-labelledby="headingFacultyCreativeWorkPerformed" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyCreativeWorkPerformedModal"
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
                        <th scope="col">Venue of Peformance or Presentation</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_creative_work_performed as $data)
                <tr>
                    <td>{{ $data->author }}</td>    
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->venue_of_performance_or_presentation }}</td>
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
<div class="modal fade" id="FacultyCreativeWorkPerformedModal" tabindex="-1" role="dialog" aria-labelledby="FacultyCreativeWorkPerformedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyCreativeWorkPerformedModalLabel">Add Play, Screenplay, Creative Work Performed or Presented</h5>
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
                    

                        <div class="form-group{{ $errors->has('venue_of_performance_or_presentation') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-venue_of_performance_or_presentation">{{ __('Venue of Performance or Presentation') }}</label>
                        <input type="text" name="venue_of_performance_or_presentation" id="input-venue_of_performance_or_presentation" class="form-control form-control-alternative{{ $errors->has('venue_of_performance_or_presentation') ? ' is-invalid' : '' }}" placeholder="{{ __('Venue of Performance or Presentation') }}" value="{{ old('venue_of_performance_or_presentation') }}">
                        @if ($errors->has('venue_of_performance_or_presentation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('venue_of_performance_or_presentation') }}</strong>
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
                    <button type="submit" name="creative_work_performed" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>