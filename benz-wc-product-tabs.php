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

class Extension_For_WooCommerce {		  			
    public function init() {						
        add_action( 'admin_init', array( $this, 'start' ) );				
        add_action( 'admin_init', array( $this, 'stop' ) );			
    }
    
    private function woocommerce_is_active() {
        #function woocommerce_is_active() {			
        return is_plugin_active( 'woocommerce/woocommerce.php' );		
        }
    
    public function start() {
        if ( ! $this->woocommerce_is_active() ) {
            return;			
        }
        include( plugin_dir_path( __FILE__ ) . 'benz-tabs-admin.php');
        include( plugin_dir_path( __FILE__ ) . 'benz-tabs-frontend.php');
    }
    
    public function stop() {
        if ( ! $this->woocommerce_is_active() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            unset( $_GET['activate'] );
        }
    }
}
