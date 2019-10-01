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
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul class="m-0 pl-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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
                <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agencyModalLabel">Add Agency</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="{{ route('agency.store') }}" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group{{ $errors->has('agency_name') ? ' has-danger' : '' }} mb-3">
                                <label class="form-control-label" for="input-name">{{ __('Agency Name') }}</label>
                                <input type="text" name="agency_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('agency_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency Name') }}" value="{{ old('agency_name') }}" required autofocus>
                                @if ($errors->has('agency_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('agency_code') ? ' has-danger' : '' }} mb-3">
                                <label class="form-control-label" for="input-name">{{ __('Agency Code') }}</label>
                                <input type="text" name="agency_code" id="input-name" class="form-control form-control-alternative{{ $errors->has('agency_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency Code') }}" value="{{ old('agency_code') }}" required>
                                @if ($errors->has('agency_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_code') }}</strong>
                                    </span>
                                @endif
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