@extends('layouts.app', ['title' => __('Answer Recommendations')])

@section('content')
@include('users.partials.header')

<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row mt-5">
        <div class="col-xl-9 mb-5 mb-xl-0">
            @if ($accreditation->type == 'reaccredit')
            <div class="card shadow mb-3">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Recommendations</h3>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('answer.recommendation', $accreditation) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="card-body px-lg-4 py-lg-4">
                    @if($accreditation->recommendations)
                    <div class="accordion" id="accordionExample">
                    @foreach ($accreditation->recommendations as $key => $item)
                        <div class="card">
                            <div class="card-header" id="heading{{$key}}" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                <h5 class="mb-0">{{ $item['label'] }}</h5>
                            </div>
                            <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input name="recommendation[{{$key}}][label]" type="text" class="form-control" placeholder="Recommendation" value="{{ $item['label'] }}">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="recommendation[{{$key}}][answer]">{{ $item['answer'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<link href="/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="{{ asset('js/dataTables.js') }}"></script>
<script>
$(document).ready(function () {

});
</script>
@endpush