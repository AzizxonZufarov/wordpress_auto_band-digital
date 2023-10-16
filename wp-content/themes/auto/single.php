<?php get_header('private');?>

<?php the_post();?>
<div class="container">
    <?php the_title();?>
    <?php the_content();?>
</div>
<?php get_footer();?>