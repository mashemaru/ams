<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('home') ? ' active' : '' }}" href="{{ route('home') }}"> 
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('task.*') ? ' active' : '' }}" href="{{ route('task.index') }}">
                        <i class="ni ni-check-bold text-blue"></i> Tasks
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('notification.*') ? ' active' : '' }}" href="{{ route('notification.index') }}">
                        <i class="ni ni-bell-55 text-yellow"></i> Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('activities.*') ? ' active' : '' }}" href="{{ route('activities.index') }}">
                        <i class="ni ni-calendar-grid-58 text-orange"></i> Activities
                    </a>
                </li>
            </ul>
            {{-- @role('super-admin') --}}
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Administration & Setup</h6>
            <ul class="navbar-nav">
                @if(auth()->user()->can('view agency'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('agency.*') ? ' active' : '' }}" href="{{ route('agency.index') }}">
                        <i class="ni ni-building text-blue"></i> Agencies
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view program'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('program.*') ? ' active' : '' }}" href="{{ route('program.index') }}">
                        <i class="ni ni-hat-3 text-blue"></i> Programs
                    </a>
                </li>
                @endif
                @canany(['view course','view curriculum'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-instruction" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-instruction">
                        <i class="ni ni-ruler-pencil text-yellow"></i>
                        <span class="nav-link-text">Instruction</span>
                    </a>
                    <div class="collapse" id="navbar-instruction" style="">
                        <ul class="nav nav-sm flex-column">
                            @if(auth()->user()->can('view course'))
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('course.*') ? ' active' : '' }}" href="{{ route('course.index') }}">
                                    Courses
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('view curriculum'))
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('curriculum.*') ? ' active' : '' }}" href="{{ route('curriculum.index') }}">
                                    Curriculums
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endcanany
                @canany(['view course','view curriculum','view faculty'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-reports" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-reports">
                        <i class="ni ni-collection text-red"></i>
                        <span class="nav-link-text">Reports</span>
                    </a>
                    <div class="collapse" id="navbar-reports" style="">
                        <ul class="nav nav-sm flex-column">
                            @if(auth()->user()->can('view course'))
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('course.*') ? ' active' : '' }}" href="/course-search">
                                    Courses
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('view curriculum'))
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('curriculum.*') ? ' active' : '' }}" href="/curriculum-search">
                                    Curriculums
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('view faculty'))
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('faculty.*') ? ' active' : '' }}" href="/faculty-search">
                                    Faculty
                                </a>
                            </li>
                            @endif
                            @hasanyrole('super-admin|team-head')
                            <li class="nav-item">
                                <a class="nav-link{{ Route::is('task.*') ? ' active' : '' }}" href="/task-search">
                                    Task
                                </a>
                            </li>
                            @endhasanyrole
                        </ul>
                    </div>
                </li>
                @endcanany
                @if(auth()->user()->can('view scoring-type'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('scoring.*') ? ' active' : '' }}" href="{{ route('scoring.index') }}">
                        <i class="ni ni-book-bookmark text-teal"></i> Scoring Types
                    </a>
                </li>
                @endif
                @canany(['view user','view role-permission'])
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-user" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-user">
                        <i class="ni ni-single-02 text-orange"></i>
                        <span class="nav-link-text">User Management</span>
                    </a>
                    <div class="collapse" id="navbar-user" style="">
                        <ul class="nav nav-sm flex-column">
                            @if(auth()->user()->can('view user'))
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">Users</a>
                            </li>
                            @endif
                            @if(auth()->user()->can('view role-permission'))
                            <li class="nav-item">
                                <a href="{{ route('roles-permission.index') }}" class="nav-link">Roles & Permissions</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endcanany
                @if(auth()->user()->can('view faculty'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('faculty.*') ? ' active' : '' }}" href="{{ route('faculty.index') }}">
                        <i class="ni ni-badge text-orange"></i> Faculty Management
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view document'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('document.*') ? ' active' : '' }}" href="{{ route('document.index') }}">
                        <i class="ni ni-single-copy-04 text-blue"></i> Evaluation Instrument
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view document-outline'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('document-outline.*') ? ' active' : '' }}" href="{{ route('document-outline.index') }}">
                        <i class="ni ni-single-copy-04 text-blue"></i> Document
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view accreditation'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('accreditation.*') ? ' active' : '' }}" href="{{ route('accreditation.index') }}">
                        <i class="ni ni-paper-diploma text-blue"></i> Accreditations
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view team'))
                <li class="nav-item">
                    <a class="nav-link{{ Route::is('team.*') ? ' active' : '' }}" href="{{ route('team.index') }}">
                    <i class="ni ni-circle-08 text-orange"></i> Teams
                </a>
                @endif
                </li>
            </ul>
            @canany(['view accreditation','view team'])
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Configuration</h6>
            <ul class="navbar-nav">
                @if(auth()->user()->can('view accreditation'))
                <li class="nav-item">
                <a class="nav-link" href="{{ route('accreditation.create') }}">
                    <i class="ni ni-paper-diploma text-blue"></i> New Accreditation
                </a>
                </li>
                @endif
                @if(auth()->user()->can('view team'))
                <li class="nav-item">
                <a class="nav-link" href="{{ route('team.create') }}">
                    <i class="ni ni-circle-08 text-orange"></i> Create Team
                </a>
                </li>
                @endif
            </ul>
            @endcanany
            {{-- @endrole --}}
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documents</h6>
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link{{ Route::is('file-repository.*') ? ' active' : '' }}" href="{{ route('file-repository.index') }}">
                    <i class="ni ni-archive-2 text-yellow"></i> File Repository
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link{{ Route::is('appendices-exhibits.*') ? ' active' : '' }}" href="{{ route('appendices-exhibits.index') }}">
                    <i class="ni ni-archive-2 text-yellow"></i> Appendices/Exhibits
                </a>
                </li>
            </ul>
        </div>

    <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
</nav>