<div class="col-9">
@forelse ($curriculum as $key => $current)
    @if($current)
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="table-responsive">
                    <h2 class="m-0 p-3">{{ __('Curriculum for ') . $current->program->program_name }} {{ $current->start_year }} - {{ $current->end_year }}</h2>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Course Type') }}</th>
                                <th scope="col">{{ __('Count') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($number_course_type[$key] as $k => $type)
                            <tr>
                                <td>{{ $k }}</td>
                                <td>{{ $type }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@empty
    <tr>
        <td colspan="2" class="text-center">No results found</td>
    </tr>
@endforelse
</div>