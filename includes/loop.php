<?php

//Display Posts From Specific Category
$args = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'post_status' => 'publish',
    'category_name' => 'current-events + global-news',
    'posts_per_page' => 5,
);

//Use WP_Query class to fetch the posts
$arr_posts = new WP_Query($args)
?>

<div class="row">
    <?php if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post(); ?>
        <div id="post-<?php the_ID() ?>" <?php post_class('col-lg-4 mb-4') ?>>
            <div class="card h-100">
                <h4 class="card-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="card-body">
                    <?php
                    $sentence = preg_split( '/(\.|!|\?)\s/', get_the_content(), 2, PREG_SPLIT_DELIM_CAPTURE );
                    ?>
                    <p class="card-text"><?php echo $sentence['0'] . $sentence['1']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    <?php endwhile; else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</div>