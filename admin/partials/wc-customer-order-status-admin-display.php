<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://purvik.me
 * @since      1.0.0
 *
 * @package    Wc_Customer_Order_Status
 * @subpackage Wc_Customer_Order_Status/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2>Woocommerce Order Status</h2>

    <form method="post" action="options.php">        
        <?php settings_fields( 'wcprev_setting' ); ?>
        <?php do_settings_sections( 'wcprev_setting' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">List Of Status</th>
                <td>
                    <?php
                    $status_array = wc_order_status();                    
                    $status = wc_selected_status_array();
                    
                    foreach ($status_array as $key => $value) {
                        echo '<input type="checkbox" name="wcprev_status[]" id="'.$key.'" value="'.$key.'"', in_array($key, $status) ? ' checked="checked"' : '', '/>';                        
                        echo '<label for="'.$key.'">'.$value.'</label>';
                        echo '<br>';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>