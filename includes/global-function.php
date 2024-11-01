<?php

/**
 * Woocommerce order status list
 * 
 * @since    1.0.0
 * @return string
 */
function wc_order_status() {
    $array = array(
        'pending' => 'Pending Payment',
        'processing' => 'Processing',
        'on-hold' => 'On Hold',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded',
        'failed' => 'Failed',
    );
    return $array;
}

/**
 * Get selected status array
 * 
 * @since    1.0.0
 * @return array
 */
function wc_selected_status_array(){
    $status_data = get_option('wcprev_status');
    if( $status_data != "" ){
        $status = maybe_unserialize($status_data);
    }else{
        $status = array();
    }
    
    return $status;
}

/**
 * Woocommerce selected status list
 * 
 * @since    1.0.0
 * @return type
 */
function wc_selected_status_list(){
    $data = array();
    $status_list = wc_order_status();
    $status_selected = wc_selected_status_array();
    
    foreach ($status_list as $key => $value) {
        if( in_array($key, $status_selected) ){
            $data[$key] = $value;
        }
    }
    
    return $data;
}

/**
 * Woocommerce get order count
 * 
 * @since    1.0.0
 * @param type $user_id
 * @param type $post_status
 * @return type
 */
function wc_get_order_count($user_id,$post_status){
            
        $orders_data = get_posts( array(
            'numberposts' => -1,
            'meta_key'    => '_customer_user',
            'meta_value'  => $user_id,
            'post_type'   => wc_get_order_types(),
            'post_status' => $post_status,
        ) );

        return count($orders_data);
}

/**
 * Get error notice if woocommerce plugin is not active
 * 
 * @since    1.0.0
 */
function wc_e_notice(){
    echo '<div class="error  notice">';
        echo '<p><strong>Woocommerce Customer Order Status requires WooCommerce to be activated</strong></p>';
    echo '</div>';
}