<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package html-template-into-wordpress
 */

get_header(); ?>

    <div id="primary" class="site-content">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <!-- Posts Section Without Images -->
                <?php get_template_part( 'includes/content/area-posts' ); ?>
                <!-- /.row -->

                <!-- Posts Section With Images -->
                <?php get_template_part('includes/content/area-posts-img'); ?>
                <!-- /.row -->

                <!-- Posts Section With Video -->
                <?php get_template_part('includes/content/area-video') ?>
                <!-- /.row -->

            <?php endwhile; // end of the loop. ?>

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

        </div><!-- #content -->
    </div><!-- #primary .site-content -->

<?php get_footer(); ?>