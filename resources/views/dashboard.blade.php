@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Tasks</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body p-0">
                        <!-- List group -->
                        <div class="list-group list-group-flush">
                            @if($tasks)
                            @foreach ($tasks as $task)
                                <div class="list-group-item list-group-item-action flex-column align-items-start py-3 px-4">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">&nbsp;</h5>
                                        <small><i class="fas fa-clock mr-1"></i>{{ $task->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mt-1 mb-1">{{ $task->task_name }}</h5>
                                        <small><strong>Due Date:</strong> {{ $task->due_date->format("m-d-Y") }}</small>
                                    </div>
                                    <p class="text-xs mb-0">{!! $task->remarks !!}</p>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Notifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if($notifications)
                            @foreach ($notifications as $notification)
                            <div class="timeline-block">
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                        <span class="text-muted text-sm"><strong>{{ $notification->user->name }}</strong> - {!! $notification->text !!}</span>
                                        </div>
                                        <div class="text-right">
                                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection