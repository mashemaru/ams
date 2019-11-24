<h2>ADDITIONAL ACADEMIC TRAINING</h2>
<table class="table">
    <thead>
        <tr>
            <th>Training Title</th>
            <th>Organization/Institution Offering the Training</th>
            <th>Venue(City, Country)</th>
            <th>Inclusive dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_special_training as $data)
        <tr>
            <td>{{ $data->training_title }}</td>
            <td>{{ $data->organization }}</td>
            <td>{{ $data->venue }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>