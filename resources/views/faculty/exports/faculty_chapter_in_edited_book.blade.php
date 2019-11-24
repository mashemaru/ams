
<h2>CHAPTER IN EDITED BOOK (SINCE 2005)</h2>
<table class="table">
    <thead>
        <tr>
            <th>Author(s)</th>
            <th>Title of Work</th>
            <th>Title of Book</th>
            <th>Editor(s)</th>
            <th>Publisher</th>
            <th>Place of Publication</th>
            <th>Date of Publication</th>
            <th>Pages</th>
            <th>ISBN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_chapter_in_edited_book as $data)
        <tr>
            <td>{{ $data->author }}</td>    
            <td>{{ $data->title_of_work }}</td>
            <td>{{ $data->title_of_book }}</td>
            <td>{{ $data->editor }}</td>
            <td>{{ $data->publisher }}</td>
            <td>{{ $data->place_of_publication }}</td>
            <td>{{ $data->date_of_publication }}</td>
            <td>{{ $data->pages }}</td>
            <td>{{ $data->isbn }}</td>        
        </tr>
        @endforeach
    </tbody>
</table>