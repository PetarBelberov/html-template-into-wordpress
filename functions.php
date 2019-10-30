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


/* Register widget area. */
function html_to_wp_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'html_to_wp' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'html_to_wp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'html_to_wp_widgets_init' );
/**/

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
function html_to_wp_enqueue_assets() {

    /* theme's primary style.css file */
    wp_enqueue_style( 'style' , get_stylesheet_uri() );

    /* bootstrap and jquery resources from theme files */
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js' , array( 'jquery' ) , false , true );
    wp_enqueue_script( 'jquery-js' , get_template_directory_uri() . '/vendor/jquery/jquery.min.js' , array( 'jquery' ) , false , true );

    wp_enqueue_script( 'custom-js' , get_template_directory_uri() . '/custom-styles/custom.js' );
}
add_action( 'wp_enqueue_scripts' , 'html_to_wp_enqueue_assets' );

function html_to_wp_enqueue_admin_post_page($hook) {
    // Only add to the edit.php admin page.
    // See WP docs.
    if ('post.php' !== $hook) {
        return;
    }
    wp_enqueue_script( 'post_reload' , get_template_directory_uri() . '/js/admin_post_reload.js' , array( 'jquery' ) , false , true );
}
add_action('admin_enqueue_scripts', 'html_to_wp_enqueue_admin_post_page');

// Enqueue in admin area
function html_to_wp_enqueue_admin() {
    wp_enqueue_media();
    wp_enqueue_script( 'media-upload', get_template_directory_uri() . '/custom-styles/media-upload.js', array('jquery'), false , true );
//    wp_enqueue_script('media-upload');
}
add_action('admin_enqueue_scripts', 'html_to_wp_enqueue_admin');

// Add custom code snippets
require get_template_directory() . '/custom-settings/section-1-settings.php';
require get_template_directory() . '/custom-settings/section-2-settings.php';
require get_template_directory() . '/custom-settings/section-3-settings.php';
require get_template_directory() . '/custom-settings/section-4-settings.php';


//Add custom classes to anchor in wp_nav_menu
function add_additional_class_on_li($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

//Add custom classes to anchor in wp_nav_menu
function add_additional_class_on_a($classes, $item, $args) {
    if($args->add_a_class) {
        $classes[] = $args->add_a_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_a', 1, 3);

//Function to add Meta Tags in Header without Plugin
function add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
}
add_action('wp_head', 'add_meta_tags');

//Gutenberg Disabled
// disable for posts
//add_filter('use_block_editor_for_post', '__return_false', 10);

// Admin notices functionality in the admin post screen
function html_to_wp_admin_notice() {
    $screen = get_current_screen();
    $post = get_post();
    $post_id = $post->ID;

    $post_categories = (get_the_category($post_id));
    foreach ($post_categories as $post_category) {
        $current_category_slug = $post_category->slug;
        //Checks the current post category slug (Ternary Operators)
        $img_or_video = (
                        $current_category_slug == 'current-events' ||
                        $current_category_slug == 'global-news'
                        ? 'image'
                        : 'video'
        );

        $param = array(
            'img_or_video' => $img_or_video,
        );
        if ($img_or_video == 'image') {

            // Only render this notice in the post editor.
            if ( ! $screen || 'post' !== $screen->base ) {
                return;
            }
            if(!has_post_thumbnail()) { // Image thumbnail

                wp_enqueue_script('admin_notices', get_template_directory_uri() . '/js/admin_notices.js', array('jquery'), false, true);
                // passing '$img_or_video' parameter to javascript file
                wp_localize_script( 'admin_notices', 'script_param', $param );

                echo '<div class="notice notice-error">
                <p>This post has no featured' . $img_or_video . '. Please set one.</p>
                </div>';

                $update_post = array(
                    'ID' => $post_id,
                    'post_status' => 'draft'
                );
                wp_update_post($update_post);
            }
            else {
                $update_post = array(
                    'ID' => $post_id,
                    'post_status' => 'publish'
                );
                wp_update_post($update_post);
            }

        }
        elseif ($img_or_video == 'video') {

            if (count(get_the_category()) == 1) {
                if ( ! $screen || 'post' !== $screen->base ) {
                    return;
                }
                $url = get_post_meta( get_the_ID(), 'html_to_wp_video_url', true ); //Video URL from "Featured Video" meta box

                if(!wp_http_validate_url($url)) { // Video thumbnail

                    wp_enqueue_script('admin_notices', get_template_directory_uri() . '/js/admin_notices.js', array('jquery'), false, true);
                    //passing '$img_or_video' parameter to javascript file
                    wp_localize_script( 'admin_notices', 'script_param', $param );

                    echo '<div class="notice notice-error">
                <p>This post has no featured' . $img_or_video . '. Please set one.</p>
                </div>';

                    $update_post = array(
                        'ID' => $post_id,
                        'post_status' => 'draft'
                    );
                    wp_update_post($update_post);
                }
                else {
                    $update_post = array(
                        'ID' => $post_id,
                        'post_status' => 'publish'
                    );
                    wp_update_post($update_post);
                }
            }
        }
    }
};
add_action( 'admin_notices', 'html_to_wp_admin_notice' );