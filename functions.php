<?php

/* enqueue styles and scripts */
function jpen_enqueue_assets() {

    /* theme's primary style.css file */
    wp_enqueue_style( 'style' , get_stylesheet_uri() );

    /* bootstrap and jquery resources from theme files */
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js' , array( 'jquery' ) , false , true );
    wp_enqueue_script( 'jquery-js' , get_template_directory_uri() . '/vendor/jquery/jquery.min.js' , array( 'jquery' ) , false , true );

}
add_action( 'wp_enqueue_scripts' , 'jpen_enqueue_assets' );

// Add custom widgets and widget areas
require get_template_directory() . '/custom-settings/categories-settings.php';