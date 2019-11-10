<div class="row mb-2">
    <div class="col-11">
        <select class="scoring_type form-control form-control-alternative select2" name="courses[{{ $count }}][]" data-toggle="select" multiple data-placeholder="Select Academic Term {{ $count }}">
            @foreach ($courses as $course)
                <option value="{{$course->id}}">{{ $course->course_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-1">
        <button class="btn btn-icon btn-2 btn-danger removeCurriculumfield">x</button>
    </div>
</div>