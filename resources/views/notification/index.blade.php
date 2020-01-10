@extends('layouts.app', ['title' => __('Notifications Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Notifications') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <th scope="row">{{ $notification->user->name }}</th>
                                        <td>{!! $notification->text !!}</td>
                                        <td width="20%">{{ $notification->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $notifications->links() }}
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection