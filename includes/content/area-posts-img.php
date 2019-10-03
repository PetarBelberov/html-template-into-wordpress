<?php
// Get the the checked category slug for this area
$categories_names_arr = get_option('section-2')['categories_names'];
$categories_order_by = get_option('section-2')['sort-by'];
$asc_or_desc_order = get_option('section-2')['asc-or-desc'];
$posts_per_page = get_option('section-2')['posts-per-page'];

$category_id = array();
foreach ($categories_names_arr as $categories_names) {
    $category_id[] = get_cat_ID($categories_names);
}

//Display Posts From Specific Category
$args = array(
    'post_type' => 'post',
    'orderby' => $categories_order_by,
    'order' => $asc_or_desc_order,
    'post_status' => 'publish',
    'cat' => $category_id, //Display posts that have several categories, using category id
    'posts_per_page' => $posts_per_page,
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