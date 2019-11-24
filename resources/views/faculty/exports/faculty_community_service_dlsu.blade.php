<h2>Community Service in DLSU (Department, Unit, College, University) Activities since 2005</h2>
<table class="table">
    <thead>
        <tr>
            <th>Description of  Involvement/Service/Work Done</th>
            <th>Unit/Committee</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_community_service_dlsu as $data)
        <tr>
            <td>{{ $data->service_description }}</td>
            <td>{{ $data->service_unit }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@include('faculty.exports.faculty_community_service_professional')
<br>
@include('faculty.exports.faculty_community_service_government')
<br>
@include('faculty.exports.faculty_community_service_others')