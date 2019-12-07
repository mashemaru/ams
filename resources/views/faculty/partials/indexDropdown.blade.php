<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="{{ route('faculty.show', $faculty) }}">View Profile</a>
        <form method="post" action="{{ route('faculty.remind', $faculty) }}" class="d-inline" autocomplete="off">
        @csrf
            <button type="submit" class="dropdown-item">Remind FIF Update</button>
        </form>
    </div>
</div>