<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        {{-- <form action="{{ route('course.destroy', $course) }}" method="post">
            @csrf
            @method('delete')
            <a class="dropdown-item" href="{{ route('course.show', $course) }}">{{ __('View Course') }}</a>
            <a class="dropdown-item" href="{{ route('course.edit', $course) }}">{{ __('Edit') }}</a>
            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this course?") }}') ? this.parentElement.submit() : ''">
                {{ __('Delete') }}
            </button>
        </form> --}}
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewEvidences{{ $appendix_exhibits->id }}">View Evidence List</a>
        @if($appendix_exhibits->type == 'appendix' && !$appendix_exhibits->evidence_complete)
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-evidence-{{ $appendix_exhibits->id }}">Complete Evidence</a>
        @endif
    </div>
</div>
@if($appendix_exhibits->type == 'appendix' && !$appendix_exhibits->evidence_complete)
<!-- Modal -->
<div class="modal fade" id="modal-evidence-{{ $appendix_exhibits->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-evidence-{{ $appendix_exhibits->id }}" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
        
            <div class="modal-header">
                <h6 class="modal-title">Your attention is required</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{ route('evidence.complete', $appendix_exhibits->id ) }}" autocomplete="off">
            @csrf
            <div class="modal-body">
            
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">You should read this!</h4>
                    <p style="white-space: pre-wrap;">Completing the evidence would indicate the Appendix/Exhibit is closed and would render the Appendix/Exhibit uneditable. Are you sure the evidence is complete?</p>
                </div>
                
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-white">Yes, it's complete</button>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">No, it's not</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif
<div class="modal fade" id="viewEvidences{{ $appendix_exhibits->id }}" tabindex="-1" role="dialog" aria-labelledby="viewEvidences{{ $appendix_exhibits->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEvidences{{ $appendix_exhibits->id }}Label">Evidences of {{ $appendix_exhibits->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                @if($appendix_exhibits->evidences)
                    @foreach($appendix_exhibits->evidences as $evidences)
                    <form method="post" action="/evidenceRemove/{{$appendix_exhibits->id}}/{{$evidences->id}}" autocomplete="off">
                    @csrf
                        <p><span class="badge badge-dot mr-4"><i class="bg-info"></i> {{ $evidences->file_name }}</span> <button type="submit" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove"></i></button></p>
                    </form>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>