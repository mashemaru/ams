<h2>TEACHING EXPERIENCE IN OTHER SCHOOLS</h2>
<table class="table">
    <thead>
        <tr>
            <th>Level</th>
            <th>Name of School</th>
            <th>Inclusive Dates</th>
            <th>Years</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_teaching_experience_other as $data)
        <tr>
            <td>{{ $data->level }}</td>
            <td>{{ $data->school_name }}</td>
            <td>{{ $data->inclusive_dates }}</td>
            <td>{{ $data->years }}</td>
        </tr>
        @endforeach
    </tbody>
</table>