<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Course Name') }}</th>
            <th scope="col">{{ __('Course Code') }}</th>
            <th>
                @if(request()->course_type || request()->college)
                <form method="post" action="{{ route('course.search-download') }}" class="float-right">
                    @csrf
                    @if(request()->course_type)
                        @foreach (request()->course_type as $course)
                        <input type="hidden" name="course_type[]" value="{{ $course }}">
                        @endforeach
                    @endif
                    @if(request()->college)
                        @foreach (request()->college as $college)
                        <input type="hidden" name="college[]" value="{{ $college }}">
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-primary btn-sm">Download</button>
                </form>
                @endif
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($courses as $course)
            <tr>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_code }}</td>
                <td></td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">No results found</td>
            </tr>
        @endforelse
    </tbody>
</table>