@extends('layouts.app')
@section('content')
<main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs breadcrumbs-about">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>About</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Fwwms</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->
        <!-- =======    FWWMS Section ======= -->
        <section id="about-us" class="about-us">
            <div class="container" data-aos="fade-up">
                <div class="row content">
                    <div class="section-title">
                        <h2>FWWMS </h2>
                    </div>

                    <div class="col-lg-6" data-aos="fade-right">
                        <img src="{{asset('site/img/fwms/fwwmc.jpg')}}" class="rounded mx-auto d-block" alt="fwwmc" width="400px"
                            height="380px">

                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        <p>
                            FOREIGN WORKERS WELFARE MANAGEMENT CENTER Sdn Bhd (FWWMC) was formed mainly as a support
                            organization to manage and attend to the welfare of all foreign workers working in
                            Malaysian. Understandably, every country sending their valuable citizens abroad for
                            Employment would like a guarantee that they (the worker) are well taken care of and their
                            right protected, We at FWWMC are proud to say that we can Give you that GUARANTEE.
                            <br> <br>
                            FWWMC was established on the 7th of January 2009 to help the Government agency tasked with
                            Protecting and Promoting the welfare and well-being of all foreign workers employed here in
                             Malaysia. FWWMC is a Membership Welfare Institute FWWMC is Recognized and Supported by the 
                            Department of Labour Under Ministry of Human Resources Malaysia with the supporting letter (34)
                             JTK/30/11/992 jld.8 signed by the Director General.
                        </p>

                                <button type="button" class="btn btn-primary ">
                            <a href="http://fwwmc.com.my/" style="color:white"> Visit sit </a>
                        </button>

                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->



        <!-- ======= Online jobs  Section  who are we ======= -->
        <section class="about-us">
            <div class="container" data-aos="fade-up">

                <div class="row content">
                    <div class="section-title">
                        <h2> ONLINE JOBS.MY </h2>
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in
                            voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum.
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore
                            magna aliqua.
                        </p>

                    </div>
                    <div class="col-lg-6" data-aos="fade-right">
                        <img src="{{asset('site/img/fwms/workers.png')}}" class="rounded mx-auto d-block" alt="..." width="400px"
                            height="350px">
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

    </main><!-- End #main -->
@endsection