@extends('layouts.app', ['title' => __('Assign Teams')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Assign Teams') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('document.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form id="document" method="post" action="{{ route('document.store') }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label">Agency</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control" disabled>
                                                <option>ABET</option> 
                                                <option>PAASCU</option>
                                                <option>AUN</option>
                                                <option>PACUCOA</option>                   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Document Name</label>
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control" value="ABET CAC Self-Survey Report" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div id="section">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control" value="Chapter 1.0 Introduction" type="text" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control">
                                                    <option>Team A</option>
                                                    <option>Team B</option>
                                                    <option>Team C</option>
                                                    <option>Team D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection