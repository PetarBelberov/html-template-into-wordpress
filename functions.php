<?php

/****************************************************************************
Theme setup
 ****************************************************************************/
if ( ! function_exists( 'html_to_wp_theme_setup' ) ) :
    function html_to_wp_theme_setup() {

        // translation
        load_theme_textdomain( 'html_to_wp', get_stylesheet_directory() . '/languages' );
        // post formats
        add_theme_support( 'post_formats' );
        // Post thumbnails or featured images
        add_theme_support( 'post-thumbnails');
        // RSS feed links to head
        add_theme_support( 'automatic-feed-links' );
        // navigation menu
        register_nav_menus( array(
            'primary' => __( 'Primary Navigation', 'html_to_wp' )
        ) );

        // title tags
        add_theme_support( 'title-tag' );
    }
add_action( 'after_setup_theme', 'html_to_wp_theme_setup' );
endif;

/* Meta box for video url to be displayed on the post editor screen. */
function html_to_wp_add_post_metabox() { /*creates the metabox*/
    add_meta_box(
        'html_to_wp_metabox',               // $id: CSS ID
        'Featured Video',                   // $title: the name of the meta box
        'html_to_wp_metabox_callback',      // $callback: callback function containing the HTML for your meta box
        'post',                             // $post-type: admin page (or post type)
        'side',                             // $context: where in the editing page the meta box should be displayed
        'high'                              // priority: the priority level for displaying your meta box
    );}
add_action( 'add_meta_boxes', 'html_to_wp_add_post_metabox' );

//The callback function defines what will be displayed on the post editing screen
function html_to_wp_metabox_callback( $post ) {
?>
<form action="" method="post">

    <?php // add nonce for security / checked before the metadata is saved, to be sure that users have used this metabox
    wp_nonce_field( 'html_to_wp_metabox_nonce', 'html_to_wp_nonce' );

    //retrieve metadata value if it exists
    $video_url = get_post_meta( $post->ID, 'html_to_wp_video_url', true ); ?>

    <label for="html_to_wp_metadata_video_url">Please insert a valid video URL</label>
    <input style="width:100%;" type="text" name="html_to_wp_metadata_video_url" placeholder="e.g. https://www.youtube.com/watch?v=N1-Jmq7BLFE" value=<?php echo esc_attr( $video_url ); ?>>

</form>
<?php
}

function html_to_wp_save_my_meta( $post_id ) {

    //check for nonce
    if( !isset( $_POST['html_to_wp_nonce'] ) ||
        !wp_verify_nonce( $_POST['html_to_wp_nonce'], 'html_to_wp_metabox_nonce' ) ) {
        return;
    }

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['html_to_wp_metadata_video_url'] ) ) {
        $new_value = ( $_POST['html_to_wp_metadata_video_url'] );
        update_post_meta( $post_id, 'html_to_wp_video_url', $new_value );
    }

}
add_action( 'save_post', 'html_to_wp_save_my_meta' );

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
