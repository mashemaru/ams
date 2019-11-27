@extends('layouts.app', ['title' => __('Faculty Information Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ __('Faculty Search') }}</h3>
                    </div>
                    <form method="get" action="{{ route('faculty.search') }}" autocomplete="off">
                    <div class="card-body">
                        <select class="form-control form-control-alternative" name="query">
                            <option value>Select Search</option>
                            <option value="teaching_experience"{{ (request()->get('query') == 'teaching_experience') ? ' selected' : '' }}>Teaching Experience</option>
                            <option value="professional_experience"{{ (request()->get('query') == 'professional_experience') ? ' selected' : '' }}>Professional Experience</option>
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
                @php
                    $ft_dlsu_0 = $ft_dlsu_3 = $ft_dlsu_9 = $ft_dlsu_14 = $ft_dlsu_15 = $pt_dlsu_0 = $pt_dlsu_3 = $pt_dlsu_9 = $pt_dlsu_14 = $pt_dlsu_15 = 0;
                    $ft_other_0 = $ft_other_3 = $ft_other_9 = $ft_other_14 = $ft_other_15 = $pt_other_0 = $pt_other_3 = $pt_other_9 = $pt_other_14 = $pt_other_15 = 0;
                    foreach($teaching_experience as $key => $exp) {
                        if($key == 'FT') {
                            foreach($exp as $item) {
                                if($item['faculty_experience_dlsu'] <= 0) {
                                    $ft_dlsu_0++;
                                } else if($item['faculty_experience_dlsu'] >= 1 && $item['faculty_experience_dlsu'] <= 3) {
                                    $ft_dlsu_3++;
                                } else if($item['faculty_experience_dlsu'] >= 4 && $item['faculty_experience_dlsu'] <= 9) {
                                    $ft_dlsu_9++;
                                } else if($item['faculty_experience_dlsu'] >= 10 && $item['faculty_experience_dlsu'] <= 14) {
                                    $ft_dlsu_14++;
                                } else if($item['faculty_experience_dlsu'] >= 15) {
                                    $ft_dlsu_15++;
                                }

                                if($item['faculty_experience_other'] <= 0) {
                                    $pt_dlsu_0++;
                                } else if($item['faculty_experience_other'] >= 1 && $item['faculty_experience_other'] <= 3) {
                                    $pt_dlsu_3++;
                                } else if($item['faculty_experience_other'] >= 4 && $item['faculty_experience_other'] <= 9) {
                                    $pt_dlsu_9++;
                                } else if($item['faculty_experience_other'] >= 10 && $item['faculty_experience_other'] <= 14) {
                                    $pt_dlsu_14++;
                                } else if($item['faculty_experience_other'] >= 15) {
                                    $pt_dlsu_15++;
                                }
                            }
                        } else if($key == 'PT') {
                            foreach($exp as $item) {
                                if($item['faculty_experience_dlsu'] <= 0) {
                                    $ft_other_0++;
                                } else if($item['faculty_experience_dlsu'] >= 1 && $item['faculty_experience_dlsu'] <= 3) {
                                    $ft_other_3++;
                                } else if($item['faculty_experience_dlsu'] >= 4 && $item['faculty_experience_dlsu'] <= 9) {
                                    $ft_other_9++;
                                } else if($item['faculty_experience_dlsu'] >= 10 && $item['faculty_experience_dlsu'] <= 14) {
                                    $ft_other_14++;
                                } else if($item['faculty_experience_dlsu'] >= 15) {
                                    $ft_other_15++;
                                }

                                if($item['faculty_experience_other'] <= 0) {
                                    $pt_other_0++;
                                } else if($item['faculty_experience_other'] >= 1 && $item['faculty_experience_other'] <= 3) {
                                    $pt_other_3++;
                                } else if($item['faculty_experience_other'] >= 4 && $item['faculty_experience_other'] <= 9) {
                                    $pt_other_9++;
                                } else if($item['faculty_experience_other'] >= 10 && $item['faculty_experience_other'] <= 14) {
                                    $pt_other_14++;
                                } else if($item['faculty_experience_other'] >= 15) {
                                    $pt_other_15++;
                                }
                            }
                        }
                    }
                @endphp
                <div class="col-9">
                    <div class="card shadow">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush"">
                                <thead class="thead-light" align="center">
                                    <tr>
                                        <th rowspan="3">Private Years of Experience</th>
                                        <th colspan="4">{{ __('Years of Service') }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ __('In this school') }}</th>
                                        <th colspan="2">{{ __('In other schools') }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Full-Time') }}</th>
                                        <th>{{ __('Part-Time') }}</th>
                                        <th>{{ __('Full-Time') }}</th>
                                        <th>{{ __('Part-Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <tr>
                                        <td>15 and above</td>
                                        <td>{{ $ft_dlsu_15 }}</td>
                                        <td>{{ $pt_dlsu_15 }}</td>
                                        <td>{{ $ft_other_15 }}</td>
                                        <td>{{ $pt_other_15 }}</td>
                                    </tr>
                                    <tr>
                                        <td>10 - 14</td>
                                        <td>{{ $ft_dlsu_14 }}</td>
                                        <td>{{ $pt_dlsu_14 }}</td>
                                        <td>{{ $ft_other_14 }}</td>
                                        <td>{{ $pt_other_14 }}</td>
                                    </tr>
                                    <tr>
                                        <td>4 - 9</td>
                                        <td>{{ $ft_dlsu_9 }}</td>
                                        <td>{{ $pt_dlsu_9 }}</td>
                                        <td>{{ $ft_other_9 }}</td>
                                        <td>{{ $pt_other_9 }}</td>
                                    </tr>
                                    <tr>
                                        <td>1 - 3</td>
                                        <td>{{ $ft_dlsu_3 }}</td>
                                        <td>{{ $pt_dlsu_3 }}</td>
                                        <td>{{ $ft_other_3 }}</td>
                                        <td>{{ $pt_other_3 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Less than 1</td>
                                        <td>{{ $ft_dlsu_0 }}</td>
                                        <td>{{ $pt_dlsu_0 }}</td>
                                        <td>{{ $ft_other_0 }}</td>
                                        <td>{{ $pt_other_0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ array_sum([$ft_dlsu_0, $ft_dlsu_3, $ft_dlsu_9, $ft_dlsu_14, $ft_dlsu_15]) }}</td>
                                        <td>{{ array_sum([$pt_dlsu_0, $pt_dlsu_3, $pt_dlsu_9, $pt_dlsu_14, $pt_dlsu_15]) }}</td>
                                        <td>{{ array_sum([$ft_other_0, $ft_other_3, $ft_other_9, $ft_other_14, $ft_other_15]) }}</td>
                                        <td>{{ array_sum([$pt_other_0, $pt_other_3, $pt_other_9, $pt_other_14, $pt_other_15]) }}</td>
                                    </tr>
                                    {{-- @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->department }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- {{ $teaching_experience }} --}}
                </div>
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