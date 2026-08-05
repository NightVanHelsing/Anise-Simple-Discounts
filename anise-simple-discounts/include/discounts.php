<?php
if (!defined('ABSPATH')) {
    exit;
}
add_action('woocommerce_cart_calculate_fees', 'asd_giveDiscount');
function asd_giveDiscount() {
    if (is_admin() && !defined('DOING_AJAX')) {
    return;
    }
    $asd_client_id = get_current_user_id();
    if (metadata_exists('user', $asd_client_id, 'asd_discount_percentage'))  {
    $asd_percentage = (int) get_user_meta($asd_client_id, 'asd_discount_percentage', true);
    if ($asd_percentage > 0 && $asd_percentage < 100) {
    $discount = (WC()->cart->cart_contents_total) * ($asd_percentage/100);	
	WC()->cart->add_fee(__('Permament discount','anise-simple-discounts'), -$discount);
        }
    }
}