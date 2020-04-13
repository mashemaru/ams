@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-6 mb-5 mb-xl-0">
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
                                    <div class="mb-1 mt-1">
                                    	<div class="d-flex w-100 justify-content-between">
	                                        <h5 class="">{{ $task->task_name }}</h5>
	                                        <small><i class="fas fa-clock mr-1"></i>{{ $task->created_at->diffForHumans() }}</small>
	                                    </div>
	                                    <div class="d-flex w-100 justify-content-between">
	                                        <h5 class="">{!! $task->remarks !!}</h5>
	                                        <small><strong>Due Date:</strong> {{ $task->due_date->format("m-d-Y") }}</small>
	                                    </div>
	                                </div>
	                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Notifications</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @if($notifications)
                            @foreach ($notifications as $notification)
                            <div class="list-group-item list-group-item-action flex-column align-items-start py-3 px-4">
                                    <div class="d-flex w-100 justify-content-between  mb-3 mt-3">
                                        <h5 class="mb-1">{{ $notification->user->name }}</strong> - {!! $notification->text !!}</h5>
                                        <small><i class="fas fa-clock mr-1"></i><strong>Due Date:</strong> {{ $notification->created_at->diffForHumans() }}</small>
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