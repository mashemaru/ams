@extends('layouts.app', ['title' => __('Faculty Information')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-2">
            <div class="card card-profile">
                <div style="height: 175px" class="bg-gradient-info card-img-top"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="/argon/img/theme/team-4-800x800.jpg" width="120px" height="120px" class="rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-header text-right border-0 pt-6 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex8 float-right">
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">Edit Profile</a>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="text-center mb-5">
                        <h5 class="h3">{{ auth()->user()->name }}</h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{ auth()->user()->department }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Given Name</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->firstname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Middle Initial</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->mi }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Surname</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->surname }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Email</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->email }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="heading-small text-muted mb-4">&nbsp</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">College/Unit</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->college }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">Department/Office</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ auth()->user()->department }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">User Type</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ ucfirst(auth()->user()->user_type) }}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="mb-3 text-sm text-muted">User Role</p>
                                </div>
                                <div class="col-7">
                                    <p class="mb-0 text-sm"><b>{{ ucwords($roles->implode(', ')) }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Faculty Information Form</h3>
                </div>
                {{-- <div class="col text-right">
                    <a href="#!" class="btn btn-sm btn-primary">Download</a>
                </div> --}}
            </div>
        </div>
        <div class="nav-wrapper py-0">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 active rounded-0" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">ACADEMIC BACKGROUND</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">EDUCATIONAL AND PROFESSIONAL EXPERIENCE</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">PROFESSIONAL ACTIVITIES</a>
                </li>
                <li class="nav-item px-0">
                    <a class="nav-link mb-sm-3 mb-md-0 rounded-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">COMMUNITY SERVICE</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="accordion" id="accordionExample">
                        @include('faculty.tab.faculty_academic_background', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_graduate_studies', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_special_training', ['faculty' => auth()->user()])
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="accordion" id="accordionExample2">
                        @include('faculty.tab.faculty_teaching_experience_dlsu', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_teaching_experience_other', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_professional_experience', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_professional_practice_dlsu', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_professional_practice', ['faculty' => auth()->user()])
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="accordion" id="accordionExample3">
                        @include('faculty.tab.faculty_leadership', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_membership', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_achievements', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_internally_funded_research', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_externally_funded_research', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_research_grants', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_journal_publication', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_prototypes', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_patents', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_books_and_textbooks', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_chapter_in_edited_book', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_conference_proceedings_papers', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_published_creative_work', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_creative_work_performed', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_programs_developeds', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_other_research_outputs', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_conferences_attended', ['faculty' => auth()->user()])
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                    <div class="accordion" id="accordionExample4">
                        @include('faculty.tab.faculty_community_service_dlsu', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_community_service_professional', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_community_service_government', ['faculty' => auth()->user()])
                        @include('faculty.tab.faculty_community_service_others', ['faculty' => auth()->user()])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
