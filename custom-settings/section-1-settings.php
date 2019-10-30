<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/** Step 2 (from text above). Register the above function using the admin_menu action hook */
add_action( 'admin_menu', 'categories_settings_s1' );

/** Step 1. Function that contains the menu-building code */
function categories_settings_s1() {
    $submenu_text = '<span class="submenu-text-edit">Section 1 &nbsp;</span>';
    $submenu_dashicon = '<span class="dashicons dashicons-format-aside"></span>';
    // Adds a new item to the Settings administration menu via the add_options_page() function
    add_posts_page(
            'Categories Settings 1',                          // page_title
            $submenu_text . $submenu_dashicon,              // menu_title
            'edit_posts',                                   // capability
            'categories_settings_identifier_1',               // menu_slug
            'categories_options_s1'                           // function
    );
}

// Include css and js stylesheets inside the widget
//wp_enqueue_style( 'style-our-team', get_template_directory_uri() . '/widgets/hedonist-our-team/style-our-team.css' );

/** Step 3. HTML output for the page */
function categories_options_s1() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    $opt_name = 'section-1';
    $hidden_field_name = 'section_1_submit_hidden';
    // Read their posted value
    $data = array();
    $order_by_parameters = array("none", "ID", "title", "name", "date", "modified", "rand");
    $asc_or_desc = array("ASC", "DESC");

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        if(isset($_POST['categories_names'])) { // Checks if there is marked category
            $data['categories_names'] = $_POST['categories_names'];
            $data['asc-or-desc'] = $_POST['asc-or-desc'];
            $data['posts-per-page'] = $_POST['posts-per-page'];

            // Get the value of multiple select option
            foreach ($_POST['order-by-parameter'] as $select)
            {
                $data['sort-by'] = $select;
            }

            $merged_options = wp_parse_args( $data); // Merge arguments into defaults array
            // Save the posted value in the database
            update_option($opt_name, $merged_options);

            // Put a "settings saved" message on the screen
            ?>
            <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
            <?php
        }
        else {
            // Put an "error" message on the screen
            ?>
            <div class="error"><p><strong><?php _e('There is no selected category.', 'menu-test' ); ?></strong></p></div>
            <?php
        }
    }

// Now display the settings editing screen
echo '<div class="wrap">';

// header
echo "";
echo "<h2><span class=\"dashicons dashicons-format-aside\"></span>&emsp;" . __( 'Posts Areas', 'menu-test' ) . "</h2>";

// settings form
?>
    <form class="container-posts-settings" name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    <!--    Section 1-->
        <div id="section-1">
            <table class="form-table">
                <tbody>
                <tr class="image-section">
                    <th><?php _e("Section 1", 'menu-test' ); ?></th>
                    <td class="image-post">
                        <img src="<?php echo get_template_directory_uri() ?>/images/section-1.png">
                        <p class="description">(Section 1 looks like this.)</p>
                    </td>
                </tr>
                    <tr class="checkbox-post">
                        <th><?php _e("Categories:", 'menu-test' ); ?></th>
                        <td>
                            <?php
                            $cat_args=array(
                                'orderby' => 'name',
                                'order' => 'ASC'
                            );
                            $section_1_values = get_option('section-1'); // Get an array with the saved values
                            $categories = get_categories($cat_args);
                            $current_categories = array(); // Store the existed categories names

                            foreach ($categories as $category) {
                                $current_categories[] = $category->name;
                            }

                            // Returns an array containing categories which exist in both arrays
                            $matched_category = array_intersect($section_1_values['categories_names'], $current_categories);
                            for ($i = 0; $i < sizeof($current_categories); $i++) {
                                $category = $categories[$i];
                                // Searches $matched_category array for current categories
                                ?><input type="checkbox" <?php if(in_array($current_categories[$i], $matched_category)) {echo checked(true); } ?> value="<?php echo $category->cat_name; ?>" name="categories_names[]"><?php echo $category->cat_name?><br>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr class="additional-settings" id="order-posts-by-1">
                        <th><?php _e("Sort posts by parameter:", 'menu-test' ); ?></th>
                        <td>
                            <select name="order-by-parameter[]">
                                <?php foreach ($order_by_parameters as $order_by_param) { ?>
                                <!-- Matches saved value from database with the existing options -->
                                    <option <?php if ($section_1_values['sort-by'] == $order_by_param) {echo selected(true);} ?> value="<?php echo $order_by_param?>"><?php echo $order_by_param ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="additional-settings" id="asc-or-desc-2">
                        <th><?php _e("ASC or DESC order:", 'menu-test' ); ?></th>
                        <td>
                            <select name="asc-or-desc">
                                <?php foreach ($asc_or_desc as $param) { ?>
                                    <!-- Matches saved value from database with the existing options -->
                                    <option <?php if ($section_1_values['asc-or-desc'] == $param) {echo selected(true);} ?> value="<?php echo $param?>"><?php echo $param ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="additional-settings" id="posts-per-page-3">
                        <th><?php _e("Posts per page:", 'menu-test' ); ?></th>
                        <td>
                            <input type="number" name="posts-per-page" value="<?php echo $section_1_values['posts-per-page']; ?>" placeholder="Set a number:">
                        </td>
                    </tr>
                </tbody>
            </table>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
    </form>
<?php
}
