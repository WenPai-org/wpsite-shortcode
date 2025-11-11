<?php
/**
 * Plugin Name: WPSite Shortcode
 * Plugin URI: https://wpsite.cn/shortcode
 * Description: A collection of metadata shortcodes for easy use of WordPress sites,It can also usually be used as a wildcard for SEO.
 * Author: WPSite.cn
 * Author URI: https://wpsite.cn/
 * Text Domain: wpsite-shortcode
 * Domain Path: /languages
 * Version: 1.2.1
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
	exit; // Exit if accessed directly.
}

// Define plugin constants.
if ( ! defined( 'WPSITE_SHORTCODE_VERSION' ) ) {
	define( 'WPSITE_SHORTCODE_VERSION', '1.2.1' );
}
if ( ! defined( 'WPSITE_SHORTCODE_PLUGIN_DIR' ) ) {
	define( 'WPSITE_SHORTCODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WPSITE_SHORTCODE_PLUGIN_URL' ) ) {
	define( 'WPSITE_SHORTCODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'WPSITE_SHORTCODE_PLUGIN_FILE' ) ) {
	define( 'WPSITE_SHORTCODE_PLUGIN_FILE', __FILE__ );
}

// Require plugin files.
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'includes/settings-page.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-settings.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-users.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-widgets.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-post.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-media.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-date.php';
require_once WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/wpsite-characters.php';

/**
 * Enqueue admin styles.
 *
 * @param string $hook_suffix The current admin page hook suffix.
 */
function wpsite_shortcode_enqueue_scripts( $hook_suffix ) {
	// Only load on our settings page.
	if ( 'tools_page_wpsite-shortcode-settings' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'wpsite-shortcode-settings',
		WPSITE_SHORTCODE_PLUGIN_URL . 'assets/css/style.css',
		array(),
		WPSITE_SHORTCODE_VERSION,
		'all'
	);
}
add_action( 'admin_enqueue_scripts', 'wpsite_shortcode_enqueue_scripts' );

/**
 * Enqueue toggle script.
 *
 * @param string $hook_suffix The current admin page hook suffix.
 */
function wpsite_shortcode_add_toggle_script( $hook_suffix ) {
	// Only load on our settings page.
	if ( 'tools_page_wpsite-shortcode-settings' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_script(
		'wpsite-toggle-script',
		WPSITE_SHORTCODE_PLUGIN_URL . 'assets/js/toggle.js',
		array( 'jquery' ),
		WPSITE_SHORTCODE_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'wpsite_shortcode_add_toggle_script' );

/**
 * Load plugin text domain for translations.
 */
function wpsite_load_textdomain() {
	load_plugin_textdomain(
		'wpsite-shortcode',
		false,
		dirname( plugin_basename( WPSITE_SHORTCODE_PLUGIN_FILE ) ) . '/languages'
	);
}
add_action( 'init', 'wpsite_load_textdomain' );

/**
 * Add settings page to Tools menu.
 */
function wpsite_shortcode_add_settings_page() {
	add_submenu_page(
		'tools.php',
		__( 'WPSite Shortcode Settings', 'wpsite-shortcode' ),
		__( 'Site Shortcode', 'wpsite-shortcode' ),
		'manage_options',
		'wpsite-shortcode-settings',
		'wpsite_shortcode_render_settings_page'
	);
}
add_action( 'admin_menu', 'wpsite_shortcode_add_settings_page' );

/**
 * Count total shortcodes in the plugin.
 *
 * @return int Number of shortcodes registered.
 */
function wpsite_shortcode_count() {
	$count          = 0;
	$shortcodes_dir = WPSITE_SHORTCODE_PLUGIN_DIR . 'shortcodes/';

	if ( ! is_dir( $shortcodes_dir ) ) {
		return $count;
	}

	$files = scandir( $shortcodes_dir );
	if ( ! $files ) {
		return $count;
	}

	foreach ( $files as $file ) {
		if ( substr( $file, -4 ) === '.php' ) {
			$file_path = $shortcodes_dir . $file;
			if ( ! is_readable( $file_path ) ) {
				continue;
			}

			$content = file_get_contents( $file_path );
			if ( false === $content ) {
				continue;
			}

			preg_match_all( '/add_shortcode\(\s?[\'"]wpsite_(.*?)\s?[\'"]/', $content, $matches );
			$count += count( $matches[0] );
		}
	}

	return $count;
}

/**
 * Add Settings link to plugin list.
 *
 * @param array $links Existing plugin action links.
 * @return array Modified plugin action links.
 */
function wpsite_shortcode_add_settings_link( $links ) {
	$settings_link = sprintf(
		'<a href="%s">%s</a>',
		esc_url( admin_url( 'tools.php?page=wpsite-shortcode-settings' ) ),
		esc_html__( 'Settings', 'wpsite-shortcode' )
	);

	array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( WPSITE_SHORTCODE_PLUGIN_FILE ), 'wpsite_shortcode_add_settings_link' );
