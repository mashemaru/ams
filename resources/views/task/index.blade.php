@extends('layouts.app', ['title' => __('Task Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Tasks') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#taskModal">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Task
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Task') }}</th>
                                    <th scope="col">{{ __('Assigned To') }}</th>
                                    <th scope="col">{{ __('Due Date') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Remarks') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td><strong>{{ $task->task_name }}</strong></td>
                                        <td>{{ $task->user->name }}</td>
                                        <td>{{ $task->due_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge badge-dot">
                                                <i class="bg-{{ ($task->status == 'complete') ? 'success' : (($task->status == 'in-progress') ? 'primary' : 'warning') }}"></i> {{ $task->status }}
                                            </span>
                                        </td>
                                        <td>{{ $task->remarks }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('task.in-progress', $task) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">{{ __('In Progress') }}</button>
                                                    </form>
                                                    <form action="{{ route('task.complete', $task) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">{{ __('Complete') }}</button>
                                                    </form>
                                                    <form action="{{ route('task.destroy', $task) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        {{-- <a class="dropdown-item" href="{{ route('task.edit', $task) }}">{{ __('Edit') }}</a> --}}
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this task?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $tasks->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
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
                    <form method="post" action="{{ route('task.store') }}" autocomplete="off">
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
                                <select class="form-control form-control-alternative select2" name="assign_to[]" data-toggle="select" multiple data-placeholder="Select scoring type">
                                @if($users)
                                    @foreach ($users as $user)
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
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
@endpush