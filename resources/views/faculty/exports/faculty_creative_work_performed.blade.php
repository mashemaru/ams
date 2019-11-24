<h2>PLAY, SCREENPLAY, FILM, CREATIVE WORK PERFORMED OR PRESENTED (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>        
            <th>Venue of Performance/Presentation</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_creative_work_performed as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->venue_of_performance_or_presentation }}</td>
            <td>{{ $data->date }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>