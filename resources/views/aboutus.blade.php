@extends('layouts.app')
@section('content')

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs breadcrumbs-about">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>About Us</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>About Us</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->



    <!-- ======= About Us Section  who are we ======= -->
    <section id="about-us" class="who-we-are">
      

      <div class="container" data-aos="fade-up">
        <div class="row content">
          <div class="section-title site">
            <h2>Who <span>Are We</span></h2>
          </div>
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{asset('site/img/about/who-we-are-2.jpg')}}" class="mx-auto d-block" alt="..." width="500px" height="380px"
              style="-webkit-filter: drop-shadow(5px 5px 5px #dfdede);
              filter: drop-shadow(5px 5px 5px #dfdede);">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 texts" data-aos="fade-left">
            <p>
              AP Online Jobs is a global online employment solution for people seeking job with great career, and for
              the employers who need talented and skill personals. AP Online Jobs have been serving the human resources
              industries for more than 18 years.
            </p>

            <p>
              We assist employers not only to find the best quality candidates, but the entire streamline process so
              that you can save time and money. This will aid your decision making process further improving your Return
              of Investment (ROI). In short AP Online will be your channel to hire most suitable candidate like never
              before .
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Us Section -->

    <!-- ======= About Us Section What We Do ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="row content">

          <div class="section-title site">
            <h2> <span>What</span> We Do</h2>
          </div>


          <div class="col-lg-6 texts" data-aos="fade-left">
            <br>
            <p>
              At AP Online Jobs, we strive to bring values and fulfilling opportunities and the needs to the job market,
              with add on value to lives, businesses and communities around the world.
            </p>
            <p>
              We create and deliver the best recruiting solution through various platforms, may it be online, as well as
              direct networking to connect employer and job seekers ; we strive every day to help our employing clients
              acquire best talents and help people with their career opportunities </p>
          </div>
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{asset('site/img/about/what-we-do.jpg')}}" class=" mx-auto d-block" alt="..." width="500px" height="370px"
              style="-webkit-filter: drop-shadow(5px 5px 5px #dfdede);
              filter: drop-shadow(5px 5px 5px #dfdede);">
          </div>

        </div>

      </div>
    </section>
    <!-- About Us Section What We D -->



  </main><!-- End #main -->
  @endsection