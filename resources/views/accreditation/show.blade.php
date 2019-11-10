@extends('layouts.app', ['title' => 'Accreditation Management'])

@section('content')
@include('users.partials.header')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-2">

            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">Accreditations</h3>
                        </div>
                        <div class="col text-right">
                            <form action="{{ route('accreditation.generate', $accreditation) }}" method="post">
                                @csrf
                                <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary mr-3">{{ __('Back to list') }}</a>
                                <button type="submit" class="btn btn-primary btn-sm" style="float:right">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    Generate Full Document
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-5">
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span>Accreditation Timeline</span>
                                    </div>
                                    <div class="progress-percentage">
                                        <span>60%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-default" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-5">
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span>Tasks Completed</span>
                                    </div>
                                    <div class="progress-percentage">
                                        <span>60%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <h6 class="heading-small text-muted mb-4">Basic Information</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Accrediting Agency</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->agency->agency_name }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Degree Program</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->program->program_name }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Accreditation Type</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ ($accreditation->type == 'initial') ? 'Initial Accreditation' : 'Reaccreditation' }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Document</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->document->document_name }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Created on</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->created_at->format('M d Y') }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Report Submission Date</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->report_submission_date->format('M d Y') }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">On-Site Visit Date</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">{{ $accreditation->onsite_visit_date->format('M d Y') }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Number of Teams</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b class="font-weight-bold">5 Teams</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">Teams</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Team Head</th>
                                    <th scope="col">Team Members</th>
                                    <th scope="col">Assigned to</th>
                                    <th scope="col">Tasks Completed</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ABCD</td>
                                    <td>Juan Dela Cruz</td>
                                    <td>
                                        Maria<br>
                                        Pedro<br>
                                        Paolo<br>
                                    </td>
                                    <td>
                                        Chapter 1<br>
                                        Chapter 5<br>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
