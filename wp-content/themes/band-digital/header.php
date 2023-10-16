<!DOCTYPE html>
<html lang="en">
<head>

  <!-- ** Basic Page Needs ** -->
  <meta charset="utf-8">
  <title>Promodise - Startup Business Bootstrap Template</title>

  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Business Bootstrap Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Promodise Template v1.0">

  <!-- theme meta -->
  <meta name="theme-name" content="promodise" />
  <?php wp_head();?>
</head><body data-spy="scroll" data-target="#mainNav">

<nav class="navbar navbar-expand-lg fixed-top trans-navigation">
  <div class="container">
<!--    <a class="navbar-brand" href="index.html">-->
<!--      <img src="images/logo.png" alt="" class="img-fluid b-logo">-->
<!--    </a>-->
    <?php
    if(has_custom_logo()) {
      echo get_custom_logo();
    }
    ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="fa fa-bars"></i>
      </span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="mainNav">
      <?php wp_nav_menu( [
              'theme_location' => 'header',
              'container' => false,
              'menu_class' => 'navbar-nav',
              'menu_id' => false,
              'echo' => true,
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth'=> 2,
              'walker'=> new wp_bootstrap4_navwalker(),
      ]);?>

    </div>
  </div>
</nav>
<!--MAIN HEADER AREA END -->
