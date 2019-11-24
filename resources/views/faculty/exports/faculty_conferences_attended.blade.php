<h2>CONFERENCES, WORKSHOPS, SEMINARS, AND TRAINING PROGRAMS ATTENDED (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Type</th>
            <th>Title</th>                    
            <th>Date</th>
            <th>Venue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_conferences_attended as $data)
        <tr>    
            <td>{{ $data->type }}</td>
            <td>{{ $data->title }}</td>            
            <td>{{ $data->date }}</td>        
            <td>{{ $data->venue }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>