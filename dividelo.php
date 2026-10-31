<?php
/**
 *
 *
 * @link              https://renzotejada.com/
 * @package           Divídelo
 * @author            Renzo Tejada
 * @wordpress-plugin
 * Plugin Name:       Divídelo
 * Plugin URI:        https://renzotejada.com/dividelo-para-woocommerce
 * Description:       This Dividelo plugin adds the installment simulation component for Interbank's exclusive clients.
 * Version:           1.3.0
 * Author:            Renzo Tejada
 * Author URI:        https://renzotejada.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rt-dividelo-ibk
 * Domain Path:       /language
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * WC tested up to:   11.2.1
 * WC requires at least: 9.0
 */
if (!defined('ABSPATH')) {
    exit;
}

$plugin_dividelo_ibk_version = get_file_data(__FILE__, array('Version' => 'Version'), false);

define('Version_RT_Dividelo', $plugin_dividelo_ibk_version['Version']);

add_action( 'before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

/*
 * ADMIN
 */
if ( is_admin() ) {
    require __DIR__ . "/dividelo_admin.php";
}

/*
 * Product Page
 */
add_action( "plugins_loaded", function () {
    if ( class_exists( "WooCommerce" ) ) {
        require_once __DIR__ . "/dividelo_producto_page.php";
    }
} );

add_filter( "plugin_action_links_" . plugin_basename( __FILE__ ), function ( $links ) {
    array_unshift( $links, "<a href=\"" . esc_url( admin_url( "admin.php?page=rt_dividelo_settings" ) ) . "\">" . esc_html__( "Ajustes", "rt-dividelo-ibk" ) . "</a>" );
    return $links;
} );



