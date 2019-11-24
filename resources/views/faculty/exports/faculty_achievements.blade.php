<h2>OUTSTANDING ACHIEVEMENTS/ AWARDS/ RECOGNITION RECEIVED (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Outstanding Achievements/Awards/Recognition</th>
            <th>Awarding Body</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_achievements as $data)
        <tr>
            <td>{{ $data->achievement_received }}</td>
            <td>{{ $data->awarding_body }}</td>
            <td>{{ $data->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>