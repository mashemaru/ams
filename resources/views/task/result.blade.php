@php
    $total = 0;
    $complete = isset($task['complete']) ? $task['complete']->count() : 0;
@endphp
<div class="col-9">
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="table-responsive">
                    <h2 class="m-0 p-3">{{ __('Team ') . $selected_team->team_name }}</h2>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Total Tasks') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $key => $collection)
                            @php
                                $total += $collection->count()
                            @endphp
                            <tr>
                                <td>{{ ucfirst($key) }}</td>
                                <td>{{ $collection->count() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        @if($total > 0)
                        <tfoot>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $total }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Task Burndown</strong></td>
                                <td><strong>{{ $complete }} / {{ $total }}</strong> {{ round($complete / $total, 2) }}%</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>