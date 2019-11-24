<h2>IF PURSUING GRADUATE STUDIES</h2>
<table class="table">
    <thead>
        <tr>
            <th>Degree being pursued</th>
            <th>University</th>
            <th>Stage of Graduate Studies</th>
            <th>No. of units completed</th>
            <th>Inclusive dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_graduate_studies as $data)
        <tr>
            <td>{{ $data->degrees_pursued }}</td>
            <td>{{ $data->university }}</td>
            <td>{{ $data->stage }}</td>
            <td>{{ $data->units_completed }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>