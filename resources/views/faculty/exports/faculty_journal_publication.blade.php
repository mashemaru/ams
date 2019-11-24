<h2>JOURNAL PUBLICATIONS (SINCE 2005)</h2>
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
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_journal_publication as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->journal_name }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->volume_number }}</td>        
            <td>{{ $data->issue_number }}</td>
            <td>{{ $data->pages }}</td>
            <td>{{ $data->type }}</td>
        </tr>
        @endforeach
    </tbody>
</table>