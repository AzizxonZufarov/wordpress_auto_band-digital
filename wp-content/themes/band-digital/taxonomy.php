<?php get_header();?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white">
            <?php
            if (is_category()) {
              echo __("<small>Категория: </small> <br>") . get_queried_object()->name;
            }
            if (is_tag()) {
              echo __("<small>Записи с тегом: </small> <br>") . get_queried_object()->name;
            }
            if (is_author()) {
              echo __("<small>Записи автора</small> <br>") . get_the_author_meta('display_name');
            }
            if (is_date()) {
              echo __("<small>Записи по дате</small> <br>") . get_the_date('j F Y');
            }
            ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <?php $cnt = 0;
          if (have_posts()) : while (have_posts()) : the_post();
            ?>
                <div class="col-lg-12">
                  <div class="blog-post">
                    <?php
                    if(has_post_thumbnail()) {
                      the_post_thumbnail('post-thumbnail', array('class' => "img-fluid w-100"));
                    } else {
                      echo '<img src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" />';
                    }
                    ?>
                    <div class="mt-4 mb-3 d-flex">
                      <div class="post-author mr-3">
                        <i class="fa fa-user"></i>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'))?>"
                           class="h6 text-uppercase"><?php the_author();?></a>
                      </div>

                      <div class="post-info">
                        <i class="fa fa-calendar-check"></i>
                        <span><?php the_time('j F Y');?></span>
                      </div>
                    </div>
                    <a href="<?php echo get_the_permalink();?>" class="h4 "><?php the_title();?></a>
                    <p class="mt-3"><?php the_excerpt();?></p>
                    <a href="<?php echo get_the_permalink();?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
                <?php  endwhile; endif; ?>
          <div class="col-lg-12"><?php the_posts_pagination(array(
              'prev_text' => ('<span class="p-2 border">« Предыдушие посты</span>'),
              'next_text' => _('<span class="p-2 border">Cлeдушие посты »></span>'),
              'before_page_number' => '<span class="p-2 border">',
              'after_page_number' => '</span>'
            )); ?>
          </div>
        </div>

      </div>
      <?php get_sidebar();?>
    </div>
  </div>
</section>
<?php get_footer();?>
