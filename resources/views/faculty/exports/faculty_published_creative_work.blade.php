<h2>PUBLISHED SHORT STORIES, NOVEL, POETRY, PLAY, SCREENPLAY, CREATIVE WORK (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>
            <th>Published In</th>
            <th>Publisher</th>
            <th>Place of Publication</th>
            <th>Pages</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_published_creative_work as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->published_in }}</td>
            <td>{{ $data->publisher }}</td>
            <td>{{ $data->place_of_publication }}</td>
            <td>{{ $data->pages }}</td>
            <td>{{ $data->date }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>