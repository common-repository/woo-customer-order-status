<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://purvik.me
 * @since      1.0.0
 *
 * @package    Wc_Customer_Order_Status
 * @subpackage Wc_Customer_Order_Status/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Customer_Order_Status
 * @subpackage Wc_Customer_Order_Status/admin
 * @author     Purvik <contact@purvik.me>
 */
class Wc_Customer_Order_Status_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Customer_Order_Status_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Customer_Order_Status_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-customer-order-status-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Customer_Order_Status_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Customer_Order_Status_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-customer-order-status-admin.js', array( 'jquery' ), $this->version, false );

	}
        
        /**
         * Register the metabox
         * 
         * @since    1.0.0
         */
        public function wc_total_order_metabox(){

                add_meta_box('wc_total_order', 'Customer Total Order Status', array($this,'wc_total_order_function'), 'shop_order', 'side', 'high');

        }
        
        /**
         * Display previous order function
         * 
         * @since    1.0.0
         */
        public function wc_total_order_function(){
    
                global $woocommerce, $post;
                $order = new WC_Order($post->ID);
                $order_id = $order->get_order_number();
                $user_id = $order->get_user_id();

                // Get selected order status
                $status_array = wc_selected_status_list();
                
                if(empty($status_array))
                    return false;

                echo '<ul class="widefat wc-prev-order">';
                foreach ($status_array as $key => $value) {
                    $order = wc_get_order_count($user_id, 'wc-'.$key);
                    echo '<li class="order_status column-order_status">';
                        echo '<a href="'. admin_url( 'edit.php?post_type=shop_order&post_status=wc-'.$key.'&_customer_user='.$user_id ) .'" target="_blank">';
                            echo '<h3>'.$order.'</h3>';
                            echo '<mark class="'.$key.' tips" data-tip="'.$value.'">'.$value.'</mark>';
                        echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';

        }
        
        function wc_order_admin_setting_menu() {
		add_options_page(
                    'Page Title',
                    'WC Order Status',
                    'manage_options',
                    'wc_total_order_status',
                    array( $this, 'settings_page' )
		);
	}
        
        /**
         * Register admin setting page
         * 
         * @since    1.0.0
         */
        public function wcprev_register_setting(){
                register_setting('wcprev_setting', 'wcprev_status');                                                    // save woocommerce status
                
        }
        
        /**
         * Check is woocommerce active or not
         * 
         * @since    1.0.0
         */
        public function wc_prev_admin_notice__error(){
            if ( !class_exists( 'WooCommerce' ) ) {
                wc_e_notice();
            }
        }

        /**
         * Display admin setting page
         * 
         * @since    1.0.0
         */
	public function  settings_page() {
		include_once 'partials/wc-customer-order-status-admin-display.php';        
	}

}
