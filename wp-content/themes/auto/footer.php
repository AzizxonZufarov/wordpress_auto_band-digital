<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <?php the_custom_logo();?>
<!--            <a class="logo" href="#">-->
<!--                <img class="logo__img" src="--><?php //bloginfo('template_url'); ?><!--/assets/images/logo.svg" alt="logo">-->
<!--            </a>-->
            <div class="social footer__social">
                <a class="social__link" href="<?php the_field('instagram-link', 582); ?>">
                    <img class="social__img" src="<?php bloginfo('template_url'); ?>/assets/images/icon/instagram.svg" alt="instagram icon">
                </a>
                <a class="social__link" href="<?php the_field('telegram-link', 582); ?>">
                    <img class="social__img" src="<?php bloginfo('template_url'); ?>/assets/images/icon/telegram.svg" alt="telegram icon">
                </a>
                <a class="social__link" href="<?php the_field('whatsapp-link', 582); ?>">
                    <img class="social__img" src="<?php bloginfo('template_url'); ?>/assets/images/icon/whatsapp.svg" alt="whatsapp icon">
                </a>
                <a class="social__link" href="<?php the_field('facebook-link', 582); ?>">
                    <img class="social__img" src="<?php bloginfo('template_url'); ?>/assets/images/icon/facebook.svg" alt="facebook icon">
                </a>
            </div>

            <a class="footer__copy" href="<?php echo get_page_link(663);?>">
                Политика конфиденциальности
            </a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--<script src="js/slick.min.js"></script>-->
<!--<script src="js/jquery.fancybox.min.js"></script>-->
<!--<script src="js/wow.min.js"></script>-->
<!--<script src="js/main.js"></script>-->
</body>
</html>
