<?php
/*
Template Name: home
*/
?>
<?php get_header();?>
<section class="services">
    <div class="container">
        <h2 class="title">НАШИ УСЛУГИ</h2>
        <div class="services__inner">
            <div class="services__content">
                <?php the_field('services-text', 582); ?>
            </div>
                <?php the_field('services-elements', 582); ?>
        </div>
    </div>
</section>
<section class="benefits">
    <div class="container">
        <div class="benefits__inner">

            <img data-wow-delay="2s" class="benefits__images wow animate__fadeInUp" src="<?php the_field('benefits-img', 582); ?>" alt="car">
            <div class="benefits__content">
                <h2 class="title benefits__title">ПОЧЕМУ МЫ?</h2>
                <?php the_field('benefits-elements', 582); ?>
            </div>
        </div>
    </div>
</section>
<section class="carousel">
    <div class="container">
        <h2 class="title">
            ПРИГНАННЫЕ НАМИ АВТО
        </h2>
        <div class="carousel__inner">
            <?php
            global $post;

            $myposts = get_posts([
                'numberposts' => 4,
                'category' => 31
            ]);

            if( $myposts ){
                foreach( $myposts as $post ){
                    setup_postdata( $post );
                    ?>
                    <!-- Вывод постов, функции цикла: the_title() и т.д. -->
                    <div class="carousel__item">
                        <div class="carousel__item-box">
<!--                            <img class="carousel__item-img" src="--><?php //bloginfo('template_url'); ?><!--/assets/images/carousel/1.jpg" alt="">-->
                            <?php the_post_thumbnail(
                                array(380, 250),
                                array(
                                    'class' => 'carousel_item-img'
                                )
                                )?>
                            <h4 class="carousel__item-title"><?php the_title();?></h4>
                            <p class="carousel__item-text"><?php the_content();?></p>
                        </div>
                    </div>
                    <?php
                }
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>


        </div>
    </div>
</section>
<section class="contacts">
    <div class="container">
        <div class="contacts__inner">
            <div class="contacts__info">
                <h2 class="title">
                    КОНТАКТЫ
                </h2>
                <ul class="contacts__list">
                    <li class="contacts__item">
                        <p class="contacts__item-title">Адрес</p>
                        <p class="contacts__item-text">
                            <?php the_field('address', 582); ?>
                        </p>
                    </li>
                    <li class="contacts__item">
                        <p class="contacts__item-title">Время работы</p>
                        <p class="contacts__item-text">
                            <?php the_field('working-hours', 582); ?>
                        </p>
                    </li>
                    <li class="contacts__item">
                        <p class="contacts__item-title">Телефон</p>
                        <p class="contacts__item-text">
                            <a href="tel:<?php the_field('phone-number', 582); ?>"><?php the_field('phone', 582); ?></a>
                        </p>
                    </li>
                </ul>
            </div>

            <form class="contacts__form">
                <h2 class="title contacts__title">Оставить заявку</h2>
                <?php echo do_shortcode('[contact-form-7 id="294d1d3" title="Контактная форма"]');?>
            </form>
        </div>
    </div>
</section>
<?php get_footer();?>