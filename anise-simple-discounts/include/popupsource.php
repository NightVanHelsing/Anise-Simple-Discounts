<?php
if (!defined('ABSPATH')) {
    exit;
}
function asd_popupScriptStyle(string $hook_suffix) {
    if ($hook_suffix != 'plugins.php') {
        return;
    }
    wp_enqueue_style('asd_popup',ASD_PLUGIN_URL.'assets/popupstyle.css',array(),"1.1.0");
    wp_enqueue_script('asd_popup',ASD_PLUGIN_URL.'assets/popup.js',array(),"1.1.0",array("in_footer" => true));
    wp_localize_script('asd_popup','asd_ajax',array('nonce' => wp_create_nonce('asd_deleteMeta'),'ajaxurl' => admin_url('admin-ajax.php')));
}
function asd_handleFetch() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error(__('You do not have permission to perform this action.','anise-simple-discounts'));
    }
    check_ajax_referer('asd_deleteMeta','nonce',true);
    delete_metadata('user',0,'asd_discount_percentage','',true);
    wp_send_json_success();
}
function asd_popupHTML() {
    global $pagenow;
    if ($pagenow != "plugins.php") {
        return;
    }
    ?>
    <div class="asd_popup" style="display:none">
        <div class="asd_container">
            <h3><?php esc_html_e('Before you disable', 'anise-simple-discounts'); ?></h3>
            <p><?php esc_html_e('You have an option to either keep your data concerning discounts you assigned or delete it. You can also cancel if you want to go back.', 'anise-simple-discounts'); ?></p>
            <div class="asd_buttons">
                <a id="asd_disable"><?php esc_html_e('Disable', 'anise-simple-discounts'); ?></a>
                <a id="asd_delData"><?php esc_html_e('Disable with data deletion', 'anise-simple-discounts'); ?></a>
                <a id="asd_cancel"><?php esc_html_e('Cancel', 'anise-simple-discounts'); ?></a>
            </div>
        </div>
    </div>
    <?php
}
add_action('admin_footer','asd_popupHTML');
add_action('admin_enqueue_scripts','asd_popupScriptStyle');
add_action('wp_ajax_asd_deleteMeta','asd_handleFetch'); 
