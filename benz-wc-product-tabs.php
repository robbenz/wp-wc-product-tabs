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
    include( plugin_dir_path( __FILE__ ) . 'benz-tabs-admin.php');
    include( plugin_dir_path( __FILE__ ) . 'benz-tabs-frontend.php');
  }
}
