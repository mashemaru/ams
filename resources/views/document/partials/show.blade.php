@foreach($sections as $s)
<li>
    <p>{{ $s->section }}</p>
    <p>{{ isset($s->description) ? $s->description : '' }}</p>
    @if(isset($s->children))
        <ul>
            {!! renderViewDocumentSections($s->children) !!}
        </ul>
    @endif
</li>
@endforeach