<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Course Name') }}</th>
            <th scope="col">{{ __('Course Code') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($courses as $course)
            <tr>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_code }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">No results found</td>
            </tr>
        @endforelse
    </tbody>
</table>