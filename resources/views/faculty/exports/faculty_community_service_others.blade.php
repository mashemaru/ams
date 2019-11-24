<h2>Community Service with Others (since 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Description of Involvement/Service/Work Done</th>
            <th>Organization</th>
            <th>Project/Activity Site</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_community_service_others as $data)
        <tr>
            <td>{{ $data->service_description }}</td>
            <td>{{ $data->other_organization }}</td>
            <td>{{ $data->project_site }}</td>
            <td>{{ $data->inclulsive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>