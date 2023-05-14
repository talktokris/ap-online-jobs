<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ap Online Jobs</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('site/img/favicon.ico')}}" rel="icon" rel="shortcut icon" type="image/x-icon">
  <link href="{{asset('site/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('site/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('site/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!--  carousel-->
  <link rel="stylesheet" href="{{asset('site/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('site/css/owl.theme.default.min.css')}}">
  <!--  end carousel-->

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{asset('site/css/Home.css')}}" media="screen">
  <link rel="stylesheet" href="{{asset('site/css/nicepage.css')}}" media="screen">

  <!-- Template Main CSS File -->
  <link href="{{asset('site/css/style.css')}}" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="/"> <img src="{{asset('site/img/onlinelogo.png')}}" style="width: 100%;"></a>
  

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="/" class="active">Home</a></li>
  
          <li><a href="/about-us">About Us </a></li>
          
            <li class="dropdown"><a href="#"><span>Employer</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="{{route('employer.login')}}">Employer Sign In</a></li>
                <li><a href="" class="dropdown-item" data-toggle="modal" data-target="#part_time_employer_modal1">Part Time Employer</a></li>
              </ul>
            </li>
            
          <li class="dropdown"><a href="#"><span>Candidate</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="{{route('login')}}">Professional/Job Seeker</a></li>
                <li><a href="{{route('retired.login')}}">Retired Person</a></li>
                <li><a href="" class="dropdown-item" data-toggle="modal" data-target="#part_time_jobseeker_modal">Part Time Jobseeker</a></li>
                <li><a href=""data-toggle="modal" data-target="#modal-2">Foreign Expatriate</a></li>
              </ul>
          </li>
          <!-- <li><a href="/employer-login">Employer </a></li> -->
          <!-- <li><a href="/candidate-login">Candidate </a></li> -->
          <li><a href="/partner/login">Partner</a></li>
          <li><a href="/fwwmc">Fwwms </a></li>
          <li><a href="/contact">Contact Us</a></li>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <div class="header-social-links d-flex">
        <a href="#" class="twitter"><i class="bu bi-twitter"></i></a>
        <a href="https://www.facebook.com/Ap-online-jobs-109054537309212" class="facebook"><i class="bu bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
      </div>
    </div>
  </header><!-- End Header -->



  @yield('content')

  

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>ABOUT</h4>
            <p>
              We want to be the world’s leading<br>
              specialist online recruitment consultancy<br>
              and Welfare protection provider<br>
              for Jobseeks and Employer.We provide <br>
              online CV on local and foreign workers <br>
              to carter local and global demand.
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>USEFUL LINKS</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i><a href="/services">Services</a></li>
              <li> <i class="bx bx-chevron-right"></i> <a href="/about">About Us</a></li>
              <li> <i class="bx bx-chevron-right"></i> <a href="/contact">Contact Us</a></li>
              <li> <i class="bx bx-chevron-right"></i> <a href="/fwwmc">Who We Are / FWMS </a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/gallery">Gallery</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/services">Vision, Mission and Values</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>EMPLOYERS</h4>
            <ul>
              <li>
                <i class="bx bx-chevron-right"></i> 
                <a href="{{asset('site/pdf/employer.pdf')}}">Employers Help</a>
              </li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{asset('site/pdf/faq_job_seeker.pdf')}}">Jobs
                  Seeker Help</a></li>
              <li><i class="bx bx-chevron-right"></i> <a
                  href="{{asset('site/pdf/faq_for_business_partner.pdf')}}">Partner Help</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>HAVE A QUESTIONS?</h4>
            <ul>
              <li class="bi bi-geo-alt"><span> Puchong, Malaysia</span></li>
              <li class="bi bi-phone"> <span class="text"> +603 80806549</span></li>
              <li class="bi bi-envelope"> <span class="text"> info@onlinejobs.my</span></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>JobOnline</span></strong>. All Rights Reserved
        </div>
        <!-- <div class="credits">
          Designed by <a href="#">JobOnline</a>
        </div> -->
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/" class="twitter"><i class="bu bi-twitter"></i></a>
        <a href="https://www.facebook.com/Ap-online-jobs-109054537309212" class="facebook"><i class="bu bi-facebook"></i></a>
        <a href="https://www.instagram.com/" class="instagram"><i class="bu bi-instagram"></i></a>
      </div>
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- End Footer -->
  <!-- Part time Employer modal -->
  <div class="modal fade" id="part_time_employer_modal1">
    <div class="modal-dialog" style=" margin-top: 150px;">
      <div class="modal-content" >
        <div class="modal-header" style="background-color: #157efb; color:white;">
          <h4 class="modal-title w-100 font-weight-bold" style="color:white; text-align:center;">Part Time Employer</h4>
          <!-- <h4 class="modal-title" style="color:white;">Part Time Employer</h4> -->
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modal-body">
            <span style="margin-left:70px; margin-right: 30px;"><input type="checkbox" value="1" name="radiobtn" id="maid_option1" onclick="lookingForMaid()"><label for="option1" style="margin-left: 10px;" >Maids</label></span>
            <span style="margin-right: 30px;"><input type="checkbox" value="1" name="radiobtn" id="driver_option2" onclick="lookingForDriver()"><label for="option2" style="margin-left: 10px;"> Driver</label></span>
            <span style="margin-right: 30px; "><input type="checkbox" value="1" name="radiobtn" id="nurses_option3" onclick="lookingForHomeNurse()"><label for="option3" style="margin-left: 10px;"> Home Services</label></span>
        </div>
        <div class="modal-footer">
          <a href="#part_time_employer_modal2" type="button" class="btn" data-toggle="modal" data-dismiss="modal" style="background-color: #E05024 ; color:white; margin-right: 180px;">Continues</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Part time Employer modal end -->

  <!-- Part time Employer modal  -->
  <div class="modal fade" id="part_time_employer_modal2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-right: 645px;">
        <div class="modal-content" style=" max-height: calc(120vh - 200px); overflow-y: auto; width: 990px;">
            <div class="modal-header text-center" style="background-color: #157efb;">
                <h4 class="modal-title w-100 font-weight-bold" style="color:white; text-align:center;">Registration</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-12">
                <div class="md-form">
                    <form action="{{ route('parttimeemployer.registration') }}" method="POST" class="form-container">
                        @csrf
                        <input type="checkbox" value="1" name="looking_for_maid" id="looking_for_maid" style="display:none">
                        <input type="checkbox" value="1" name="looking_for_driver" id="looking_for_driver" style="display:none">
                        <input type="checkbox" value="1" name="looking_for_home_nurse" id="looking_for_home_nurse" style="display:none">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('Name ') }}<span class="text-danger">*</span></label>
                                <input required  type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" >
                            </div>

                            <div class="col-sm-3">
                                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                <input required  type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Name" >
                            </div>

                            <div class="col-sm-3">
                                <label for="phone">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                                <input  type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="email_id">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <input id="email_id" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('State') }}<span class="text-danger">*</span></label>
                                <select name="state" class="form-control" id="person_state">
                                    <option value="" disable="true" selected="true">-------  Select State -------</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" >{{$state->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-sm-3">
                                <label for="name">{{ __('City') }}<span class="text-danger">*</span></label>
                                <select name="city" class="form-control" id="person_city">
                                    <option value="">-------  Select City -------</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <input required  type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address" >
                            </div>
                            
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                                <label for="name">{{ __('When do you need the Services?') }}<span class="text-danger">*</span></label>
                                <select name="service_time"  required class="form-control">
                                    <option value="" disable="true" selected="true">When do you need the Services?</option>
                                    <option value="Immediately">Immediately</option>
                                    <option value="In the next 3 days">In the next 3 days</option>
                                    <option value="In the next 7 days">In the next 7 days</option>
                                    <option value="In the next 15 days">In the next 15 days</option>
                                    <option value="Winthin a month">Winthin a month</option>
                                    <option value="After a month">After a month</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="name">{{ __('What type of service do you need?') }}<span class="text-danger">*</span></label>
                                <select name="service_type"  required class="form-control">
                                    <option value="" disable="true" selected="true">When do you need the Services?</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Full Time - Non Live-in">Full Time - Non Live-in</option>
                                    <option value="Full Time - Live-in">Full Time - Live-in</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">{{ __('Select tasks that you want to get done:') }}<span class="text-danger">*</span></br></label>
                                <select  placeholder="Name" class="form-control" id="task" name="service_task[]" multiple="multiple" style="width:450px;border-style: groove;" required></select>
                            </div>
                        </div>                          
                        
                        <div class="d-flex justify-content-center">
                            <button class="btn" style="background-color: #E05024 ; color:white;">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>	
              
        </div>
    </div>
  </div>
  <!-- Part time Employer modal end -->

  <!-- Part time Job Seeker -->
    <div class="modal fade" id="part_time_jobseeker_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" style="padding-right: 300px !important;">
      <div class="modal-dialog" role="document" style="margin-top: 150px;">
        <div class="modal-content">
          <div class="modal-header text-center" style="background-color: #157efb;">
            <h4 class="modal-title w-100 font-weight-bold" style="color:white;">Part Time Job Seeker</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close_popup">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-12">
            <div class="md-form">
              <form action="" method="POST" enctype="multipart/form-data" class="form-container">
                <!-- <h1>Login</h1> -->
                @csrf	
                <div class="form-group row">
                                <div class="col-sm-4">
                    <label for="name">{{ __('Name ') }}<span class="text-danger">*</span></label>
                                    <input required id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" >
                  </div>
                  <div class="col-sm-4">
                                    <label for="phone">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="email_id">{{ __('Email') }}</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label for="name">{{ __('State') }}<span class="text-danger">*</span></label>
                    <select name="company_state" id="company_states"  required class="form-control">
                      <option value="" disable="true" selected="true">- Select State -</option>
                      @foreach ($states as $state)
                        <option value="{{$state->id}}" >{{$state->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="name">{{ __('City') }}<span class="text-danger">*</span></label>
                    <select name="company_city"  required class="form-control" id="company_citys">
                      <option value="" disable="true" selected="true">- Select City -</option> 
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="name">{{ __('Work As') }}<span class="text-danger">*</span></label>
                    <select name="work_as"  required class="form-control" id="work_as">
                      <option value="" disable="true" selected="true">- Select -</option> 
                      <option value="1">Maid</option>
                      <option value="2">Driver</option>
                      <option value="3">Home Nurse</option>
                    </select>
                  </div>
                </div>
                
                <!-- <button class="btn modal-footer d-flex justify-content-center" style="background-color: #E05024 ; color:white;">Submit Application</button> -->
                <div class="d-flex justify-content-center" >
                  <button class="btn" style="background-color: #E05024 ; color:white;">Submit Application</button>
                </div>
              </form>
            </div>
          </div>						
          
        </div>
      </div>
    </div>
  <!-- Part time job seeker end -->

  <div class="modal fade" id="modal-2">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Worker</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <span> <a class="dropdown-item" href="{{route('login')}}">Expatraite</a><br></span>
                <span> <a class="dropdown-item" href="{{route('workers')}}">Foregin Worker</a><br></span>
                <span> <a class="dropdown-item" href="{{route('maids')}}">Domestic Maid</a></span>
            </div>
            <div class="modal-footer justify-content-center d-flex">
              <a href="#modalLoginFormOne" type="button" class="btn" data-toggle="modal" data-dismiss="modal" style="background-color: #E05024 ; color:white;">Continues</a>
            </div>
            <!-- <div class="d-flex justify-content-center" >
              <button class="btn" style="background-color: #E05024 ; color:white;">Submit Application</button>
            </div> -->
          </div>
        </div>
      </div>
  





  <!-- Vendor JS Files -->
  <script src="{{asset('site/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('site/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('site/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('site/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('site/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('site/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('site/vendor/waypoints/noframework.waypoints.js')}}"></script>

  <script src="{{asset('site/js/jquery.min.js')}}"></script>
  <script src="{{asset('site/js/owl.carousel.min.js')}}"></script>

  <script class="u-script" type="text/javascript" src="{{asset('site/js/jquery.js')}}" defer=""></script>
  <script class="u-script" type="text/javascript" src="{{asset('site/js/nicepage.js')}}" defer=""></script>

  <!-- Template Main JS File -->
  <script src="{{asset('site/js/main.js')}}"></script>


  </script>


<script>
    $('#blue_worker').submit(function(e){
      console.log($('#blue_worker').attr('action'));
            e.preventDefault();
            $.ajax({
                url: "{{ route('fast.registration') }}",
                type: 'POST',
                data: $('#blue_worker').serialize(),
            })
            .done(function(s) {
              // console.log(s);
              // $.magnificPopup.close();
                // location.reload();           
            })
            .fail(function(a,b) {
              console.log(a);
                console.log(b);
                console.log("error");
            })
            .always(function(response) {
              document.getElementById("blue_worker").reset();
              $('#blue_registration').hide();

              setTimeout(() => { alert("Your form has been submitted"); }, 1000);

              // alert("Your form has been submitted");
                
                

                // $.magnificPopup.close();
            });        
        })

        $(document).ready(function() {
            $('#looking_for').select2();
            $('#task').select2({
                placeholder:'Select Service Task'
            });
        });

        function lookingForMaid() {
      
      var maid_option1 = document.getElementById("maid_option1")
        if(maid_option1.checked){
          document.getElementById("looking_for_maid").checked = true;
          $("#task").append('<option value="Housekeeping">Housekeeping</option>');
          $("#task").append('<option value="Clean Utensils">Clean Utensils</option>');
          $("#task").append('<option value="Wash Clothes">Wash Clothes</option>');
          $("#task").append('<option value="Iron Clothes">Iron Clothes</option>');
        }
        if(!maid_option1.checked){
          document.getElementById("looking_for_maid").checked = false;
          $("#task").find('[value="Housekeeping"]').remove();
          $("#task").find('[value="Clean Utensils"]').remove();
          $("#task").find('[value="Wash Clothes"]').remove();
          $("#task").find('[value="Iron Clothes"]').remove();
        }
      
    }
    function lookingForDriver() {
      var driver_option2 = document.getElementById("driver_option2")
            if(driver_option2.checked){
                document.getElementById("looking_for_driver").checked = true;
            }
            if(!driver_option2.checked){
                document.getElementById("looking_for_driver").checked = false;
            }
    }
    function lookingForHomeNurse() {
        
        var nurses_option3 = document.getElementById("nurses_option3")
        if(nurses_option3.checked){
            document.getElementById("looking_for_home_nurse").checked = true;
            $("#task").append('<option value="Elderly care">Elderly care</option>');
            $("#task").append('<option value="In house patients">In house patients</option>');
            $("#task").append('<option value="Hospitalised patients">Hospitalised patients</option>');
        }
        if(!nurses_option3.checked){
            document.getElementById("looking_for_home_nurse").checked = false;
            // $("#task").empty();
            $("#task").find('[value="Elderly care"]').remove();
            $("#task").find('[value="In house patients"]').remove();
            $("#task").find('[value="Hospitalised patients"]').remove();
        }
    }

      $('#company_country').on('change',function(e){
        // console.log('Company country');
        var province_id=e.target.value;
        // console.log(province_id);
        $.get('/json-regencies?province_id=' + province_id , function(data){
            // console.log(province_id);
            // console.log(data);
            $('#s').empty();
            $('#company_state').empty();
            $('#company_state').append('<option value="0" disable="true" selected="true" required>-------  Select State -------</option>');

            $.each(data,function(index, regenciesObj){
                $('#company_state').append('<option value="'+regenciesObj.id +'">'+ regenciesObj.name +'</option>');
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
        // console.log('person country');
        var province_id=e.target.value;
        // console.log(province_id);
        $.get('/json-regencies?province_id=' + province_id , function(data){
            // console.log(province_id);
            // console.log(data);
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

    $('#company_states').on('change',function(e){
        console.log('aaa');
        var states_id=e.target.value;
        // console.log(states_id);
        $.get('/json-states?states_id=' + states_id , function(data){
            // console.log(province_id);
            console.log(data);
            $('#company_citys').empty();
            $('#company_citys').append('<option value="0" disable="true" selected="true" >-------  Select City -------</option>');

            $.each(data,function(index, statesObj){
                $('#company_citys').append('<option value="'+statesObj.id +'">'+ statesObj.name +'</option>');
            });
        });
    });
</script>
</body>

</html>