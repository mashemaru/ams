@extends('layouts.no-side', ['class' => 'bg-default'])

@section('content')
<div class="container pt-5">
    <div class="row row-grid justify-content-center text-center text-lighter">
        <div class="col-lg-10">
            <h1 class="text-light">Hello! <em>{{ $user->name }}</em></h1>
            <p class="mb-5">Team Accreditation Invitation for: {{ $accreditation->agency->agency_code . ' - ' . $accreditation->program->program_code }}</p>
            @if(!$user->invites->contains($accreditation))
            <div class="d-flex justify-content-lg-center px-3 pt-5 mt-5">
                <form method="post" action="{{ route('team.invite') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="invitation" value="accept">
                    <input type="hidden" name="accreditation" value="{{ $accreditation->id }}">
                    <input type="hidden" name="user" value="{{ $user->id }}">
                    <button class="btn btn-icon btn-success mx-4" type="submit">
                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                        <span class="btn-inner--text">Accept</span>
                    </button>
                </form>
                <button class="btn btn-icon btn-danger mx-4" type="button" data-toggle="modal" data-target="#inviteModal">
                    <span class="btn-inner--icon"><i class="fa fas fa-times"></i></span>
                    <span class="btn-inner--text">Reject</span>
                </button>
            </div>
            @else
                @if($collection && $collection['is_accept'])
                    <span class="badge badge-pill badge-lg icon-shape-success">Thank you for joining us!</span>
                @else
                    <span class="badge badge-pill badge-lg icon-shape-danger">Sorry to hear that, maybe next time!</span>
                @endif
            @endif
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('team.invite') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="invitation" value="reject">
                <input type="hidden" name="accreditation" value="{{ $accreditation->id }}">
                <input type="hidden" name="user" value="{{ $user->id }}">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="input-name">Why won't you be able to join us?</label>
                        <textarea class="form-control" name="reason" id="" cols="30" rows="10" placeholder="{{ __('Reason') }}" required autofocus></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection