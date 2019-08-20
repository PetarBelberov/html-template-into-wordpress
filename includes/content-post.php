<?php while ( have_posts() ) : the_post(); //Open the loop ?>
    <!-- Portfolio Item Row -->
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <div class="row">
        <div class="col-md-8">
            <img class="img-fluid" src="<?php the_post_thumbnail(); ?>
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
