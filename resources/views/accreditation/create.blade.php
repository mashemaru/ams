@extends('layouts.app', ['title' => __('Accreditation Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Create Accreditation')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Accreditation Management') }}</h3>
                            </div>
                        </div>
                    </div>
                    <form id="document" method="post" action="{{ route('accreditation.store') }}" autocomplete="off">
                    @csrf
                        <div class="card-body p-lg-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('agency_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agency_id">{{ __('Agency') }}</label>
                                        <select id="input-agency_id" class="form-control form-control-alternative{{ $errors->has('agency_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Agency') }}" name="agency_id" required>
                                            <option value>Select Agency</option>
                                            @foreach ($agency as $a)
                                                <option value="{{$a->id}}" {{ ($a->id == old('agency_id')) ? 'selected="selected"' : '' }}>{{ $a->agency_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('agency_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('program_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-program_id">{{ __('Program') }}</label>
                                        <select id="input-program_id" class="form-control form-control-alternative{{ $errors->has('program_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Program') }}" name="program_id" required>
                                            <option value>Select Program</option>
                                            @foreach ($program as $p)
                                                <option value="{{$p->id}}" {{ ($p->id == old('program_id')) ? 'selected="selected"' : '' }}>{{ $p->program_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('program_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('program_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('document_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-document_id">{{ __('Document Outline') }}</label>
                                        <select id="input-document_id" class="form-control form-control-alternative{{ $errors->has('document_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Document Outline') }}" name="document_id" required>
                                            <option value>Select Document</option>
                                        </select>
                                        @if ($errors->has('document_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('document_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                                        <select id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="{{ __('Type') }}" name="type" required>
                                            <option value>Select Type</option>
                                            <option value="initial" {{ ('initial' == old('type')) ? 'selected="selected"' : '' }}>Initial Accreditation</option>
                                            <option value="reaccredit" {{ ('reaccredit' == old('type')) ? 'selected="selected"' : '' }}>Reaccreditation</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('report_submission_date') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Report Submission Date</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" name="report_submission_date" data-date-format="yyyy-mm-dd" placeholder="Select date" type="text" value="{{ old('report_submission_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group{{ $errors->has('onsite_visit_date') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">On-Site Visit Date</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" name="onsite_visit_date" data-date-format="yyyy-mm-dd" placeholder="Select date" type="text" value="{{ old('onsite_visit_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script>
$('#document').on('change', 'select[name="agency_id"]', function () {
    $("#input-document_id").html('<option value>Select Document</option>');
    if(this.value) {
        $.getJSON( "/getAgencyDocument/" + this.value, function( data ) {
            var items = [];
            items.push( "<option value>Select Document</option>" );
            $.each( data, function( key, value) {
                items.push( "<option value='" + value.id + "'>" +  value.name + "</option>" );
            });
            $("#input-document_id").html( items );
        });
    }
});
</script>
@endpush