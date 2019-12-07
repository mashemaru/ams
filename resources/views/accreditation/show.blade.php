@extends('layouts.app', ['title' => 'Accreditation Management'])

@section('content')
@include('users.partials.header')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-2">

            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="mb-0">Accreditations</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary mr-3">{{ __('Back to list') }}</a>
                            <form action="{{ route('accreditation.appendix.generate', $accreditation) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm mr-3">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Generate Appendix/Exhibit Lists
                                </button>
                            </form>
                            @if($accreditation->progress != 'completed')
                            <form action="{{ route('accreditation.generate', $accreditation) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Generate Full Document
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-5">
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span>Accreditation Timeline</span>
                                    </div>
                                    <div class="progress-percentage">
                                        <span>{{ number_format($accreditation->status) }}%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-default" role="progressbar" aria-valuenow="{{ number_format($accreditation->status) }}"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format($accreditation->status) }}%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-5">
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span>Tasks Completed</span>
                                    </div>
                                    <div class="progress-percentage">
                                        {{-- <span>60%</span> --}}
                                    </div>
                                </div>
                                <div class="progress">
                                    {{-- <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div> --}}
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <h6 class="heading-small text-muted mb-4">Basic Information</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Accrediting Agency</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->agency->agency_name }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Degree Program</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->program->program_name }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Accreditation Type</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ ($accreditation->type == 'initial') ? 'Initial Accreditation' : 'Reaccreditation' }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Document</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->document->document_name }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Created on</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->created_at->format('M d Y') }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Report Submission Date</p>
                                </div>
                                <div class="col-7">
                                    @if($accreditation->progress != 'initial')
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->report_submission_date->format('M d Y') }}</b></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">On-Site Visit Date</p>
                                </div>
                                <div class="col-7">
                                    @if($accreditation->progress != 'initial')
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->onsite_visit_date->format('M d Y') }}</b></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Number of Teams</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ ($accreditation->teams->count()) ? $accreditation->teams->count() : 'N/A' }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">Teams</h3>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#taskModal">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Task
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Team Head</th>
                                    <th scope="col">Team Members</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col">Tasks Completed</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accreditation->teams as $team)
                                <tr>
                                    <td>{{ $team->team_name }}</td>
                                    <td>{{ $team->head->name }}</td>
                                    <td>{!! $team->users->implode('name', '<br>') !!}</td>
                                    <td>
                                        {{-- {{ $team->document_teams }}
                                        Chapter 1<br>
                                        Chapter 5<br> --}}
                                    </td>
                                    <td>
                                        {{-- <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </td>
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
        </div>
    </div>
    @include('layouts.footers.auth')
    <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" action="{{ route('team.task.store', $accreditation) }}" autocomplete="off">
                @csrf
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('task_name') ? ' has-danger' : '' }} mb-3">
                            <label class="form-control-label" for="input-task_name">{{ __('Task Name') }}</label>
                            <input type="text" name="task_name" id="input-task_name" class="form-control form-control-alternative{{ $errors->has('task_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Task Name') }}" value="{{ old('task_name') }}" required autofocus>
                            @if ($errors->has('task_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('task_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                        <label class="form-control-label">Assign to</label>
                        <div class="input-group input-group-alternative">
                            <select class="form-control form-control-alternative select2" name="assign_to[]" data-toggle="select" multiple>
                            @if($team_head)
                            
                                @foreach ($team_head as $user)
                                    @if($user->id != auth()->user()->id)
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            @endif
                            </select>
                        </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-control-label">Due Date</label>
                            <div class="input-group input-group-alternative">
                                <input class="form-control datepicker" name="due_date" data-date-format="yyyy-mm-dd" placeholder="Select due date" type="text" value="{{ old('due_date') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-control-label">Remarks</label>
                            <div class="input-group input-group-alternative">
                                <input class="form-control form-control-alternative" name="remarks" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
@endpush