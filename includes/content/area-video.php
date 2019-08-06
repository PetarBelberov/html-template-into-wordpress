<?php


//Display Posts From Specific Category
$args = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'post_status' => 'publish',
    'category_name' => 'video',
);

//Use WP_Query class to fetch the posts
$arr_posts = new WP_Query($args);

?>

<div class="row">
    <?php
        if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
        $url = get_post_meta( get_the_ID(), 'html_to_wp_video_url', true );
    ?>
        <!-- Checks for a single selected category -->
        <?php if (in_category('video') && count(get_the_category()) == 1 && !empty($url)) { ?>

        <div id="post-video-<?php the_ID() ?>" <?php post_class('col-lg-6') ?>>
            <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
            <p><?php the_excerpt(); ?></p>
        </div>
        <div class="col-lg-6">

            <?php
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            ?>
            <iframe width="550" height="300" src="https://www.youtube.com/embed/<?php echo $my_array_of_vars['v']?>"></iframe>
        </div>
    <?php break; } endwhile; else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php
     endif;
    wp_reset_postdata();
    ?>
</div>