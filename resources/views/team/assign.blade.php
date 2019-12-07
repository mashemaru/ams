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
                                <a href="{{ route('accreditation.index') }}" class="btn btn-sm btn-primary">{{ __('Back to Accreditation list') }}</a>
                            </div>
                        </div>
                    </div>
                    <form id="document" method="post" action="{{ route('team.assign', $accreditation) }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label">Agency</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control" disabled>
                                                <option>{{ $accreditation->agency->agency_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Document Name</label>
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control" value="{{ $accreditation->document->document_name }}" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div id="section">
                                @foreach ($accreditation->outlines->where('parent_id',0) as $outline)
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <input class="form-control" value="{{ $outline->section}}" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <select class="form-control" name="document[{{ $outline->id}}][team]">
                                                        <option value>Select team</option>
                                                        @foreach ($allTeams as $team)
                                                            <option value="{{ $team->id }}" @foreach ($accreditation->document_teams as $t) {{ (($outline->id == $t->document_outline_id) && ($t->team_id == $team->id)) ? ' selected="selected"' : '' }} @endforeach>{{ $team->team_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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