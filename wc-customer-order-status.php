<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://purvik.me
 * @since             1.0.0
 * @package           Wc_Customer_Order_Status
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Customer Order Status
 * Plugin URI:        http://purvik.me/plugins/woocommerce-customer-order-status
 * Description:       Display previous order of customer from your admin order page
 * Version:           1.0.0
 * Author:            Purvik
 * Author URI:        http://purvik.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-customer-order-status
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-customer-order-status-activator.php
 */
function activate_wc_customer_order_status() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-order-status-activator.php';
	Wc_Customer_Order_Status_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-customer-order-status-deactivator.php
 */
function deactivate_wc_customer_order_status() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-order-status-deactivator.php';
	Wc_Customer_Order_Status_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_customer_order_status' );
register_deactivation_hook( __FILE__, 'deactivate_wc_customer_order_status' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-order-status.php';
require plugin_dir_path( __FILE__ ) . 'includes/global-function.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_customer_order_status() {

	$plugin = new Wc_Customer_Order_Status();
	$plugin->run();

}
run_wc_customer_order_status();
