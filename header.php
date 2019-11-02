<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta charset="<?php bloginfo( 'description' ); ?>">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        /* Generate a navigation menu */
        wp_nav_menu( array(
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'navbarResponsive',
            'menu_class'        => 'navbar-nav ml-auto',
            'add_li_class'  => 'nav-item',
            'add_a_class'  => 'nav-link',
        ) );
        ?>
    </div>
</nav>
<!-- Navigation -->
<?php if ( is_front_page() ) : ?> <!-- Checks whether is a front page and visualise the slider -->
<header>
    <!-- Slider Section -->
    <?php get_template_part('includes/content/area-slider') ?>
</header>
<?php endif; ?>

<!-- Page Content -->
<div class="container">
