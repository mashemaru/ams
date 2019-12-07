<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="{{ route('course.show', $course) }}">{{ __('View Course') }}</a>
        <a class="dropdown-item" href="{{ route('course.edit', $course) }}">{{ __('Edit') }}</a>
        <form method="post" action="{{ route('course.remind', $course) }}" class="d-inline" autocomplete="off">
        @csrf
            <button type="submit" class="dropdown-item">Remind Syllabus Update</button>
        </form>
        <form action="{{ route('course.destroy', $course) }}" method="post">
            @csrf
            @method('delete')
            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this course?") }}') ? this.parentElement.submit() : ''">
                {{ __('Delete') }}
            </button>
        </form>
    </div>
</div>