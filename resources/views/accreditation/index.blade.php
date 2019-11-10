@extends('layouts.app', ['title' => __('Accreditation Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Accreditations') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accreditation.create') }}" class="btn btn-primary btn-sm"><span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Accreditation</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Degree Program') }}</th>
                                    <th scope="col">{{ __('Agency') }}</th>
                                    <th scope="col">{{ __('Document') }}</th>
                                    <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Result') }}</th>
                                    <th scope="col">{{ __('End Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accreditations as $a)
                                    <tr>
                                        <td>{{ $a->program->program_name }}</td>
                                        <td>{{ $a->agency->agency_name }}</td>
                                        <td>{{ $a->document->document_name }}</td>
                                        <td>{{ ($a->type == 'initial') ? 'Initial Accreditation' : 'Reaccreditation' }}</td>
                                        <td></td>
                                        <td>{{ ($a->result) ?: 'N/A' }}</td>
                                        <td>{{ ($a->report_submission_date->format('M d Y')) ?: 'N/A' }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="{{ route('accreditation.show', $a) }}" class="dropdown-item">{{ __('View Summary') }}</a>
                                                    <form action="{{ route('accreditation.destroy', $a) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this accreditation?") }}') ? this.parentElement.submit() : ''">
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
                            {{ $accreditations->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection