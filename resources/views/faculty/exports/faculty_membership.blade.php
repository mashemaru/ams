<h2>MEMBERSHIP IN PROFESSIONAL ORGANIZATIONS</h2>
<table class="table">
    <thead>
        <tr>
            <th>Designation/Role</th>
            <th>Professional Organization</th>
            <th>Inclusive Years</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->faculty_membership as $data)
        <tr>
            <td>{{ $data->role }}</td>
            <td>{{ $data->professional_organization }}</td>
            <td>{{ $data->inclusive_years }}</td>
        </tr>
        @endforeach
    </tbody>
</table>