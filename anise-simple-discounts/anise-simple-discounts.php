<?php
/*
 * Plugin Name: Anise Simple Discounts
 * Text Domain: anise-simple-discounts
 * Domain Path: /languages
 * Author: Michał Adamek
 * Author URI: https://github.com/NightVanHelsing
 * Version: 1.0.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins: woocommerce
 * Plugin URI: https://github.com/NightVanHelsing/Anise-Simple-Discounts
 * Description: Percentage discounts for specific customers.
 */
if (!defined('ABSPATH')){
	exit;
}
require_once __DIR__.'/include/discounts.php';  
require_once __DIR__.'/include/user-panel.php';