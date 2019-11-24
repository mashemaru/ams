
<h2>PROTOTYPES (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>
            <th>Journal Name</th>
            <th>Date</th>
            <th>Volume Number</th>
            <th>Issue Number</th>
            <th>Pages</th>
            <th>ISSN/ISBN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_prototypes as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->journal_name }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->volume_number }}</td>        
            <td>{{ $data->issue_number }}</td>
            <td>{{ $data->pages }}</td>
            <td>{{ $data->issn_isbn }}</td>
        </tr>
        @endforeach
    </tbody>
</table>