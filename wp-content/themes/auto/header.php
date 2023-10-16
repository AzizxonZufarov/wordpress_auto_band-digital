<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta <?php bloginfo('charset');?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php wp_head();?>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__top">
            <?php the_custom_logo();?>
<!--            <a class="logo" href="#">-->
<!--                <img class="logo__img" src="--><?php //bloginfo('template_url'); ?><!--/assets/images/logo.svg" alt="logo">-->
<!--            </a>-->
            <a class="phone" href="tel:<?php the_field( 'phone-number', 582 ); ?>"><?php the_field( 'phone', 582 ); ?></a>
        </div>
        <div class="header__content">
            <h1 data-wow-delay=".5s" class="header__title wow animate__fadeInLeft">
                <?php the_field( 'title', 582 ); ?>
            </h1>
            <h2 data-wow-delay="1s" class="header__subtitle wow animate__fadeInLeft">
                <?php the_field( 'trigger', 582 ); ?>
            </h2>
            <p data-wow-delay="1.5s" class="header__text wow animate__fadeInLeft">
                <?php the_field( 'main-text', 582 ); ?>
            </p>
            <a class="button" href="/">КОНСУЛЬТАЦИЯ ЭКСПЕРТА</a>
            <div class="social header__social">
                <a class="social__link" href="<?php the_field('instagram-link', 582); ?>">
                    <svg class="test" width="26" height="26">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/icon/sprite.svg#instagram"></use>
                    </svg>
                </a>
                <a class="social__link" href="<?php the_field('telegram-link', 582); ?>">
                    <svg width="25" height="19">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/icon/sprite.svg#telegram"></use>
                    </svg>
                </a>
                <a class="social__link" href="<?php the_field('whatsapp-link', 582); ?>">
                    <svg width="26" height="26">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/icon/sprite.svg#whatsapp"></use>
                    </svg>
                </a>
                <a class="social__link" href="<?php the_field('facebook-link', 582); ?>">
                    <svg width="14" height="25">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/icon/sprite.svg#facebook"></use>
                    </svg>
                </a>
            </div>
            <img data-wow-delay="2s" class="header__images wow animate__fadeInUpBig" src="<?php the_field( 'main-img', 582 ); ?>"
                 alt="ford mustang">
        </div>
    </div>
</header>