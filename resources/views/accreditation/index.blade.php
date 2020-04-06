@extends('layouts.app', ['title' => __('Accreditation Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Accreditations') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accreditation.create') }}" class="btn btn-primary btn-sm"><span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Add Accreditation</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pb-4">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Degree Program') }}</th>
                                    <th scope="col">{{ __('Agency') }}</th>
                                    <th scope="col">{{ __('Document') }}</th>
                                    <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Result') }}</th>
                                    <th scope="col">{{ __('End Date') }}</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accreditations as $a)
                                    <tr>
                                        <td>{{ $a->program->program_name }}</td>
                                        <td>{{ $a->agency->agency_code }}</td>
                                        <td>{{ $a->document->document_name }}</td>
                                        <td>{{ ($a->type == 'initial') ? 'Initial Accreditation' : 'Reaccreditation' }}</td>
                                        <td>
                                            @if($a->progress == 'initial')
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">Pre-Accreditation Phase</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">{{ isset($a->timeline->status) ? number_format($a->timeline->status) . '%': '0%' }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ ($a->result) ?: 'N/A' }}</td>
                                        <td>{{ ($a->end_date) ? $a->end_date->format('M d Y') : 'N/A' }}</td>
                                        <td>
                                            @if ($a->progress != 'completed')
                                            <button class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#timelineModal-{{ $a->id }}"><span class="btn-inner--icon"><i class="ni ni-calendar-grid-58 mr-1"></i></span> Timeline</button>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if ($a->progress == 'initial')
                                                    <a href="{{ route('accreditation.edit', $a) }}" class="dropdown-item">{{ __('Formal Accredit') }}</a>
                                                    @endif
                                                    @if ($a->progress == 'completed' && $a->recommendations == '')
                                                    <a href="{{ route('accreditation.show.recommendation', $a) }}" class="dropdown-item">{{ __('Add Recommendation') }}</a>
                                                    @endif
                                                    <a href="{{ route('accreditation.show', $a) }}" class="dropdown-item">{{ __('View Summary') }}</a>
                                                    @if ($a->progress != 'completed')
                                                        <a href="{{ route('accreditation.team.create', $a) }}" class="dropdown-item">{{ __('Create Team') }}</a>
                                                        <a href="{{ route('accreditation.assignTeam', $a) }}" class="dropdown-item">{{ __('Assign Team') }}</a>
                                                        <form action="{{ route('accreditation.destroy', $a) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this accreditation?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    @if($a->timeline)
                                    <div class="modal fade" id="timelineModal-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="timelineModalLabel-{{ $a->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="timelineModalLabel-{{ $a->id }}">Accreditation Timeline</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form method="post" action="{{ route('timeline.is_complete_update', $a->timeline ) }}" autocomplete="off">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label d-flex align-items-center">
                                                                <div class="mr-3">{{ $a->program->program_name }} {{ $a->agency->agency_name }} Timeline</div>
                                                                @role('super-admin')<a href="{{ route('timeline.edit', $a) }}" class="btn btn-primary btn-sm ml-auto">Edit Timeline</a>@endrole
                                                            </label><br>
                                                            @foreach($a->timeline->task as $key => $t)
                                                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                                                    <input class="custom-control-input" name="task[{{ $key }}]" id="customCheck{{ $a->id }}-{{ $key }}" type="checkbox"{{ ($t['is_complete']) ? ' checked disabled' : '' }}>
                                                                    @if($t['is_complete'])
                                                                    <input type="hidden" name="task[{{ $key }}]" value="on">
                                                                    @endif
                                                                    <label class="custom-control-label" for="customCheck{{ $a->id }}-{{ $key }}">{{ $t['task'] }}<span><h6 class="text-muted">{{ $t['date'] }}</h6></span></label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        @if($a->timeline->status == 100 && $a->progress != 'initial')
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-notification-{{ $a->id }}">Complete Accreditation</button>
                                                        @else
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-notification-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification-{{ $a->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Your attention is required</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="py-3 text-center">
                                                        <i class="ni ni-bell-55 ni-3x"></i>
                                                        <h4 class="heading mt-4">You should read this!</h4>
                                                        <p>Completing the accreditation would indicate that the On-Site visit has been completed and your results have been released. Are you sure the everything is complete?</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('accreditation.show.complete', $a->timeline) }}"><button type="button" class="btn btn-white">Yes, it's complete</button></a>
                                                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">No, it's not</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $accreditations->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection