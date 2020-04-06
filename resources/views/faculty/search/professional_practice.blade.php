@php
$ft_dlsu_0 = $ft_dlsu_3 = $ft_dlsu_9 = $ft_dlsu_14 = $ft_dlsu_15 = $pt_dlsu_0 = $pt_dlsu_3 = $pt_dlsu_9 = $pt_dlsu_14 = $pt_dlsu_15 = 0;
$ft_other_0 = $ft_other_3 = $ft_other_9 = $ft_other_14 = $ft_other_15 = $pt_other_0 = $pt_other_3 = $pt_other_9 = $pt_other_14 = $pt_other_15 = 0;
foreach($professional_practice as $key => $exp) {
    if($key == 'FT') {
        foreach($exp as $item) {
            if($item['faculty_experience_dlsu'] <= 0 && $item['faculty_experience_dlsu'] != null) {
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

            if($item['faculty_experience_other'] <= 0 && $item['faculty_experience_other'] != null) {
                $ft_other_0++;
            } else if($item['faculty_experience_other'] >= 1 && $item['faculty_experience_other'] <= 3) {
                $ft_other_3++;
            } else if($item['faculty_experience_other'] >= 4 && $item['faculty_experience_other'] <= 9) {
                $ft_other_9++;
            } else if($item['faculty_experience_other'] >= 10 && $item['faculty_experience_other'] <= 14) {
                $ft_other_14++;
            } else if($item['faculty_experience_other'] >= 15) {
                $ft_other_15++;
            }
        }
    } else if($key == 'PT') {
        foreach($exp as $item) {
            if($item['faculty_experience_dlsu'] <= 0 && $item['faculty_experience_dlsu'] != null) {
                $pt_dlsu_0++;
            } else if($item['faculty_experience_dlsu'] >= 1 && $item['faculty_experience_dlsu'] <= 3) {
                $pt_dlsu_3++;
            } else if($item['faculty_experience_dlsu'] >= 4 && $item['faculty_experience_dlsu'] <= 9) {
                $pt_dlsu_9++;
            } else if($item['faculty_experience_dlsu'] >= 10 && $item['faculty_experience_dlsu'] <= 14) {
                $pt_dlsu_14++;
            } else if($item['faculty_experience_dlsu'] >= 15) {
                $pt_dlsu_15++;
            }

            if($item['faculty_experience_other'] <= 0 && $item['faculty_experience_other'] != null) {
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
@if(isset($isDownload) && $isDownload)
<style>
table{border-collapse:collapse;width:100%}td,th{text-align:left;padding:8px}tr:nth-child(even){background-color:#f2f2f2}.col-md-6{margin-bottom:45px}.card{margin-bottom:45px}
</style>
<div class="col-md-12">
    <h1 class="text-white">Professional practice as of <small><em>{{ now()->setTimezone('Asia/Singapore')->toDayDateTimeString() }}</em></small></h1>
</div>
@endif
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
                        <th colspan="2">{{ __('IT Industry') }}</th>
                        <th colspan="2">{{ __('Other Industries') }}</th>
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

                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mt-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush"">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th rowspan="2">Faculty</th>
                                <th colspan="3">{{ __('Full Time') }}</th>
                            </tr>
                            <tr>
                                <th>{{ __('IT Industry') }}</th>
                                <th>{{ __('Other Industries') }}</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach ($relations['FT'] as $faculty)
                                <tr>
                                    <td>{{ $faculty->name }}</td>
                                    <td>{{ $faculty->faculty_professional_practice_dlsu->sum('years') }}</td>
                                    <td>{{ $faculty->faculty_professional_practice->sum('years') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card shadow mt-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush"">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th rowspan="2">Faculty</th>
                                <th colspan="3">{{ __('Part Time') }}</th>
                            </tr>
                            <tr>
                                <th>{{ __('IT Industry') }}</th>
                                <th>{{ __('Other Industries') }}</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach ($relations['PT'] as $faculty)
                                <tr>
                                    <td>{{ $faculty->name }}</td>
                                    <td>{{ $faculty->faculty_professional_practice_dlsu->sum('years') }}</td>
                                    <td>{{ $faculty->faculty_professional_practice->sum('years') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>