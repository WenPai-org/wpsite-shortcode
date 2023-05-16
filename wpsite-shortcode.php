<?php
/**
 * Plugin Name: WPSite Shortcode
 * Plugin URI: https://wpsite.cn/shortcode
 * Description: A collection of metadata shortcodes for easy use of WordPress sites,It can also usually be used as a wildcard for SEO.
 * Author: WPSite.cn
 * Author URI: https://wpsite.cn/
 * Text Domain: wpsite-shortcode
 * Domain Path: /languages
 * Version: 1.1
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * WPSite Shortcode is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPSite Shortcodeis distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}


require_once( plugin_dir_path( __FILE__ ) . 'includes/settings-page.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-settings.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-users.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-widgets.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-post.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-media.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/wpsite-date.php' );


// Enqueue the plugin CSS stylesheet.
function wpsite_shortcode_enqueue_scripts() {
  // Enqueue the plugin CSS stylesheet.
  $css_dir = plugin_dir_url( __FILE__ ) . 'assets/css/';
  wp_enqueue_style( 'wpsite-shortcode-settings', $css_dir . 'style.css', array(), '1.0.0', 'all' );

}
add_action( 'admin_enqueue_scripts', 'wpsite_shortcode_enqueue_scripts' );


// Load translation
add_action( 'init', 'wpsite_load_textdomain' );
function wpsite_load_textdomain() {
	load_plugin_textdomain( 'wpsite-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}


// Add a menu item for the plugin settings page.
function wpsite_shortcode_add_settings_page() {
  add_submenu_page(
    'tools.php',
    __('WPSite Shortcode Settings', 'wpsite-shortcode'),
    __('Site Shortcode', 'wpsite-shortcode'),
    'manage_options',
    'wpsite-shortcode-settings',
    'wpsite_shortcode_render_settings_page'
  );
}
add_action( 'admin_menu', 'wpsite_shortcode_add_settings_page' );
