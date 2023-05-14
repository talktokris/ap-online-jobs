<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <script type="text/javascript" src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/floating-wpp.css') }}">
    <script type="text/javascript" src="{{ asset('js/floating-wpp.js') }}"></script>
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("site/css/icomoon.css")}}">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: ; /* Sit on top */
        /* padding-top: 100px; Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
    }

    @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }

    .modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
    padding: 2px 16px;
    background-color: #E05024;
    color: white;
    }

    .ftco-footer {
  font-size: 16px;
  background: #222831;
  padding: 3em 0; }
  .ftco-footer .ftco-footer-logo {
    text-transform: uppercase;
    letter-spacing: .1em; }
  .ftco-footer .ftco-footer-widget h2 {
    font-weight: normal;
    color: #fff;
    margin-bottom: 0px;
    font-size: 20px;
    font-weight: 400; }
  .ftco-footer .ftco-footer-widget ul li a {
    color: rgba(255, 255, 255, 0.4); }
    .ftco-footer .ftco-footer-widget ul li a span {
      color: #fff; }
  .ftco-footer .ftco-footer-widget .btn-primary {
    background: #fff !important;
    border: 2px solid #fff !important; }
    .ftco-footer .ftco-footer-widget .btn-primary:hover {
      background: #fff;
      border: 2px solid #fff !important; }
  .ftco-footer p {
    color: rgba(255, 255, 255, 0.7); }
  .ftco-footer a {
    color: rgba(255, 255, 255, 0.7); }
    .ftco-footer a:hover {
      color: #fff; }
  .ftco-footer .ftco-heading-2 {
    font-size: 17px;
    font-weight: 400;
    color: #000000; }

.ftco-footer-social li {
  list-style: none;
  margin: 0 10px 0 0;
  display: inline-block; }
  .ftco-footer-social li a {
    height: 50px;
    width: 50px;
    display: block;
    float: left;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    position: relative; }
    .ftco-footer-social li a span {
      position: absolute;
      font-size: 26px;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%); }
    .ftco-footer-social li a:hover {
      color: #fff; }

.footer-small-nav > li {
  display: inline-block; }
  .footer-small-nav > li a {
    margin: 0 10px 10px 0; }
    .footer-small-nav > li a:hover, .footer-small-nav > li a:focus {
      color: #157efb; }
</style>
    <style>
        /*body{
            padding-top: 45px;
        }*/
        .transparent_btn {
                display: inline-block;
                padding: 10px 14px;
                color: #FFF;
                border:3px solid #FFF;
                text-decoration: none;
                font-size: 20px;
                line-height: 120%;
                background-color: rgba(255,255,255, 0);
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                -webkit-transition: background-color 300ms ease;
                -moz-transition: background-color 300ms ease;
                transition: background-color 300ms ease;
                cursor: pointer;
            }
            .transparent_btn:hover {
                background-color: rgba(255,255,255, 0.3);
                color: #FFF;
                text-decoration: none;
            }
            .transparent_btn.orange {
                color: #FFF;
                border-color: #E05024;
            }
            .transparent_btn.orange:hover {
                background-color: rgba(224, 80, 36, 1);
            }
            .transparent_btn.blue {
                color: #FFF;
                border-color: #2176bd;
            }
            .transparent_btn.blue:hover {
                background-color: rgba(33, 118, 189, 1);
            }
        tfoot {
            display: table-header-group;
        }
        table.dataTable tfoot th, table.dataTable tfoot td{
            padding: 10px 18px 6px 0;
        }
        .dataTables_filter{
            display: none;
        }
        .my_datatable tr td:nth-child(1){
            display: none;
        }
        .my_datatable tr th:nth-child(1){
            display: none;
        }
    </style>
    <!-- Custom Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!---Multi Search----->
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('site/images/onlinelogo.png')}}" class="img-fluid" style="width:212px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @auth
                        @if(Auth::user()->status == 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notifications
                                    <sup>
                                        <span class="counter text-danger">
                                            {{Auth::user()->unreadNotifications->count()}}
                                        </span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->unreadNotifications->count() > 0)
                                        @foreach (Auth::user()->unreadNotifications as $notification)
                                            <a class="dropdown-item" href="{{route('admin.readSingleNotification',$notification->id)}}">
                                                {{$notification->data['message']}}
                                            </a>
                                        @endforeach
                                    @else 
                                        <a href="" class="dropdown-item">
                                            <div class="body-col">
                                                <p><span class="accent">No new Notification!!</span></p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link " href="#">Notifications</a>
                    </li>
                    @endauth
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest                               
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}"> Login / Register </a> 
                    </li>
                    @endguest
                    
                    @auth
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcomes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item">Logged in as {{Auth::user()->name}}</a>
                            @if(Auth::user()->hasRole('employer'))
                            <a class="dropdown-item" href="{{route('employer.show')}}">Employers Area</a>
                            <a class="dropdown-item" href="{{route('employer.public', Auth::user()->public_id)}}">View Information</a>
                            <a class="dropdown-item" href="{{route('employer.edit', Auth::user()->id)}}">Edit Information</a>
                            @endif
                            @if(Auth::user()->hasRole(['maid', 'worker']) )
                                <a class="dropdown-item" href="{{route('profile.index')}}">Profile</a>
                            @endif
                            @if(Auth::user()->hasRole('agent') )
                                <a class="dropdown-item" href="{{route('agent.index')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('superadministrator') )
                                <a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('cadmin') )
                                <a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('sub-agent') )
                                <a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('part-timer') && Auth::user()->status == 1 )
                                <a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('professional') )
                                <a class="dropdown-item" href="{{route('professional.profile')}}">Profile</a>
                            @endif
                            @if(Auth::user()->hasRole('retired') )
                                <a class="dropdown-item" href="{{route('retiredPersonnel.profile')}}">Profile</a>
                            @endif

                            <a class="dropdown-item" href="{{route('changePassword')}}">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @if(Session::has('message'))
        <div class="container">
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
        </div>
        @endif
        @yield('content')
    </main>   

     <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
        	<div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About</h2>
              <p>We want to be the world’s leading specialist online recruitment consultancy and Welfare protection provider for Jobseeks and Employer. We provide online CV on local and foreign workers to carter local and global demand</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="https://twitter.com/"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="https://www.facebook.com/Ap-online-jobs-109054537309212"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="https://www.instagram.com/"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Employers</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Help</a></li>
              </ul>
              <h2 class="ftco-heading-2">Jobs Seeker</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Help</a></li>
              </ul>
              <h2 class="ftco-heading-2">Partner</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Help</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Quick Link</h2>
              <ul class="list-unstyled">
                <li><a href="{{route('about.us')}}" class="py-2 d-block">About Us</a></li>
                <li><a href="{{route('who.we.are')}}" class="py-2 d-block">Who We Are</a></li>
                <li><a href="{{route('mission.vision')}}" class="py-2 d-block">Mission, Values and Purpose</a></li>
                <!-- <li><a href="#" class="py-2 d-block">Job Search</a></li> -->
                
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Puchong, Malaysia</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+60 162104126</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@onlinejobs.my</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" class="scrollup">Scroll</a>

    

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


    
    <!-- WayPoints JS -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Counter UP JS -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!---Multi Search----->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".js-search-tags").select2({
            tags: true,
          placeholder: "Skills, Designations, Companies"
        });

        $(".js-location-tags").select2({
            tags: true,
          placeholder: "Location/Locality"
        });

    </script>
    
    <!----Toggle Home page search popup
    <script type="text/javascript">

      $(function() {
      $("#clicksearch").on("click", function(e) {
        $("#search_card").toggleClass("wide");
      });
      $(document).on("click", function(e) {
        if ($(e.target).is("#search_card, #clicksearch") === false) {
          $("#search_card").removeClass("wide");
        }
      });
    });

    </script>
    ---->

    <script type="text/javascript">
      /*----------------------------
      START - Counter Up JS activation
      ------------------------------ */
      $('.counter').counterUp({
          delay: 10,
          time: 1000

      });
    </script>
    @yield('script')
    <!-- <div id="myButton"></div> -->

    <!-- <script src="https://huratips.com/scripts/script.php?id=bnVtYmVyPSUyQjk3Nzk4NDk5Nzg0NDImbWVzc2FnZT1IZWxsbyUyQytob3crbWF5K3dlK2hlbHAreW91JTNGK0p1c3Qrc2VuZCt1cythK21lc3NhZ2Urbm93K3RvK2dldCthc3Npc3RhbmNlLiZwb3NpdGlvbj0yJmRpc3RhbmNlLWJvdHRvbT0yMCZkaXN0YW5jZS1tYXJnaW49MjAmZGlzcGxheT0wJndpZGdldD1mbG9hdGluZy13aGF0c2FwcA==" type="text/javascript"></script> -->

 <!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "109054537309212", // Facebook page ID
            whatsapp: "+60143284126", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "whatsapp,facebook", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
