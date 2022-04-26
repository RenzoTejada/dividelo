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
 * Description:       Descubre Divídelo. Cuotas especiales con tu tarjeta de Interbank
 * Version:           0.0.2
 * Author:            Renzo Tejada
 * Author URI:        https://renzotejada.com/
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       rt-dividelo-ibk
 * Domain Path:       /language
 * Requires at least: 5.6
 * Requires PHP:      5.6.20
 * WC tested up to:   6.3.1
 * WC requires at least: 2.6
 */
if (!defined('ABSPATH')) {
    exit;
}

$plugin_dividelo_ibk_version = get_file_data(__FILE__, array('Version' => 'Version'), false);

define('Version_RT_Dividelo', $plugin_dividelo_ibk_version['Version']);

/*
 * ADMIN
 */
require dirname(__FILE__) . "/dividelo_admin.php";

/*
 * Product Page
 */
require dirname(__FILE__) . "/dividelo_producto_page.php";

