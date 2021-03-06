<h2>INTERNALLY FUNDED RESEARCH PROJECTS/ACTIVITIES (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Research Projects/Activities</th>
            <th>Funding Agency/Unit</th>
            <th>Amount of Research Grant (Php)</th>
            <th>Inclusive Years</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_internally_funded_research as $data)
        <tr>
            <td>{{ $data->research_project }}</td>
            <td>{{ $data->funding_agency }}</td>
            <td>{{ $data->grant_amount }}</td>
            <td>{{ $data->inclusive_years }}</td>
        </tr>
        @endforeach
    </tbody>
</table>