@stack('scripts')
<script>
  $('#company_country').on('change',function(e){
    var province_id=e.target.value;
    $.get('/json-regencies?province_id=' + province_id , function(data){
        // console.log(province_id);
        // console.log(data);
        // $('#company_state').empty();
        $('#company_city').empty();
        $('#company_state').append('<option value="0" disable="true" selected="true" required>-------  Select State -------</option>');

        $.each(data,function(index, regenciesObj){
            $('#company_state').append('<option value="'+regenciesObj.id +'" >'+ regenciesObj.name +'</option>');
        });
    });
});
$('#company_state').on('change',function(e){
    // console.log('aaa');
    var states_id=e.target.value;
    // console.log(states_id);
    $.get('/json-states?states_id=' + states_id , function(data){
        // console.log(province_id);
        console.log(data);
        $('#company_city').empty();
        $('#company_city').append('<option value="0" disable="true" selected="true" >-------  Select City -------</option>');

        $.each(data,function(index, statesObj){
            $('#company_city').append('<option value="'+statesObj.id +'">'+ statesObj.name +'</option>');
        });
    });
});
$('#person_country').on('change',function(e){
    // console.log('aaa');
    var province_id=e.target.value;
    // console.log(province_id);
    $.get('/json-regencies?province_id=' + province_id , function(data){
        // console.log(province_id);
        console.log(data);
        $('#person_state').empty();
        $('#person_state').append('<option value="0" disable="true" selected="true">-------  Select State -------</option>');

        $.each(data,function(index, regenciesObj){
            $('#person_state').append('<option value="'+regenciesObj.id +'">'+ regenciesObj.name +'</option>');
        });
    });
});

$('#person_state').on('change',function(e){
    // console.log('aaa');
    var states_id=e.target.value;
    // console.log(states_id);
    $.get('/json-states?states_id=' + states_id , function(data){
        // console.log(province_id);
        console.log(data);
        $('#person_city').empty();
        $('#person_city').append('<option value="" disable="true" selected="true">-------  Select City -------</option>');

        $.each(data,function(index, statesObj){
            $('#person_city').append('<option value="'+statesObj.id +'">'+ statesObj.name +'</option>');
        });
    });
});
</script>
</body>

</html>