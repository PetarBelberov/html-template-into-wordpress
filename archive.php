<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Html-template-into-wordpress
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
    <?php if ( have_posts() ) : ?>
    <?php
    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;
    $category_name = $categories[0]->name;
    //Display Posts From Specific Category
    $args = array(
        'cat' => $category_id,
        'post_type' => 'post',
        'post_status' => 'publish',
    );

    //Use WP_Query class to fetch the posts
    $arr_posts = new WP_Query($args);

    ?>
        <h1 class="my-4"><?php echo $category_name; ?></h1>
        <div class="row justify-content-center archive-posts">
            <?php if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post(); ?>
                <div id="post-<?php the_ID() ?>" >
                    <div class="a">
                        <h3><?php echo get_the_title(); ?></h3>
                        <p><?php echo get_the_excerpt(); ?></p>

                        <div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
        <!-- /.row -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
