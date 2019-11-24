<h2>RESEARCH GRANTS, FELLOWSHIPS, SCHOLARSHIPS RECEIVED (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Research Projects/Activities</th>
            <th>Funding Agency</th>
            <th>Inclusive Years</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_research_grants as $data)
        <tr>
            <td>{{ $data->research_project }}</td>
            <td>{{ $data->funding_agency }}</td>
            <td>{{ $data->inclusive_years }}</td>
        </tr>
        @endforeach
    </tbody>
</table>