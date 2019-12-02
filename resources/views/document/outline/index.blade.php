@extends('layouts.app', ['title' => __('Document Outlines Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        @foreach($accreditations as $accreditation_doc)
        <div class="row mb-4">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $accreditation_doc->first()->accreditation->agency->agency_code }} - {{ $accreditation_doc->first()->accreditation->program->program_code }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Document Name') }}</th>
                                    <th scope="col">{{ __('Section') }}</th>
                                    <th scope="col">{{ __('Document Type') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accreditation_doc as $doc)
                                    <tr>
                                        <td>{{ $doc->document->document_name }}</td>
                                        <td>{{ $doc->section }}</td>
                                        <td>{{ $doc->doc_type }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('document-outline.edit', $doc) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @include('layouts.footers.auth')
    </div>
@endsection