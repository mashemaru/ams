{{-- @extends('layouts.no-side', ['title' => __('Document Outlines')]) --}}

{{-- @section('content') --}}
{{-- @if ($outline_user->score_type != 0) --}}
<h4>Score: <span class="score">{{ ($outline_user && $outline_user->score != null) ? $outline_user->score : 'N/A' }}</span></h4>
{{-- @endif --}}
{!! ($outline_user) ? $outline_user->body : '' !!}
{{-- @endsection --}}