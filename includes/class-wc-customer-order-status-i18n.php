<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://purvik.me
 * @since      1.0.0
 *
 * @package    Wc_Customer_Order_Status
 * @subpackage Wc_Customer_Order_Status/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wc_Customer_Order_Status
 * @subpackage Wc_Customer_Order_Status/includes
 * @author     Purvik <contact@purvik.me>
 */
class Wc_Customer_Order_Status_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-customer-order-status',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
