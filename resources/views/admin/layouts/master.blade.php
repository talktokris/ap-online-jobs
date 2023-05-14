<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> {{ config('app.name', 'Laravel') }} </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        <link href="{{ asset('admin-assets/css/vendor.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-assets/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <style>
            tfoot {
                display: table-header-group;
            }
            table.dataTable tfoot th, table.dataTable tfoot td{
                padding: 10px 18px 6px 0;
            }
            .dataTables_filter{
                display: none;
            }
            tr td:nth-child(1){
                display: none;
            }
            tr th:nth-child(1){
                display: none;
            }
        </style>
        <!-- Custom Styles -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        
        <!-- Theme initialization -->
        {{-- <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="http://jobnetwork.testa/admin-assets/css/app-' + themeName + '.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="http://jobnetwork.test/admin-assets/css/app.css">');
            }
        </script> --}}
    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header bg-white" style="z-index: 99;">
					<div class="sidebar-header bg-white">
						<div class="brand">
							<img src="{{asset('images/onlinejobs-logo.png')}}" alt="">
							{{-- <div class="logo">
								<span class="l l1"></span>
								<span class="l l2"></span>
								<span class="l l3"></span>
								<span class="l l4"></span>
								<span class="l l5"></span>
							</div> Online Jobs Admin  --}}
						</div>
					</div>
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-search">
                        {{-- <form role="search">
                            <div class="input-container">
                                <i class="fa fa-search"></i>
                                <input type="search" placeholder="Search">
                                <div class="underline"></div>
                            </div>
                        </form> --}}
                    </div>
                    <div class="header-block header-block-buttons">
                        <h1 class="text-center">Online Jobs @if(Auth::user()->hasRole('agent')) Agent @else Admin @endif</h1>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown">
                                    {{-- <i class="fa fa-commenting fa-2x text-danger"></i> --}}
                                    <small>NOTIFICATIONS</small>
                                    <sup>
                                        <span class="counter text-warning">
                                            {{Auth::user()->unreadNotifications->count()}}
                                        </span>
                                    </sup>
                                </a>
                                <div style="max-height:370px;" class="dropdown-menu notifications-dropdown-menu">
                                    <ul style="max-height:325px; overflow:scroll;" class="notifications-container">
                                        @if(Auth::user()->unreadNotifications->count() > 0)
                                        @foreach (Auth::user()->unreadNotifications as $notification)
                                            <li>
                                                <a href="{{route('admin.readSingleNotification',$notification->id)}}" class="notification-item">
                                                    <div class="body-col">
                                                        <p><span class="accent">{{$notification->data['message']}}</span></p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        @else 
                                            <li>
                                                <a href="" class="notification-item">
                                                    <div class="body-col">
                                                        <p><span class="accent">No new Notification!!</span></p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                        <ul>
                                            <li>
                                                <div class="body-col text-center">
                                                    <a href="{{route('admin.showAllNotification')}}"> View All </a>
                                                </div>
                                            </li>
                                        </ul>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div>
                                    @auth
                                    <span class="name">{{Auth::user()->name}}</span>
                                    @endauth
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    @if(Auth::user()->hasRole('agent'))
                                    <a class="dropdown-item" href="{{route('agent.edit', Auth::user()->id)}}">
                                        <i class="fa fa-user icon"></i>Edit Profile </a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    @if(Auth::user()->hasRole('part-timer'))
                                    <a class="dropdown-item" href="{{route('agent.edit', Auth::user()->id)}}">
                                        <i class="fa fa-user icon"></i>Edit Profile </a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    {{-- <a class="dropdown-item" href="#">
                                        <i class="fa fa-bell icon"></i> Notifications </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Settings </a> --}}
                                    <a class="dropdown-item" href="{{route('changePassword')}}">
                                            <i class="fa fa-user icon"></i>Change Password </a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off icon"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class="{{ ( (Route::currentRouteName() === "admin.home") ? "active" : "") }}">
                                    <a href="/admin">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin|sub-agent|part-timer'))
                                    <li class="mydropdown">
                                        <a href="">
                                            <i class="fa fa-users"></i> Employers
                                            <i class="fa arrow"></i>
                                        </a>
                                        <ul class="sidebar-nav">
                                            <li class="{{ ( (Route::currentRouteName() === "admin.employer.index") ? "active" : "" ) }}">
                                            <!-- active employer count added --1/5/2020 -->
                                                <a href="{{route('admin.employer.index')}}"> Active Employers ({{$active_employer}})</a>    
                                            </li>
                                            @if(Auth::user()->hasRole('superadministrator|administrator|cadmin'))
                                                <li class="{{ ( (Route::currentRouteName() === "admin.employerBlocked") ? "active" : "" ) }}">
                                                <!-- active employer count added --3/10/2020 -->
                                                    <a href="/blocked-employer"> Blocked Employers ({{$blocked_employer}})</a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.employerApplication") ? "active" : "" ) }}">
                                                    <!-- employer application count added 1/5/2020 -->
                                                    <a href="{{route('admin.employerApplication')}}"> Employer Apllications ({{$employer_application}})</a>
                                                </li>
                                            @endif
                                            @if(Auth::user()->hasRole('superadministrator|administrator'))
                                                <li class="{{ ( (Route::currentRouteName() === "admin.employerDemands") ? "active" : "" ) }}">
                                                    <!-- employer demand count added 1/5/2020 -->
                                                    <a href="{{route('admin.employerDemands')}}"> Employer Demands ({{$employer_demand}})</a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.employerOffers") ? "active" : "" ) }}">
                                                    <a href="{{route('admin.employerOffers')}}"> Employer Offers</a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.job.index") ? "active" : "" ) }}">
                                                    <!-- job count added 1/5/2020 -->
                                                    <a href="{{route('admin.job.index')}}"> Jobs ({{$jobs}})</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin'))
                                    <li class="mydropdown">
                                        <a href="">
                                            <i class="fa fa-users"></i> Business Partners
                                            <i class="fa arrow"></i>
                                        </a>
                                        <ul class="sidebar-nav">
                                            <li class="{{ ( (Route::currentRouteName() === "admin.agent.index") ? "active" : "") }}">
                                                <!-- active business partner count added 1/5/2020 -->
                                                <a href="{{route('admin.agent.index')}}"> Active Business Partners ({{$active_business_partner}})</a>
                                            </li>

                                            <li class="{{ ( (Route::currentRouteName() === "admin.agentBlocked") ? "active" : "") }}">
                                                <!-- active business partner count added 3/11/2020 -->
                                                <a href="/blocked-agent"> Blocked Business Partners ({{$blocked_business_partner}})</a>
                                            </li>

                                            <li class="{{ ( (Route::currentRouteName() === "admin.agentApplication") ? "active" : "") }}">
                                                <!-- business partner application count added--1/5/2020  -->
                                                <a href="{{route('admin.agentApplication')}}"> Business Partner Apllications ({{$business_partner_application}})</a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.rejectedAgentApplication") ? "active" : "") }}">
                                                <!-- pending agent application count added 1/5/2020 -->
                                                <a href="{{route('admin.rejectedAgentApplication')}}">Pending Apllications ({{$pending_agent_application}})</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin|sub-agent|part-timer'))
                                    <li class="mydropdown">
                                        <a href="">
                                            <i class="fa fa-users"></i> Job Seekers
                                            <i class="fa arrow"></i>
                                        </a>
                                        <ul class="sidebar-nav">
                                            <li class="{{ ( (Route::currentRouteName() === "admin.professional.index") ? "active" : "") }}">
                                                <a href="{{route('admin.professional.index')}}">
                                                <!-- job seeker count added 1/5/2020 -->
                                                <i class="fa fa-pencil-square-o"></i>Active Job Seekers ({{$job_seekers}})</a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.fast.registration") ? "active" : "") }}">
                                                <a href="{{route('admin.fast.registration')}}">
                                                <!-- job seeker count added 1/5/2020 -->
                                                <i class="fa fa-pencil-square-o"></i>Blue Worker Position Name ({{$fast_registration}})</a>
                                            </li>
                                            @if(Auth::user()->hasRole('superadministrator|administrator|cadmin'))
                                                <li class="{{ ( (Route::currentRouteName() === "admin.professionalBlocked") ? "active" : "") }}">
                                                    <!-- active business partner count added 3/11/2020 -->
                                                    <a href="/blocked-professional"> Blocked Job Seekers ({{$blocked_job_seekers}})</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin|sub-agent|part-timer'))
                                        <li class="mydropdown">
                                            <a href="">
                                                <i class="fa fa-users"></i> Retired
                                                <i class="fa arrow"></i>
                                            </a>
                                            <ul class="sidebar-nav">
                                                <li class="{{ ( (Route::currentRouteName() === "admin.retired.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.retired.index')}}">
                                                        <!-- retired count added 1/5/2020 -->
                                                    <i class="fa fa-pencil-square-o"></i> Retired ({{$retired}})</a>
                                                </li>
                                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin'))
                                                    <li class="{{ ( (Route::currentRouteName() === "admin.retiredBlocked") ? "active" : "") }}">
                                                        <!-- active business partner count added 3/11/2020 -->
                                                        <a href="/blocked-retired"> Blocked Retired ({{$blocked_retired}})</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                @endif
                                @if(Auth::user()->hasRole('superadministrator|administrator|cadmin|agent|sub-agent|part-timer'))
                                    <li class="{{ ( (Route::currentRouteName() === "admin.worker.index") ? "active" : "") }}">
                                        <a href="{{route('admin.worker.index')}}">
                                            <!-- foreign worker count added 1/5/2020 -->
                                            <i class="fa fa-pencil-square-o"></i> Foreign Worker ({{$foreign_worker}})</a>
                                    </li>
                                    <li class="{{ ( (Route::currentRouteName() === "admin.maid.index") ? "active" : "") }}">
                                        <a href="{{route('admin.maid.index')}}">
                                        <!-- domestic maid count added 1/5/2020 -->
                                        <i class="fa fa-pencil-square-o"></i> Domestic Maids ({{$domestic_maid}})</a>
                                    </li>
                                @endif

                                @if(Auth::user()->hasRole('superadministrator'))
                                    <li class="mydropdown">
                                        <a href="">
                                            <i class="fa fa-users"></i> Part Time Services
                                            <i class="fa arrow"></i>
                                        </a>
                                        <ul class="sidebar-nav">
                                            <li class="{{ ( (Route::currentRouteName() === "") ? "active" : "") }}">
                                                <a href="/pmaid/active">
                                                <i class="fa fa-pencil-square-o"></i>Approved  jobseeker({{$active_part_time_maid}})</a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.partTimeMaid.index") ? "active" : "") }}">
                                                <a href="/maid/index">
                                                <i class="fa fa-pencil-square-o"></i>Jobseeker Application({{$part_time_maid_application}})</a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "") ? "active" : "") }}">
                                                <a href="/pmaid/blocked">
                                                <i class="fa fa-pencil-square-o"></i>Blocked jobseeker({{$blocked_part_time_maid}})</a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "partTimeEmployer") ? "active" : "") }}">
                                                <a href="{{route('partTimeEmployer')}}">
                                                    <!-- retired count added 1/5/2020 -->
                                                <i class="fa fa-pencil-square-o"></i>Part Time Employer Application({{$part_time_employers}})</a>
                                            </li>

                                            <li class="{{ ( (Route::currentRouteName() === "activePartTimeEmployer") ? "active" : "") }}">
                                                <a href="{{route('activePartTimeEmployer')}}">
                                                    <!-- retired count added 1/5/2020 -->
                                                <i class="fa fa-pencil-square-o"></i>Approved Part Time Employer({{$active_part_time_employers}})</a>
                                            </li>

                                            <li class="{{ ( (Route::currentRouteName() === "inactivePartTimeEmployer") ? "active" : "") }}">
                                                <a href="{{route('inactivePartTimeEmployer')}}">
                                                    <!-- retired count added 1/5/2020 -->
                                                <i class="fa fa-pencil-square-o"></i>Reject Part Time Employer({{$inactive_part_time_employers}})</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                              
                                @if(Auth::user()->hasRole('agent'))
                                    <li class="{{ ( (Route::currentRouteName() === "admin.employerDemands") ? "active" : "") }}">
                                        <a href="{{route('admin.employerDemands')}}">
                                            <!-- employer demand count added 1/5/2020 -->
                                            <i class="fa fa-pencil-square-o"></i> Employer Demands </a>
                                    </li>
                                    <li class="{{ ( (Route::currentRouteName() === "admin.downloadFiles") ? "active" : "") }}">
                                        <a href="{{route('admin.downloadFiles')}}">
                                            <i class="fa fa-download"></i> Download Files </a>
                                    </li>
                                @endif

                                @if(Auth::user()->hasRole('superadministrator|cadmin'))
                                    <li class="mydropdown">
                                        <a href="">
                                            <i class="fa fa-users"></i> Settings
                                            <i class="fa arrow"></i>
                                        </a>
                                        <ul class="sidebar-nav">
                                            <!-- users added by milesh 4/10/2020 -->
                                            <li class="{{ ( (Route::currentRouteName() === "user.index") ? "active" : "") }}">
                                                <a href="{{route('user.index')}}"> Users </a>
                                            </li>
                                            <!-- 4/10/2020 -->
                                            <li class="{{ ( (Route::currentRouteName() === "admin.country.index") ? "active" : "") }}">
                                                <a href="{{route('admin.country.index')}}"> Countries </a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.state.index") ? "active" : "") }}">
                                                <a href="{{route('admin.state.index')}}"> State </a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.city.index") ? "active" : "") }}">
                                                <a href="{{route('admin.city.index')}}"> City </a>
                                            </li>
                                            @if(Auth::user()->hasRole('superadministrator'))
                                                <li class="{{ ( (Route::currentRouteName() === "admin.gallery.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.gallery.index')}}"> Gallery </a>
                                                </li>
                                            
                                                <li class="{{ ( (Route::currentRouteName() === "admin.downloads.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.downloads.index')}}"> Downloads </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.sector.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.sector.index')}}"> Sectors </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.religion.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.religion.index')}}"> Religions </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.gender.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.gender.index')}}"> Gender </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.maritalStatus.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.maritalStatus.index')}}"> Marital Status </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.skillLevel.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.skillLevel.index')}}"> Skill Level </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.skill.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.skill.index')}}"> Skill </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.facilities.index") ? "active" : "") }}">
                                                <a href="{{route('admin.facilities.index')}}"> Facilities </a>
                                                </li>
                                                <li class="{{ ( (Route::currentRouteName() === "admin.options.index") ? "active" : "") }}">
                                                    <a href="{{route('admin.options.index')}}"> Options </a>
                                                </li>
                                            @endif
                                            <li class="{{ ( (Route::currentRouteName() === "admin.language.index") ? "active" : "") }}">
                                                <a href="{{route('admin.language.index')}}"> Languages </a>
                                            </li>
                                        
                                        
                                            
                                        
                                            <li class="{{ ( (Route::currentRouteName() === "admin.educationLevel.index") ? "active" : "") }}">
                                                <a href="{{route('admin.educationLevel.index')}}"> Education Level </a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.retiredPersonnelAcademic.index") ? "active" : "") }}">
                                                <a href="{{route('admin.retiredPersonnelAcademic.index')}}"> Academic </a>
                                            </li>
                                            <li class="{{ ( (Route::currentRouteName() === "admin.specialization.index") ? "active" : "") }}">
                                                <a href="{{route('admin.specialization.index')}}"> Specialization </a>
                                            </li>
                                        
                                            {{-- <li>
                                                <a href="#"> Employer Apllications </a>
                                            </li> --}}
                                        </ul>
                                    </li>
                                    @if(Auth::user()->hasRole('superadministrator|administrator'))         
                                        <li class="{{ ( (Route::currentRouteName() === "admin.proposedGwDm") ? "active" : "") }}">
                                            <a href="{{route('admin.proposedGwDm')}}">
                                                <!-- Proposed gw dm count addded 1/5/2020 -->
                                                <i class="fa fa-users"></i> Proposed GW/DM({{$proposed_gw_dm}})</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </nav>
                    </div>
                    
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                
                <article class="content dashboard-page">
                    @if(Session::has('message'))
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @yield('content')
                </article>
                
                <footer class="footer">
                    
                    <div class="footer-block buttons">
                        
                    </div>
                    <div class="footer-block author">
                        <p>Online Jobs</p>
                    </div>
                </footer>
                <div class="modal fade" id="modal-media">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Media Library</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body modal-tab-container">
                                <ul class="nav nav-tabs modal-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content modal-tab-content">
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="images-container">
                                            <div class="row"> </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                        <div class="upload-container">
                                            <div id="dropzone">
                                                <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                    <div class="dz-message-block">
                                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Insert Selected</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="confirm-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-warning"></i> Alert</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to do this?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="{{asset('admin-assets/js/vendor.js')}}"></script>
        <script src="{{asset('admin-assets/js/app.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script></script>

        @yield('javascript')
        <script>
            $(".mydropdown").mouseenter(function() {
                $(this).addClass('active');
                $(this).children('.sidebar-nav').addClass('in').css("height", "auto");
            }).mouseleave(function() {
                $(this).removeClass('active')
                $(this).children('.sidebar-nav').removeClass('in').css("height", "0");
            });
        </script>
    </body>
</html>