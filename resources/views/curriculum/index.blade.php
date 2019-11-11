@extends('layouts.app', ['title' => __('Curriculum Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Curriculum Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('curriculum.create') }}" class="btn btn-primary btn-sm"><span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Curriculum</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Program Name') }}</th>
                                    <th scope="col">{{ __('Program Code') }}</th>
                                    <th scope="col">{{ __('Year') }}</th>
                                    <th scope="col">{{ __('No Of Units') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($curriculums as $c)
                                    <tr>
                                        <td><b class="font-weight-bold">{{ $c->program->program_name }}</b></td>
                                        <td>{{ $c->program->program_name }}</td>
                                        <td>{{ $c->start_year }} - {{ $c->end_year }}</td>
                                        <td>{{ number_format($c->courses->sum('units'), 2) }} Units</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="{{ route('curriculum.show', $c) }}" class="dropdown-item">{{ __('View Summary') }}</a>
                                                    <form action="{{ route('curriculum.destroy', $c) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this curriculum?") }}') ? this.parentElement.submit() : ''">
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
                            {{ $curriculums->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection