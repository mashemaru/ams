<div class="row">
<a href="{{ route('file-repository.download', $file) }}" class="btn btn-dark btn-sm"><i class="fas fa-download"></i> Download</a>
@role('super-admin')
<form action="{{ route('file-repository.destroy', $file) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirm('{{ __("Are you sure you want to delete this File Repository?") }}') ? this.parentElement.submit() : ''">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>
@endrole
</div>