<div class="card-header" id="headingFacultyAchievements" data-toggle="collapse" data-target="#collapseFacultyAchievements" aria-expanded="false" aria-controls="collapseFacultyAchievements">
    <div class="row">
        <div class="col">
            <h5 class="mb-0">OUTSTANDING ACHIEVEMENTS/ AWARDS/ RECOGNITION RECEIVED (SINCE 2005)</h5>
        </div>
        <div class="col text-right mb-0">
            <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
        </div>
    </div>
</div>
<div id="collapseFacultyAchievements" class="collapse" aria-labelledby="headingFacultyAchievements" data-parent="#accordionExample3">
    <div class="col text-right pt-4 mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FacultyAchievementsModal"
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
                        <th scope="col">Outstanding Achievements/Awards/Recognition</th>
                        <th scope="col">Awarding Body</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faculty->faculty_achievements as $data)
                <tr>
                    <td>{{ $data->achievement_received }}</td>
                    <td>{{ $data->awarding_body }}</td>
                    <td>{{ $data->date }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" achievement_received="button"
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
<div class="modal fade" id="FacultyAchievementsModal" tabindex="-1" achievement_received="dialog" aria-labelledby="FacultyAchievementsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" achievement_received="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="FacultyAchievementsModalLabel">Add Achievements</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('faculty.store', $faculty->id) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('achievement_received') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-achievement_received">{{ __('Outstanding Achievements/Awards/Recognition') }}</label>
                        <input type="text" name="achievement_received" id="input-achievement_received" class="form-control form-control-alternative{{ $errors->has('achievement_received') ? ' is-invalid' : '' }}" placeholder="{{ __('Outstanding Achievements/Awards/Recognition') }}" value="{{ old('achievement_received') }}" autofocus>
                        @if ($errors->has('achievement_received'))
                            <span class="invalid-feedback" achievement_received="alert">
                                <strong>{{ $errors->first('achievement_received') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('awarding_body') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-awarding_body">{{ __('Awarding Body') }}</label>
                        <input type="text" name="awarding_body" id="input-awarding_body" class="form-control form-control-alternative{{ $errors->has('awarding_body') ? ' is-invalid' : '' }}" placeholder="{{ __('Awarding Body') }}" value="{{ old('awarding_body') }}">
                        @if ($errors->has('awarding_body'))
                            <span class="invalid-feedback" achievement_received="alert">
                                <strong>{{ $errors->first('awarding_body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }} mb-3">
                        <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                        <input type="text" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('date') }}">
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" achievement_received="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="achievements" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>