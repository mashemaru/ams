
<h2>PATENTS (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>
            <th>Date</th>
            <th>Issuing Country</th>
            <th>Patent Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_patents as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->issuing_country }}</td>        
            <td>{{ $data->patent_number }}</td>
        </tr>
        @endforeach
    </tbody>
</table>