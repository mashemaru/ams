<h2>BOOKS AND TEXTBOOKS (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title</th>
            <th>Publisher</th>
            <th>Place of Publication</th>
            <th>Date of Publication</th>
            <th>ISBN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_books_and_textbooks as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title }}</td>
            <td>{{ $data->publisher }}</td>
            <td>{{ $data->place_of_publication }}</td>
            <td>{{ $data->date_of_publication }}</td>
            <td>{{ $data->isbn }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>