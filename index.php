<?php
/* The main index file */
?>

<?php get_header(); ?>

    <!-- Marketing Icons Section -->
    <?php get_template_part( 'includes/content/area-posts' ); ?>
    <!-- /.row -->

    <!-- Portfolio Section -->
    <?php get_template_part('includes/content/area-posts-img'); ?>
    <!-- /.row -->

    <!-- Features Section -->
    <?php get_template_part('includes/content/area-video') ?>
    <!-- /.row -->

<!--      SIDEBAR INCLUDE !-->
    <hr>

    <!-- Call to Action Section -->
    <?php get_template_part('includes/content/area-call-to-action') ?>

 <?php get_footer(); ?>
