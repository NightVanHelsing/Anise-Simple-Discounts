<?php
/*
 * Plugin Name: Anise Simple Discounts
 * Text Domain: anise-simple-discounts
 * Author: Michał Adamek
 * Author URI: https://github.com/NightVanHelsing
 * Version: 1.1.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins: woocommerce
 * Plugin URI: https://github.com/NightVanHelsing/Anise-Simple-Discounts
 * Description: Percentage discounts for specific customers.
 */
if (!defined('ABSPATH')){
	exit;
}
define('ASD_PLUGIN_URL',plugin_dir_url(__FILE__));
require_once __DIR__.'/include/discounts.php';  
require_once __DIR__.'/include/user-panel.php';
require_once __DIR__.'/include/popupsource.php';
