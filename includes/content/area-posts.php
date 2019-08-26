<?php
// Get the the checked category slug for this area
$categories_names_arr = get_option('section-1')['categories_names'];
$categories_order_by = get_option('section-1')['sort-by'];
$asc_or_desc_order = get_option('section-1')['asc-or-desc'];
$posts_per_page = get_option('section-1')['posts-per-page'];

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
$arr_posts = new WP_Query($args);

?>
<h1 class="my-4">Welcome to Modern Business</h1>
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
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    <?php endwhile; else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</div>