<h2>Academic Background</h2>
<table class="table">
    <thead>
        <tr>
            <th>Degrees Earned</th>
            <th>Title of Degree</th>
            <th>Area of Specialization</th>
            <th>Year Obtained</th>
            <th>Educational Institution</th>
            <th>Location (City, Country)</th>
            <th>S.O. Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_academic_background as $data)
        <tr>
            <td>{{ $data->degrees_earned }}</td>
            <td>{{ $data->title_of_degree }}</td>
            <td>{{ $data->area_of_specialization }}</td>
            <td>{{ $data->year_obtained }}</td>
            <td>{{ $data->educational_institution }}</td>
            <td>{{ $data->location }}</td>
            <td>{{ $data->so_number }}</td>
        </tr>
        @endforeach
    </tbody>
</table>