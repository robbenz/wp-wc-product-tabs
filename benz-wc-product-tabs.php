<?php
/*
Plugin Name: BENZ SOMETHING ELSE
Plugin URI: robbenz.com
Description:  This plugin will add as many product tabs to your woocommerce product pages as needed.
Version: 1.0
Author: Rob Benz
Author URI: robbenz.com
License: GPL2
*/

add_action( 'admin_init', 'benz_tabs_plugin_has_woo' );
function benz_tabs_plugin_has_woo() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        add_action( 'admin_notices', 'benz_tabs_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function benz_tabs_plugin_notice(){
    ?><div class="error"><p>Sorry, but Tabs for Woocommerce Poducts Plugin requires Woocommerce to be installed and active.</p></div><?php
}

add_action( 'admin_init', 'benz_tabs_includes' );
function benz_tabs_includes() {
  if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
    $mypluginrequires = array(
      'benz-tabs-admin.php',
    //  'benz-tabs-admin-settings.php',
      'benz-tabs-frontend.php'
    );
    foreach ( $mypluginrequires as $need ) {
      include( plugin_dir_path( __FILE__ ) . $need );
    }
  }
}

//add admin settings
add_action('admin_init', 'benz_admin_init');
add_action('admin_menu', 'benz_plugin_menu' );

/**
 * Add plugin admin settings
 */
function benz_admin_init() {
    register_setting('benz-group', 'benz_dashboard_title');
    register_setting('benz-group', 'benz_number_of_items');
}

/**
 * add menu to admin
 */
function benz_plugin_menu() {
    $blog_title = get_bloginfo( 'name' );
    add_options_page( "$blog_title Custom Product Tabs Options", "$blog_title Custom Product Tabs", 'manage_options', 'benz', 'benz_plugin_options' );
}

/**
 * show admin settings page
 */
function benz_plugin_options() {
  $blog_title = get_bloginfo( 'name' );
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php echo $blog_title; ?> Custom Product Tabs Options</h2>
        <form action="options.php" method="post">
            <?php settings_fields('benz-group'); ?>
            <?php @do_settings_fields('benz-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="benz_dashboard_title">Default Number of Tabs</label></th>
                    <td>
                        <input type="text" name="benz_dashboard_title" id="dashboard_title" value="<?php echo get_option('benz_dashboard_title'); //here ?>" />
                        <br/><small>Default Number of Tabs</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="benz_number_of_items">Max Number of Tabs</label></th>
                    <td>
                        <input type="text" name="benz_number_of_items" id="dashboard_title" value="<?php echo get_option('benz_number_of_items'); // here ?>" />
                        <br/><small>Max Number of Tabs</small>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="XX">Kill</label></th>
                    <td>
                        <input type="checkbox" name="XX" id="Kill" value="" />
                        <br/><small>Want to delete all the data when you un-install? Please only check if you know what you are doing. <br>If this box is checked when you uninstall or delete ( not deactivate ) this plugin <br><strong>All of your tab data will be lost.</strong></small>
                    </td>
                </tr>


            </table> <?php @submit_button(); ?>
        </form>
    </div>
    <?php
}

 ?>
