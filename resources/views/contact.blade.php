@extends('layouts.app')
@section('content')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs breadcrumbs-about">
      <div class="container">
          <div class="d-flex justify-content-between align-items-center">
              <h2>Contact Us</h2>
              <ol>
                  <li><a href="index.html">Home</a></li>
                  <li>Contact Us</li>
              </ol>
          </div>
      </div>
  </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <div class="map-section">
      <!-- <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/place/AGENSI+PEKERJAAN+ONLINE+JOBS+SDN+BHD/@3.0411624,101.6179263,19z/data=!4m5!3m4!1s0x31cc4bc8f241692f:0x711f4c56d78b859a!8m2!3d3.0412493!4d101.617818" frameborder="0" allowfullscreen></iframe> -->
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.0498427445926!2d101.61792632963206!3d3.041162393418384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4bc8f241692f%3A0x711f4c56d78b859a!2sAGENSI%20PEKERJAAN%20ONLINE%20JOBS%20SDN%20BHD!5e0!3m2!1sen!2snp!4v1658396249318!5m2!1sen!2snp" frameborder="0" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>15, Jalan Merbah 3, Bandar Puchong Jaya, 47170 Puchong, Selangor, Malaysia</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@onlinejobs.my<br>marketing@oninejobs.my</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+603 80806549<br>+603 80805249</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Contact No" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
@endsection