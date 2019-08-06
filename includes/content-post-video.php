<?php while ( have_posts() ) : the_post(); //Open the loop ?>
    <!-- Portfolio Item Row -->
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <div class="row">
        <div class="col-md-8">
            <?php
                $url = get_post_meta( get_the_ID(), 'html_to_wp_video_url', true );
                parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            ?>
            <iframe class="single-post-video" width="700" height="400" src="https://www.youtube.com/embed/<?php echo $my_array_of_vars['v']?>"></iframe>
            <article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
                <section class="entry-meta">
                    <?php echo get_the_date(); ?>
                </section><!-- .entry-meta -->

                <section class="entry-content">
                    <?php the_content(); ?>
                </section><!-- .entry-content -->

            </article>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>

        <!-- /.row -->
    </div>
<?php endwhile; // End the loop. ?>
