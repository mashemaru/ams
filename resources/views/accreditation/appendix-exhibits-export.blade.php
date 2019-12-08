@if ($accreditation->appendix_exhibit)
    @foreach ($accreditation->appendix_exhibit->groupBy('type') as $key => $item)
        @if ($key == 'appendix') <h1>APPENDICES</h1> @else <h1>EXHIBITS</h1> @endif
        @if($item)
        <ul>
            @php
            if($key == 'appendix')
                $code = 'Appendix A';
            else
                $code = 'Exhibit A';
            @endphp
            @foreach ($item as $i)
                <li><strong>{{ $code }}:</strong> {{ $i->name }}</li>
                @php $code++; @endphp
            @endforeach
        </ul>
        @endif
        <br>
    @endforeach
@endif