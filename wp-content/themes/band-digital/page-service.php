<?php get_header();?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-service" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php the_title();?></h1>

        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<!--  SERVICE BLOCK2 START  -->
<section id="service-2" class="section-padding pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="service-box-2 mb-5">
          <span>01</span>
          <h4>Best <br>Analytics Audits</h4>
          <p class="mb-0">We have had the pleasure of partnering with a wide array of brands ranging from tech startups to Fortune 500 enterprises.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-box-2 mb-5">
          <span>02</span>
          <h4>Deep <br>Technical SEO</h4>
          <p class="mb-0">Over the last decade, we have had the pleasure of partnering with a wide array of brands ranging
            enterprises.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-box-2 mb-5">
          <span>03</span>
          <h4>Modern <br>Keyword Analysis</h4>
          <p class="mb-0">Over the last decade a wide array of brands ranging from tech startups to Fortune 500 enterprises.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  SERVICE BLOCK2 END  -->

<!--  SERVICE AREA START  -->
<section class="section pt-0">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 col-sm-12 col-md-6 mb-5 mb-lg-0">
        <img src="images/bg/2-min.jpg" alt="feature bg" class="img-fluid">
      </div>

      <div class="col-lg-7 pl-4">
        <div class="mb-5">
          <h3 class="mb-4">We are making beautiful <br>design layout business site</h3>
          <p>We craft beautiful website layout from scratch.You need not to worry about site design and other technial issue.We provide these attractive service as a bonus.Let's have atalk together for your next project.</p>
        </div>

        <ul class="about-list">
          <li>
            <h5 class="mb-2"><i class="icofont icofont-check-circled"></i>Responsive site</h5>
            <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
          </li>

          <li>
            <h5 class="mb-2"><i class="icofont icofont-check-circled"> </i> Latest bootstrap 4</h5>
            <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
          </li>

          <li>
            <h5 class="mb-2"><i class="icofont icofont-check-circled"> </i>Modern design</h5>
            <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
          </li>
          <li>
            <h5 class="mb-2"> <i class="icofont icofont-check-circled"> </i>Working contact form</h5>
            <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--  SERVICE AREA END  -->

<?php echo get_template_part('template-parts/content', 'service', ['class' => 'service-style-two']);?>

<!--  PARTNER START  -->
<section id="clients" class="section-padding ">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="mb-5">
          <h3 class="mb-2">Trusted by hundred over years</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, dignissimos?</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-sm-6 col-md-3 text-center">
        <img src="images/clients/client01.png" alt="partner" class="img-fluid">
      </div>
      <div class="col-lg-3 col-sm-6 col-md-3 text-center">
        <img src="images/clients/client06.png" alt="partner" class="img-fluid">
      </div>
      <div class="col-lg-3 col-sm-6 col-md-3 text-center">
        <img src="images/clients/client04.png" alt="partner" class="img-fluid">
      </div>
      <div class="col-lg-3 col-sm-6 col-md-3 text-center">
        <img src="images/clients/client05.png" alt="partner" class="img-fluid">
      </div>
    </div>
  </div>
</section>
<!--  PARTNER END  -->

<?php get_footer();?>
