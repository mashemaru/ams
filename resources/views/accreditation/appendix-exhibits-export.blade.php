@if ($accreditation->appendix_exhibit)
    @foreach ($accreditation->appendix_exhibit->groupBy('type') as $key => $item)
        @if ($key == 'appendix') <h1>APPENDICES</h1> @else <h1>EXHIBITS</h1> @endif
        @if($item)
        <ul>
            @foreach ($item as $i)
                <li>{{ $i->name }}</li>
            @endforeach
        </ul>
        @endif
        <br>
    @endforeach
@endif