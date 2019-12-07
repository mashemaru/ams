@extends('layouts.app', ['title' => __('Complete Accreditation')])

@section('content')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Complete Accreditation') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="{{ route('accreditation.complete', $timeline) }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label">Completed Document</label>
                                        <div class="input-group input-group-alternative">
                                            <input type="file" class="form-control form-control-alternative" name="complete_document">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label">Accreditation Result</label>
                                        <div class="input-group input-group-alternative">
                                            <input type="text" name="accreditation_result" class="form-control form-control-alternative{{ $errors->has('accreditation_result') ? ' is-invalid' : '' }}" value="{{ old('accreditation_result') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection