<h2>OTHER RESEARCH OUTPUTS (WORKING PAPERS; RESEARCH REPORTS; CONFERENCE PAPERS/POSTERS, ETC) SINCE 2005</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>        
            <th>Type</th>
            <th>Date</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_other_research_outputs as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->type }}</td>
            <td>{{ $data->date }}</td>        
            <td>{{ $data->remarks }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>