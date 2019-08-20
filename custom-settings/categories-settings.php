<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/** Step 2 (from text above). Register the above function using the admin_menu action hook */
add_action( 'admin_menu', 'categories_settings' );

/** Step 1. Function that contains the menu-building code */
function categories_settings() {
    $submenu_text = '<span class="submenu-text-edit">Settings &nbsp;</span>';
    $submenu_dashicon = '<span class="dashicons dashicons-edit submenu"></span>';
    // Adds a new item to the Settings administration menu via the add_options_page() function
    add_posts_page(
            'Categories Settings',                          // page_title
            $submenu_text . $submenu_dashicon,              // menu_title
            'edit_posts',                                   // capability
            'categories_settings_identifier',               // menu_slug
            'categories_options'                           // function
    );
}

// Include css and js stylesheets inside the widget
//wp_enqueue_style( 'style-our-team', get_template_directory_uri() . '/widgets/hedonist-our-team/style-our-team.css' );

/** Step 3. HTML output for the page */
function categories_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    $opt_name = 'section-1';
    $hidden_field_name = 'our_team_submit_hidden';
    // Read their posted value
    $data_field_name = 'section-1[]';

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        if(isset($_POST['section-1'])) {
            $data = ($_POST['section-1']);

            // Save the posted value in the database
            update_option($opt_name, $data);
        }

        // Put a "settings saved" message on the screen
        ?>
        <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
        <?php
    }

// Now display the settings editing screen
echo '<div class="wrap">';

// header
echo "";
echo "<h2><span class=\"dashicons dashicons-edit settings\"></span>&emsp;" . __( 'Posts Areas', 'menu-test' ) . "</h2>";

// settings form
?>
    <form class="container-posts-settings" name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    <!--    Section 1-->
        <div id="section-1">
            <div class="checkbox-post">
                <h3><?php _e("Section 1", 'menu-test' ); ?></h3>
                <p><?php _e("Categories:", 'menu-test' ); ?></p>
                <?php
                $cat_args=array(
                    'orderby' => 'name',
                    'order' => 'ASC'
                );
                $checked_category_arr = get_option('section-1');
                $categories = get_categories($cat_args);
                $current_categories = array(); // Store the existed categories names

                foreach ($categories as $category) {
                    $current_categories[] = $category->name;
                }

                // Returns an array containing categories which exist in both arrays
                $matched_category = array_intersect($checked_category_arr, $current_categories);
                for ($i = 0; $i < sizeof($current_categories); $i++) {
                    $category = $categories[$i];
                    // Searches $matched_category array for current categories
                    if(in_array($current_categories[$i], $matched_category)) {
                        ?><input type="checkbox" checked="checked" value="<?php echo $category->cat_name; ?>" name="<?php echo $data_field_name; ?>"><?php echo $category->cat_name?><br><?php
                    }
                    else {
                        ?><input type="checkbox" value="<?php echo $category->cat_name; ?>" name="<?php echo $data_field_name; ?>"><?php echo $category->cat_name?><br><?php
                    }
                } ?>

            </div>
            <div class="image-post">
                <img src="<?php echo get_template_directory_uri() ?>/images/section-1.png">
            </div>
        </div>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
    </form>
<?php
}
