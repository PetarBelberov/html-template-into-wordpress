<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package html-template-into-wordpress
 */
?>

<?php get_header(); ?>
<div class="main">

    <div id="content" class="two-thirds left">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part( 'includes/content', 'post' ); ?>
        </article><!-- #post-## -->

    </div><!-- #content -->
</div><!-- .main -->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
