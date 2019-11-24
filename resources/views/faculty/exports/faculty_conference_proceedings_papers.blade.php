<h2>PAPERS PUBLISHED IN CONFERENCE PROCEEDINGS (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Authors(s)</th>
            <th>Title of Paper</th>
            <th>Title of Conference Proceedings</th>
            <th>Publisher</th>
            <th>Place of Publication</th>
            <th>Pages</th>
            <th>ISBN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_conference_proceedings_papers as $data)
        <tr>
            <td>{{ $data->paper_authors }}</td>
            <td>{{ $data->paper_title }}</td>
            <td>{{ $data->conference_proceedings }}</td>
            <td>{{ $data->paper_publisher }}</td>
            <td>{{ $data->publication_place }}</td>
            <td>{{ $data->pages }}</td>
            <td>{{ $data->isbn }}</td>
        </tr>
        @endforeach
    </tbody>
</table>