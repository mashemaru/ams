<h2>EMPLOYMENT/PROFESSIONAL PRACTICE IN DLSU OTHER THAN TEACHING</h2>
<table class="table">
    <thead>
        <tr>
            <th>Position/Designation</th>
            <th>Unit/Department/College</th>
            <th>No. of Years</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_professional_practice_dlsu as $data)
        <tr>
            <td>{{ $data->position }}</td>
            <td>{{ $data->college }}</td>
            <td>{{ $data->years }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>