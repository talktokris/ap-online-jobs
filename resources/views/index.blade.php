  
@extends('layouts.app')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{asset('site/img/slide/1.jpg')}});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2 style="text-align: center;">Your Search for Oversea Career Begin  Here</h2>
              <p>Wherever You Go, Go With All Your Heart - Young, enthusiastic youth just like yourselves!
         Passionate in creating opportunities for overseas youth travel and work exchange.
                 </p>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url({{asset('site/img/slide/2.jpg')}});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2 style="text-align: center;">Sourcing Best Talents for You </h2>
              <p>The global landscape rapidly changes the needs and dynamics of the market. Online Jobs remains to be your greatest ally and partner. 
        We provide the arsenal of tailored recruitment services needed for you to thrive.
                  </p>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url({{asset('site/img/slide/3.jpg')}});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2 style="text-align: center;">Think of Jobs, Think of Online Jobs</h2>
              <p>Looking for your next career breakthrough? Allow us to know you better through a personal consultation.
              </p>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item" style="background-image: url({{asset('site/img/slide/4.jpg')}});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2 style="text-align: center;">Leave your hard work to us</h2>
              <p>Let Ap Online Jobs Be Your Trust Placement Agency</p>
              <!-- <div class="text-center"><a href="" class="btn-get-started">Read More</a></div> -->
            </div>
          </div>
        </div>
      </div>
        

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <!-- =======  search ======= -->
  <section class="search-sec">
    <div class="container">
      <form action="{{route('recent.job')}}" novalidate="novalidate">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <h3 class="text-center" style="color: white;">Find Job </h3>
              
                <div class="form-group col-lg-4 col-md-3 col-sm-12 p-0">
                  <input type="text" id="position_name_jobs" name="position_name_jobs" class="form-control wrn-btn" placeholder="Job Tittle or keyword">
                </div>
                <div class="form-group col-lg-4 col-md-3 col-sm-12 p-0">
                  <input type="text" name="location_name" class="form-control wrn-btn" placeholder="Job Location">
                </div>

                <div class="col-lg-4 col-md-3 col-sm-12 p-0">
                  <input type="submit" value="Search" class="btn btn-primary wrn-btn">
                  <!-- <button type="button" class="btn btn-primary wrn-btn">Search</button> -->
                </div>
              
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- ======= end  search ======= -->


  <main id="main">

    <!-- ======= About Us Section  who are we ======= -->
    <section id="about-us" class="who-we-are">
      <div class="container" data-aos="zoom-in-right">
        <div class="row content">
          <div class="section-title site">
            <h2>Who <span>We Are</span></h2>
          </div>
          <div class="col-lg-7" data-aos="zoom-in-right">
            <img src="{{asset('site/img/about/who-we-are1.jpeg')}}" class="mx-auto d-block" alt="..." width="650px" height="440px"
              style="box-shadow: 0 10px 10px -5px;
              border-radius: 10px 50px 5px; ">
          </div>

          <div class="col-lg-5 texts" data-aos="fade-left">
            <p>
              AP Online Jobs is a global online employment solution for people seeking job with great career, and for
              the employers who need talented and skill personals. AP Online Jobs have been serving the human
              resources
              industries for more than 18 years.
            </p>
            <p>
              We assist employers not only to find the best quality candidates, but the entire streamline process so
              that you can save time and money. This will aid your decision making process further improving your
              Return
              of Investment (ROI). In short AP Online will be your channel to hire most suitable candidate like never
              before .
            </p>

          </div>
        </div>
      </div>
    </section>


    <!-- ======= About Us Section What We Do ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">
        <div class="row content">

          <div class="section-title site">
            <h2> <span>What</span> We Do</h2>
          </div>

          <div class="col-lg-5 texts" data-aos="fade-left">
            <br>
            <p>
              At AP Online Jobs, we strive to bring values and fulfilling opportunities and the needs to the job
              market,
              with add on value to lives, businesses and communities around the world.
            </p>
            <p>
              We create and deliver the best recruiting solution through various platforms, may it be online, as well
              as
              direct networking to connect employer and job seekers ; we strive every day to help our employing
              clients
              acquire best talents and help people with their career opportunities
            </p>
          </div>
          <div class="col-lg-7" data-aos="fade-right">
            <img src="{{asset('site/img/about/what-we-do.jpg')}}" class=" mx-auto d-block" alt="" width="650px" height="440px">
          </div>

        </div>

      </div>
    </section>
    <!-- About Us Section What We D -->

         <!-- ======= our-services Section ======= -->
         <section id="portfolio Our-Services" class="portfolio Our-Services">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title site" data-aos="zoom-out-down">
                <h2>Our <span>Services</span></h2>
              </div>

            </div>
          </div>
          <div class="row portfolio-container aos-init aos-animate" data-aos="fade-up"
            style="position: relative; height: 1267.08px;">
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('site/img/services/client-services.jpeg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Client Services</h4>
                <a href="{{asset('site/img/services/client-services.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link"
                  title="Energy Resourcing is a trusted partner in your search to find professional technical staff.">
                  <i class="bi bi-cursor-fill"></i>
                </a>
                <a href="/services" class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>
              </div>
            </div>


            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('site/img/services/fwms-digital-platform.jpeg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Fwwmc Digital Platform</h4>
                <a href="{{asset('site/img/services/fwms-digital-platform.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link" title="
                    FOREIGN WORKERS WELFARE MANAGEMENT CENTER Sdn Bhd (FWWMC) was formed mainly as a support
                    organization to manage and attend to the welfare of all foreign workers working 
                    in Malaysian.">
                  <i class="bi bi-cursor-fill"></i>
                </a>
                <a href="/services" class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>
              </div>
            </div>


            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('site/img/services/contract-managed-services.jpeg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Contract Managed Services</h4>
                <a href="{{asset('site/img/services/contract-managed-services.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link"
                  title="Our team of certified professionals have a proven track record of delivering resources on time and on budget. We have managed complex mobilisation, contracts management and demobilisation programs.">
                  <i class="bi bi-cursor-fill"></i>
                </a>
                <a href="/services" class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item filter-app"
              style="position: absolute; left: 0px; top: 451.7px;">
              <img src="{{asset('site/img/services/handyman.jpeg')}} " class="" alt="" height="280px !important" width="417px">
              <div class="portfolio-info">
                <h4>Handyman Service</h4>

                <a href="{{asset('site/img/services/handyman.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link" title="portfolio-lightbox preview-link" title="
                  If you’re looking to book the best handyman service to help you out around
                    the house, look no further than Handy."><i class="bi bi-cursor-fill"></i></a>
                <a href="/services" class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>

              </div>
            </div>


            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('site/img/services/recruitment-services.jpeg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Recruitment Services</h4>
                <a href="{{asset('site/img/services/recruitment-services.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link" title="portfolio-lightbox preview-link" title="
                We’re a true partner you can rely on for up-to-date industry insight with experience recruiting for diverse technical sectors. 
                We have an extensive global network of personal contacts gained over many years."><i
                    class="bi bi-cursor-fill"></i></a>
                <a href="/services" class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>
              </div>
            </div>


            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('site/img/services/managed-services-provider.jpeg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Managed Services Provider </h4>
                <a href="{{asset('site/img/services/managed-services-provider.jpeg')}}" data-gallery="portfolioGallery"
                  class="portfolio-lightbox preview-link"
                  title="We’re also experienced in working with clients who wish to retain ownership of the recruitment process but don’t want direct contract with a large number of separate recruitment service providers.">
                  <i class="bi bi-cursor-fill"></i>
                </a>
                <a href="/services  " class="details-link" title="More Details">
                  <i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- End Our services Section -->

    
    <!-- ======= Partners ======= -->
    <section style="background-image: url('{{asset('site/img/building-landscape-with-blue-overlay.jpg')}}') !important;">
      <div class="carousel-wrap carousels">
        <div class="section-title site text-center" data-aos="fade-right">
          <h2 style="color:white !important;">Overseas Partners</h2>
        </div>

        <div class="owl-carousel" data-aos="fade-up" data-aos-anchor-placement="top-center">
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_bangladesh.jpg')}}"></div>
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_hongkong.jpg')}}"></div>
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_indonesia.jpg')}}"></div>
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_japan.jpg')}}"></div>
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_nepal.jpg')}}"></div>
          <div class="item"><img src="{{asset('site/img/overseas-partners/overseas_unitedkingdom.jpg')}}"></div>

        </div>
      </div>
    </section>






    <!-- ======= Start section Counter ======= -->
    <!-- <section class="u-clearfix u-image u-shading u-typography-custom-page-typography-12--Counter u-section-1"
      style="background-image: url(assets/img/counter.PNG);" id="carousel_6be1">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">

              <div class="u-container-style u-layout-cell u-similar-fill u-size-15 u-size-30-md u-layout-cell-2">
                <div class="u-container-layout u-padding-6 u-valign-middle u-container-layout-2">
                  <h2 class="u-align-center u-text u-text-white u-text-3" data-animation-name="counter"
                    data-animation-event="scroll" data-animation-duration="3000">20,897</h2>
                  <h5 class="u-align-center u-text u-text-white u-text-4" data-animation-name="counter"
                    data-animation-event="scroll" data-animation-duration="3000">Jobseekers</h5>
                </div>

              </div>

              <div
                class="u-align-center u-container-style u-layout-cell u-similar-fill u-size-15 u-size-30-md u-layout-cell-3">
                <div class="u-container-layout u-padding-6 u-valign-middle u-container-layout-3">
                  <h2 class="u-text u-text-white u-text-5" data-animation-name="counter" data-animation-event="scroll"
                    data-animation-duration="3000">25,760</h2>
                  <h5 class="u-text u-text-white u-text-6" data-animation-name="counter" data-animation-event="scroll"
                    data-animation-duration="3000"> Employers</h5>
                </div>
              </div>
              <div
                class="u-align-center u-container-style u-layout-cell u-right-cell u-similar-fill u-size-15 u-size-30-md u-layout-cell-4">
                <div class="u-container-layout u-padding-6 u-valign-middle u-container-layout-4">
                  <h2 class="u-text u-text-white u-text-7" data-animation-name="counter" data-animation-event="scroll"
                    data-animation-duration="3000">7,600</h2>
                  <h5 class="u-text u-text-white u-text-8" data-animation-name="counter" data-animation-event="scroll"
                    data-animation-duration="3000">Vacancies</h5>
                </div>
              </div>
              <div
                class="u-container-style u-layout-cell u-left-cell u-similar-fill u-size-15 u-size-30-md u-layout-cell-1">
                <div class="u-container-layout u-padding-6 u-valign-middle u-container-layout-1">
                  <h2 class="u-align-center u-text u-text-white u-text-1" data-animation-name="counter"
                    data-animation-event="scroll" data-animation-duration="3000">890</h2>
                  <h5 class="u-align-center u-text u-text-white u-text-2" data-animation-name="counter"
                    data-animation-event="scroll" data-animation-duration="3000">Part Timers</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- ======= END section Counter ======= -->





    <!-- ======= Our Partner Section ======= -->
    <!-- <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Clients</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-1.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-2.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-3.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-4.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-5.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-6.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-7.png')}}"  alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/client-8.png')}}" alt="">
            </div>
          </div>

        </div>

      </div>
    </section> -->
    <!-- End Our Clients Section -->


       <!-- ======= Our Partner Section ======= -->
       <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">
        <div class="section-title site">
          <h2>Clients</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/felda.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/simedarby.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/swm-enviroment.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('site/img/clients/tradewinds.png')}}" class="img-fluid" alt="">
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Our Clients Section -->



  </main><!-- End #main -->
  @endsection


