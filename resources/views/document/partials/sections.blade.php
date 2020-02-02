@foreach($sections as $s)
<li class="dd-item" data-section="{{ $s->section }}"{!! isset($s->doc_type) ? ' data-doc_type="' . $s->doc_type . '"' : '' !!}{!! isset($s->score) ? ' data-score="' . $s->score . '"' : '' !!}{!! isset($s->description) ? ' data-description="' . $s->description . '"' : '' !!}>
    <div class="form-inline">
        <div class="dd-handle"><i class="fas fa-arrows-alt"></i></div>
        <div class="form-group mr-3">
            <div class="input-group input-group-alternative">
                <input class="form-control section" placeholder="Section" type="text" value="{{ $s->section }}">
            </div>
        </div>
        <div class="form-group mr-3">
            <div class="input-group input-group-alternative">
                <select class="form-control score">
                    <option value='0'>Narrative Only</option>
                    <optgroup label='Narrative w/ Table'><option value='0'{{ (isset($s->doc_type) && $s->doc_type == 'Narrative w/ Table') ? ' selected' : '' }}>w/ Table</option></optgroup>
                    <optgroup label='Narrative w/ Score'>
                        @foreach($scores as $score)
                            <option value='{{ $score['id'] }}'{{ (isset($s->doc_type) && isset($s->score) && $s->doc_type == 'Narrative w/ Score' && $s->score == $score['id']) ? ' selected' : '' }}>{{ $score['scoring_name'] }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label='Narrative w/ Table & Score'>
                        @foreach($scores as $score)
                            <option value='{{ $score['id'] }}'{{ (isset($s->doc_type) && isset($s->score) && $s->doc_type == 'Narrative w/ Score' && $s->score == $score['id']) ? ' selected' : '' }}>{{ $score['scoring_name'] }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
        <button class="btn btn-icon btn-2 btn-danger removeclass" type="button">x</button>
        <div class="flex-break"></div>
        <textarea class="form-control doc-textarea" rows="3" placeholder="Description">{{ isset($s->description) ? $s->description : '' }}</textarea>
    </div>
    @if(isset($s->children))
        <ol class="dd-list">
            {!! renderDocumentSections($s->children, $scores) !!}
        </ol>
    @endif
</li>
@endforeach