<h2>TEACHING EXPERIENCE AT DLSU</h2>
<table class="table">
    <thead>
        <tr>
            <th>Level</th>
            <th>Years</th>
            <th>Inclusive Dates</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_teaching_experience_dlsu as $data)
        <tr>
            <td>{{ $data->level }}</td>
            <td>{{ $data->years }}</td>
            <td>{{ $data->inclusive_dates }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@include('faculty.exports.faculty_teaching_experience_other')
<br>
@include('faculty.exports.faculty_professional_experience')
<br>
@include('faculty.exports.faculty_professional_practice_dlsu')
<br>
@include('faculty.exports.faculty_professional_practice')