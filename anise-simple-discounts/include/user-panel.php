<?php
if (!defined('ABSPATH')) {
    exit;
}
function asd_showDiscountField(WP_User $user) {
    ?>
    <h2><?php esc_html_e("Customer discounts",'anise-simple-discounts') ?></h2>
	<table class="form-table">
		<tr>
			<th>
				<label for="asd_user_discount"><?php esc_html_e('Permanent discount','anise-simple-discounts'); ?></label>
			</th>
			<td>
				<input type="number" inputmode="numeric" min="0" max="99" step="1" name="asd_user_discount_form" id="asd_user_discount" value="<?php echo esc_attr( get_user_meta($user->ID,'asd_discount_percentage',true)); ?>" class="regular-text" />
				<br><p class="description"><?php esc_html_e('Percentage discount','anise-simple-discounts'); ?></p>
			</td>
		</tr>
	</table>
<?php
wp_nonce_field('asd_save_discount','asd_discount_nonce');
}

function asd_validateForm(WP_Error $errors,bool $update, stdClass $user) {
	if (!current_user_can('edit_user',$user->ID)) {
		return;
	}
	check_admin_referer('asd_save_discount','asd_discount_nonce');
	$valueFromForm = sanitize_text_field(wp_unslash($_POST['asd_user_discount_form']  ?? ""));
	if (trim($valueFromForm) === "") {
		delete_user_meta($user->ID,'asd_discount_percentage');
        return;
    }
	if (!ctype_digit($valueFromForm)) {
		$errors->add('asd_num_error',__('Discount field must be a natural number.','anise-simple-discounts'));
		return;
	}
	$valueFromForm = (int) $valueFromForm;
	if ($valueFromForm >= 100 || $valueFromForm <= 0) {
		$errors->add('asd_range_error',__('Discount must be between 1 and 99.','anise-simple-discounts'));
		return;
	}
	if (!$errors->has_errors()) {
		update_user_meta($user->ID,'asd_discount_percentage',$valueFromForm);
	}
}
add_action('edit_user_profile','asd_showDiscountField');
add_action('user_profile_update_errors', 'asd_validateForm',10,3);