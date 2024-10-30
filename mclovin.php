<?php
/**
* Plugin Name: McLovin
* Plugin URI: https://plugins.followmedarling.se/mclovin/
* Description: Add the possibility to choose product ID in Facebook for WooCommerce, and avoid the strange forced value of SKU and Id.
* Version: 1.0.0
* Author: Jonk @ Follow me Darling
* Author URI: https://plugins.followmedarling.se/
* Domain Path: /languages
* Text Domain: mclovin
**/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$mclovin_dir = plugin_dir_path( __FILE__ );

load_plugin_textdomain( 'mclovin', false, basename( dirname( __FILE__ ) ) . '/languages' );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'mcloving_settings_link' );
function mcloving_settings_link( $links ) {
	$links[] = '<a href="' . admin_url( 'admin.php?page=mclovin_settings' ) . '">' . __( 'Settings' ) . '</a>';
	return $links;
}

add_filter( 'wc_facebook_fb_retailer_id', 'mclovin', 10, 2 );
function mclovin( $fb_retailer_id, $woo_product ) {
    $mclovin_type = get_mclovin_options( 'mclovin_type', false, '', true );
    if ( $woo_product ) {
        if ( $mclovin_type == 'id' ) {
            $woo_id = $woo_product->get_id();
            return strval( $woo_id );
        } elseif ( $mclovin_type == 'sku' ) {
            $woo_id = $woo_product->get_sku();
            return strval( $woo_id );
        } else {
            return $fb_retailer_id;
        }
    } else {
        return $fb_retailer_id;
    }
}

include_once( $mclovin_dir . 'inc/settings.php' );
