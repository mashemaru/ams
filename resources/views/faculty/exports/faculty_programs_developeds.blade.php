<h2>PROGRAMS, MODULES DEVELOPED</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>                    
            <th>Remarks</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_programs_developeds as $data)
        <tr>    
            <td>{{ $data->author }}</td>
            <td>{{ $data->title }}</td>            
            <td>{{ $data->remarks }}</td>        
            <td>{{ $data->date }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>