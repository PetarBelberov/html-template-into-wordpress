<?php while ( have_posts() ) : the_post(); //Open the loop ?>
    <!-- Portfolio Item Row -->
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <div class="row">
        <div class="col-md-8">
            <!--     Check for featured image       -->
            <?php if(has_post_thumbnail()) : ?>
                <img class="img-fluid" src="<?php the_post_thumbnail(); ?>"</img>
            <?php elseif (in_category('video') && count(get_the_category()) == 1) : ?>
                <?php
                $url = get_post_meta( get_the_ID(), 'html_to_wp_video_url', true );
                parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                $embed_url = 'https://www.youtube.com/embed/';
                ?>
                <iframe class="single-post-video" width="700" height="400" src="<?php echo esc_url($embed_url.$my_array_of_vars['v'])?>"></iframe>
            <?php endif; ?>
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
        <hr>
        <!-- Related topics -->
        <div class="related-topics">
            <div class="categories-single-post">
                <?php the_category(); ?>
            </div>
        </div>
    </div>
<?php endwhile; // End the loop. ?>
