<?php
/* The main index file */
?>

<?php get_header(); ?>

    <!-- Posts Section Without Images -->
    <?php get_template_part( 'includes/content/area-posts' ); ?>
    <!-- /.row -->

    <!-- Posts Section With Images -->
    <?php get_template_part('includes/content/area-posts-img'); ?>
    <!-- /.row -->

    <!-- Posts Section With Video -->
    <?php get_template_part('includes/content/area-video') ?>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
        </div>
        <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="#">Contact Us</a>
        </div>
    </div>

 <?php get_footer(); ?>
