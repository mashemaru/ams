<h2>LEADERSHIP IN PROFESSIONAL ORGANIZATIONS</h2>
<table class="table">
    <thead>
        <tr>
            <th>Designation/Role</th>
            <th>Professional Organization</th>
            <th>Inclusive Years</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_leadership as $data)
        <tr>
            <td>{{ $data->role }}</td>
            <td>{{ $data->professional_organization }}</td>
            <td>{{ $data->inclusive_years }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@include('faculty.exports.faculty_membership')
<br>
@include('faculty.exports.faculty_achievements')
<br>
@include('faculty.exports.faculty_internally_funded_research')
<br>
@include('faculty.exports.faculty_externally_funded_research')
<br>
@include('faculty.exports.faculty_research_grants')
<br>
@include('faculty.exports.faculty_journal_publication')
<br>
@include('faculty.exports.faculty_prototypes')
<br>
@include('faculty.exports.faculty_patents')
<br>
@include('faculty.exports.faculty_books_and_textbooks')
<br>
@include('faculty.exports.faculty_chapter_in_edited_book')
<br>
@include('faculty.exports.faculty_conference_proceedings_papers')
<br>
@include('faculty.exports.faculty_published_creative_work')
<br>
@include('faculty.exports.faculty_creative_work_performed')
<br>
@include('faculty.exports.faculty_programs_developeds')
<br>
@include('faculty.exports.faculty_other_research_outputs')
<br>
@include('faculty.exports.faculty_conferences_attended')
