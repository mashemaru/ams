<h2>Community Service in Professional Organizations (Local and International) since 2005</h2>
<table class="table">
    <thead>
        <tr>
            <th>Description of Involvement/Service/Work Done</th>
            <th>Professional Organization</th>
            <th>Project/Activity Site</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_community_service_professional as $data)
        <tr>
            <td>{{ $data->service_description }}</td>
            <td>{{ $data->professional_organization }}</td>
            <td>{{ $data->project_site }}</td>
            <td>{{ $data->inclulsive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>