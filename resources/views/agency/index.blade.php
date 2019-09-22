@extends('layouts.app', ['title' => __('Agency Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Accrediting Agencies') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#agencyModal">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Accrediting Agency
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Agency Name') }}</th>
                                    <th scope="col">{{ __('Agency Code') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agencies as $agency)
                                    <tr>
                                        <td>{{ $agency->agency_name }}</td>
                                        <td>{{ $agency->agency_code }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('agency.destroy', $agency) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        
                                                        <a class="dropdown-item" href="{{ route('agency.edit', $agency) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this agency?") }}') ? this.parentElement.submit() : ''">
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
                            {{ $agencies->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="agencyModal" tabindex="-1" role="dialog" aria-labelledby="agencyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agencyModalLabel">Add Agency</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form role="form">
                        <div class="modal-body">
                            <div class="form-group mb-3">
                            <label class="form-control-label">Agency Name</label>
                            <div class="input-group input-group-alternative">
                                <input class="form-control" type="text">
                            </div>
                            </div>
                            <div class="form-group mb-3">
                            <label class="form-control-label">Agency Code</label>
                            <div class="input-group input-group-alternative">
                                <input class="form-control" type="text">
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