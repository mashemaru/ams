@extends('layouts.app', ['title' => __('Faculty Information Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Faculty Search') }}</h3>
                            </div>
                            @if(request()->get('query'))
                            <div class="col-4 text-right">
                                <form method="post" action="{{ route('faculty.search-download') }}" class="float-right">
                                    @csrf
                                    <input type="hidden" name="query" value="{{ request()->get('query') }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Download</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    <form method="get" action="{{ route('faculty.search') }}" autocomplete="off">
                    <div class="card-body">
                        <select class="form-control form-control-alternative" name="query">
                            <option value>Select Search</option>
                            <option value="teaching_experience"{{ (request()->get('query') == 'teaching_experience') ? ' selected' : '' }}>Teaching Experience</option>
                            {{-- <option value="professional_experience"{{ (request()->get('query') == 'professional_experience') ? ' selected' : '' }}>Professional Experience</option> --}}
                        </select>
                        {{-- <div class="accordion search-accordion" id="search-accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h5 class="mb-0">Teaching Experience</h5>
                                </div>
                                <div id="collapseOne" class="collapse{{ (request()->get('teaching_experience')) ? ' show' : '' }}" aria-labelledby="headingOne" data-parent="#search-accordion">
                                    <div class="card-body">
                                        <select class="form-control form-control-alternative" name="teaching_experience">
                                            <option value>Select Rank</option>
                                            <option value="15"{{ (request()->get('teaching_experience') == '15') ? ' selected' : '' }}>15 and above</option>
                                            <option value="10-14"{{ (request()->get('teaching_experience') == '10-14') ? ' selected' : '' }}>10 - 14</option>
                                            <option value="4-9"{{ (request()->get('teaching_experience') == '4-9') ? ' selected' : '' }}>4 - 9</option>
                                            <option value="1-3"{{ (request()->get('teaching_experience') == '1-3') ? ' selected' : '' }}>1 - 3</option>
                                            <option value="0"{{ (request()->get('teaching_experience') == '0') ? ' selected' : '' }}>Less than 1</option>
                                        </select>
                                    </div>
                                </div>
                          </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="mb-0">Collapsible Group Item #2</h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#search-accordion">
                                    <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h5 class="mb-0">Collapsible Group Item #3</h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#search-accordion">
                                    <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <a href="{{ route('faculty.search') }}" class="btn btn-warning">Reset</a>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @if ($teaching_experience)
                @include('faculty.search.teaching_experience')
            @endif
            {{-- <div class="col-9">
                <div class="card shadow">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Department') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->department }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div> --}}
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection