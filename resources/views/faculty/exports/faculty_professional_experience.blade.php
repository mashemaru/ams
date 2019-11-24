<h2>Professional Experience</h2>
<table class="table">
    <thead>
        <tr>
            <th>Year Passed</th>
            <th>Licensure Examination Passed</th>
            <th>License Number</th>
            <th>Valid Until</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_professional_experience as $data)
        <tr>
            <td>{{ $data->year_passed }}</td>
            <td>{{ $data->license_passed }}</td>
            <td>{{ $data->license_number }}</td>
            <td>{{ $data->validity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>