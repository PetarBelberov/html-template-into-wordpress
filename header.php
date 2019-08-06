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
        <a class="navbar-brand" href="index.php">Start Bootstrap</a>
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
    <?php
    //Display Posts From Specific Category
    $args = array(
        'post_type' => 'post',
        'orderby' => 'date',
        'post_status' => 'publish',
        'category_name' => 'top-3',
        'posts_per_page' => 3,
    );
    //Use WP_Query class to fetch the posts
    $arr_posts = new WP_Query($args)
    ?>
    <!-- Slider -->
    <div id="carouselExampleIndicators" <?php post_class('carousel slide'); ?> data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php $counter = 0; ?>
            <?php if ($arr_posts->have_posts()) : while ($arr_posts->have_posts()) : $arr_posts->the_post() ?>
            <?php
            if ($counter == 0) :
                $active = ' active';
            else :
                $active = '';
            ?>
            <?php endif; ?>
            <div id="carousel-item-<?php the_ID(); ?>" class="carousel-item<?php echo $active ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                <div class="carousel-caption d-none d-md-block">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <?php
                    $counter++;
                    $active = '';
                    ?>
                </div>
            </div>
            <?php endwhile; endif; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Slider -->
</header>
<?php endif; ?>

<!-- Page Content -->
<div class="container">
