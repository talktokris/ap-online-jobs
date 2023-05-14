<!doctype html>
<html lang="en">

<head>
    <title>online jobs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('partimemployer/css/style.css') }}">
</head>
<style>
    .image-location{
        padding-bottom: 17px;
    }
</style>

<body>



    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active" style="background: #E05024">
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{route('partimemployerprofile.edit',$user_profile->id)}}"><span class="fa fa-user"></span> Profile Update</a>
                </li>
                <li>
                    <a href="{{route('upgradeplans',$user_profile->id)}}"><span class="fa fa-sticky-note"></span> Packages</a>
                </li>
               
                <li>
                    <a href="{{route('jobseekerlist',$user_profile->id)}}"><span class="fa fa-user-o"></span>Jobseeker list</a>
                </li>
                <li>
                    <a href="{{route('partimemployerprofile.changepassword',$user_profile->id)}}"><span class="fa fa-eye"></span> Change Password</a>
                </li>
                <li>
                    <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span class="fa fa-power-off icon"></span>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <div>
                <img src="{{ asset('images/Untitled-1.png') }}" class="image-location" alt="">
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn" style="background: #E05024">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">{{ $user_profile->name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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
            @yield('partimemployerprofiles')
        </div>
    </div>

    {{-- <script src="{{ asset('partimemployer/js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="{{ asset('partimemployer/js/popper.js') }}"></script>
    <script src="{{ asset('partimemployer/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('partimemployer/js/main.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @yield('partimescripts')
    
</body>

</html>
