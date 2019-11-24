<h2>PROFESSIONAL PRACTICE, INDUSTRIAL PRACTICE, OR EMPLOYMENT OUTSIDE DLSU OTHER THAN TEACHING</h2>
<table class="table">
    <thead>
        <tr>
            <th>Nature of Practice/Project</th>
            <th>Organization/Institution</th>
            <th>No. of Years</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_professional_practice as $data)
        <tr>
            <td>{{ $data->practice_nature }}</td>
            <td>{{ $data->organization }}</td>
            <td>{{ $data->years }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>