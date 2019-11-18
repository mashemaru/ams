@extends('layouts.app', ['title' => __('Activities')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Activities') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="calendar fc fc-unthemed fc-ltr" id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<link href="/vendor/fullcalendar/main.min.css" rel="stylesheet" />
<link href="/vendor/fullcalendar/daygrid/main.min.css" rel="stylesheet" />
<script src="/vendor/fullcalendar/main.min.js"></script>
<script src="/vendor/fullcalendar/daygrid/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            displayEventTime: false,
            plugins: [ 'dayGrid' ],
            events: [
                @foreach($events as $event)
                {
                    title : '{{ $event->task_name }}',
                    start : '{{ $event->due_date }}'
                },
                @endforeach
            ]
        });
        calendar.render();
    });
    </script>
@endpush