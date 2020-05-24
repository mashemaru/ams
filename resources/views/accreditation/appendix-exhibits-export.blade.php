@php
$code = 'A';
$key = '1';
@endphp
@if ($accreditation->outlines)
    @foreach($accreditation->outlines as $outline)
        @if ($outline->evidences)
            @foreach($outline->evidences as $evidence)
            <h1>{{ $evidence->name }}</h1>
                @if ($evidence->appendix_exhibit)
                <ul>
                    @foreach($evidence->appendix_exhibit as $data)
                        <li><strong>{{ ($data->type == 'appendix') ? ucfirst($data->type) . ' ' . $code : ucfirst($data->type) . ' ' . $key }}:</strong> {{ $data->name }}</li>
                        @php
                        if($data->type == 'appendix') {
                            $code++;
                        } else {
                            $key++;
                        }
                        @endphp
                    @endforeach
                </ul>
                <br>
                @endif
            @endforeach
        @endif
    @endforeach
    {{-- @foreach ($accreditation->appendix_exhibit->groupBy('type') as $key => $item)
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
    @endforeach --}}
@endif