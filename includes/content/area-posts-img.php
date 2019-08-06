<?php

//Display Posts From Specific Category
$args = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'post_status' => 'publish',
    'category_name' => 'current-events',
    'posts_per_page' => 5,
);

//Use WP_Query class to fetch the posts
$arr_posts = new WP_Query($args)
?>

<h2>Portfolio Heading</h2>
<div class="row">
    <?php if ( $arr_posts->have_posts()) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post(); ?>
        <?php
//    <!--Determines whether a post has an image attached.-->
    if (has_post_thumbnail()) : ?>
    <div id="post-img-<?php the_ID() ?>" <?php post_class('col-lg-4 col-sm-6 portfolio-item') ?>>
            <div class="card h-100">
                <a href="<?php the_permalink(); ?>"><img class="card-img-top" src=<?php the_post_thumbnail(array(289, 165)); ?></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php endwhile; else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</div>