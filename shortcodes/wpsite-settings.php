<?php
/**
 * Settings shortcodes
 *
 * @package WPSite_Shortcode
 * @since 1.0
 * @author WPSite.cn
 * @license GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Site URL Shortcode: [wpsite_url]
 *
 * @return string Site URL without protocol.
 */
function wpsite_shortcode_siteurl() {
	$site_url = get_site_url();
	$site_url = preg_replace( '#^https?://#', '', $site_url );
	return esc_html( $site_url );
}
add_shortcode( 'wpsite_url', 'wpsite_shortcode_siteurl' );

/**
 * Site Home Shortcode: [wpsite_home]
 *
 * @return string Home URL without protocol.
 */
function wpsite_shortcode_home() {
	$home_url = get_home_url();
	$home_url = preg_replace( '#^https?://#', '', $home_url );
	return esc_html( $home_url );
}
add_shortcode( 'wpsite_home', 'wpsite_shortcode_home' );

/**
 * Site Title Shortcode: [wpsite_title]
 *
 * @return string Site title.
 */
function wpsite_shortcode_site_title() {
	return esc_html( get_bloginfo( 'name' ) );
}
add_shortcode( 'wpsite_title', 'wpsite_shortcode_site_title' );

/**
 * Tagline Shortcode: [wpsite_tagline]
 *
 * @return string Site tagline.
 */
function wpsite_shortcode_tagline() {
	return esc_html( get_bloginfo( 'description' ) );
}
add_shortcode( 'wpsite_tagline', 'wpsite_shortcode_tagline' );

/**
 * Administration Email Address Shortcode: [wpsite_email]
 *
 * @return string Admin email.
 */
function wpsite_shortcode_admin_email() {
	return sanitize_email( get_option( 'admin_email' ) );
}
add_shortcode( 'wpsite_email', 'wpsite_shortcode_admin_email' );

/**
 * Date Format Shortcode: [wpsite_date]
 *
 * @return string Current date formatted according to site settings.
 */
function wpsite_shortcode_date() {
	return esc_html( date_i18n( get_option( 'date_format' ) ) );
}
add_shortcode( 'wpsite_date', 'wpsite_shortcode_date' );

/**
 * Time Format Shortcode: [wpsite_time]
 *
 * @return string Current time formatted according to site settings.
 */
function wpsite_shortcode_time() {
	return esc_html( date_i18n( get_option( 'time_format' ) ) );
}
add_shortcode( 'wpsite_time', 'wpsite_shortcode_time' );
