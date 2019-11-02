<?php
/* The main index file */
?>

<?php get_header(); ?>
<div class="main">

    <div id="content" class="two-thirds left">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (in_category('video') && count(get_the_category()) == 1)  : ?>
                <?php get_template_part( 'includes/content-post-video' ); ?>
            <?php elseif (in_category('current-events')) : ?>
                <?php get_template_part( 'includes/content-post-img' ); ?>
            <?php elseif (in_category(get_option('section-1')['categories_names'])) : ?>
                <?php get_template_part( 'includes/content-post' ); ?>
            <?php endif; ?>
        </article><!-- #post-## -->

    </div><!-- #content -->
</div><!-- .main -->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
