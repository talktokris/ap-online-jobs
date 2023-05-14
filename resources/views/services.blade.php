@extends('layouts.app')
@section('content')
<main id="main" style="margin-bottom: 35px;">

    <section id="breadcrumbs" class="breadcrumbs breadcrumbs-about">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>About Us</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Services</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->


    <div class="container ser" data-aos="zoom-in-up">
        <div class="row">
            <div class="section-title site" style="margin-top: 10px !important;">
                <h2>About Us</h2>
            </div>
            <div class="col-lg-5 col-sm-3">

                <img src="{{asset('site/img/services/client-services.jpeg')}}" class="mx-auto d-block" alt="..." width="430px"
                    height="470px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>

            <div class="col-lg-7 texts" data-aos="zoom-in">
                <h2 class="content-header">Client Services</h2>
                <p>
                    Energy Resourcing is a trusted partner in your search to find professional technical staff.
                    Our purpose is to connect the right candidate with the right job in a variety of industries,
                    provide contractor management services, and offer an unmatched level of knowledge and expertise
                    in every interaction with our clients.
                    With roots in oil and gas recruitment, we have adapted to the complex, ever-changing modern
                    marketplace by expanding into emerging renewables and technology recruitment, vendor management,
                    and other workforce solutions around the globe. With a comprehensive understanding of each
                    client’s needs, we deliver necessary staffing resources on time and on budget – ensuring success
                    in your future operations.
                </p>

                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="/contact" target="_self"
                        class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline"><span
                            class="mk-button--text">Contact Us</span></a>
                </div>
            </div>
        </div>
        <!-- 2  -->
        <div class="row">
            <div class="col-lg-5 texts">
                <h2 class="content-header">Recruitment Services</h2>
                <p>
                    We’re a true partner you can rely on for up-to-date industry insight with experience recruiting
                    for diverse technical sectors. We have an extensive global network of personal contacts gained
                    over many years.
                    We focus principally on contract recruitment, permanent placements, project staffing and
                    extensive contractor management services. We can provide a flexible workforce that can
                    supplement your own resources and manage workload peaks.
                </p>

                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="http://onlinejobs.my/professional/create?type=pro" target="_self"
                        class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline"><span
                            class="mk-button--text">Apply Now</span></a>
                </div>
            </div>
            <div class="col-lg-7">
                <img src="{{asset('site/img/services/recruitment-services.jpeg')}}" class=" mx-auto d-block" alt="" width="90%"
                    height="470px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>

        </div>
        <!-- 3  -->
        <div class="row">

            <div class="col-lg-5" data-aos="zoom-out-up">
                <img src="{{asset('site/img/services/contract-managed-services.jpeg')}}" class="mx-auto d-block" alt="..."
                    width="90%" height="450px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>

            <div class="col-lg-7 col-sm-12 texts" data-aos="zoom-out">
                <h2 class="content-header">Contract Managed Services (CMS)</h2>
                <p>
                    Our team of certified professionals have a proven track record of delivering resources on time
                    and on budget. We have managed complex mobilisation, contracts management and demobilisation
                    programs.
                    We work with the People Group Line Managers or contracts/procurement teams to manage the entire
                    process of contracting assignments, with a keen understanding of different regional
                    requirements. This includes contractor pre-engagement activities (job offer, medical testing,
                    contract preparation, work permits), mobilisation and contract management (travel arrangements,
                    payroll, tax and social security management, customer policy implementation) through to
                    demobilisation and assignment close-out.
                    This service can be applied to projects or operational business units. It offers substantial
                    cost savings for contract management and administration support.
                    CMS also provides access to international payroll expertise and a reliable supply chain of
                    specialist recruitment providers to meet the overall needs of your project.
                    Our processes are designed to deliver the highly capable staff you’re looking for. We assist
                    with the planning and preparation required to ensure all recruitment contracts are successful.
                </p>


                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="/contact" target="_self"
                        class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline"><span
                            class="mk-button--text">Contact Us</span></a>
                </div>
            </div>

        </div>
        <!-- 4  -->
        <div class="row">

            <div class="col-lg-7 texts" data-aos="flip-up">
                <h2 class="content-header">Managed Service Provider (MSP)</h2>
                <p>
                    We’re also experienced in working with clients who wish to retain ownership of the recruitment
                    process but don’t want direct contract with a large number of separate recruitment service
                    providers.
                    In these scenarios, we contract with selected third-party vendors on behalf of our clients. The
                    client benefits from cost and efficiency savings in contract administration while maintaining
                    consistency in how it manages its recruitment vendors and processes for onboarding and a large
                    contractor workforce.
                </p>

                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="/contact" target="_self"
                        class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline"><span
                            class="mk-button--text">Contact Us</span></a>


                </div>
            </div>
            <div class="col-lg-5" data-aos="flip-up">
                <img src="{{asset('site/img/services/managed-services-provider.jpeg')}}" class=" mx-auto d-block" alt=""
                    width="90%" height="470px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>

        </div>
        <!-- 5  -->
        <div class="row">
            <div class="col-lg-7" data-aos="flip-up">
                <img src="{{asset('site/img/services/handyman.jpeg')}}" class=" mx-auto d-block" alt="" width="90%"
                    height="470px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>
            <div class="col-lg-5 texts" data-aos="flip-down">
                <h2 class="content-header">Our ABC model</h2>
                <p>
                    When our candidates arrive at your site or workplace, we guarantee all necessary training and
                    qualifications have been completed and mastered. This ensures that all site standards and
                    requirements are met and fully complied with, providing confidence that our candidates will go
                    above and beyond to help you achieve your goals.
                    We ensure that our candidates have the skills, experience, and qualifications to do the job
                    well. This combination of both observable and measurable knowledge, skills, abilities, and
                    personal attributes contributes to enhanced candidate performance. As a result, our candidates
                    help you achieve organisational success.
                    Our ABC model provides manpower solutions that reduce risk, reduce costs and maximise
                    performance. Safely.
                </p>

                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="/contact" target="_self"
                        class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline"><span
                            class="mk-button--text">Contact Us</span></a>
                </div>
            </div>
        </div>
        <!-- 6  -->
        <div class="row">
            <div class="col-lg-6 texts">
                <h2 class="content-header">FWWMC – Digital Platform </h2>
                <p> <strong>FOREIGN WORKERS WELFARE MANAGEMENT SYSTEM (FWWMS)</strong>
                </p>
                <p>
                    With years of experiences the Team of Welfare Division had developed and implement full holistic
                    and online platform to monitor the interest and welfare all Migrant workers in Malaysia.
                    The solution eliminate all manual monitoring and time consuming with an integration with all the
                    stake holders, such as Government Agencies , Mission and Source Country Recruiting Agencies. The
                    system allows Migrant workers and Employers to rise their issue throw mobile apps and online
                    platform. FWWMC Mobile Apps system will assist employer to monitor workers welfare related
                    matters and help workers in emergency situation for example arrested by police or other relevant
                    government agencies or unforeseen circumstances such as runaway workers.
                </p>

                <div id="mk-button-23" class="mk-button-container _ relative    inline left ">
                    <a href="/contact" target="_self" class="mk-button js-smooth-scroll mk-button--dimension-flat mk-button--size-large mk-button--corner-pointed text-color-light _ relative text-center font-weight-700 no-backface  letter-spacing-2 inline">
                        <span class="mk-button--text">Contact Us</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{asset('site/img/services/fwms-digital-platform.jpeg')}}" class=" mx-auto d-block" alt=""
                    width="90%" height="470px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            </div>

        </div>

    </div>
<!-- 3  -->

</main>

@endsection