<?php
/**
 * Character Shortcodes
 *
 * Provides shortcodes for displaying special characters and symbols.
 *
 * @package WPSite_Shortcode
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Copyright Symbol Shortcode: [wpsite_c]
 *
 * Displays the copyright symbol ©.
 *
 * @return string Copyright symbol.
 */
function wpsite_shortcode_copy() {
	return '©';
}
add_shortcode( 'wpsite_c', 'wpsite_shortcode_copy' );

/**
 * Copyright Text Shortcode: [wpsite_cr]
 *
 * Displays the word "Copyright" in the current language.
 *
 * @return string Translated "Copyright" text.
 */
function wpsite_shortcode_copylong() {
	return esc_html__( 'Copyright', 'wpsite-shortcode' );
}
add_shortcode( 'wpsite_cr', 'wpsite_shortcode_copylong' );

/**
 * Registered Trademark Shortcode: [wpsite_r]
 *
 * Displays the registered trademark symbol ®.
 *
 * @return string Registered trademark symbol.
 */
function wpsite_shortcode_registered_trademark() {
	return '®';
}
add_shortcode( 'wpsite_r', 'wpsite_shortcode_registered_trademark' );

/**
 * Trademark Shortcode: [wpsite_tm]
 *
 * Displays the trademark symbol ™.
 *
 * @return string Trademark symbol.
 */
function wpsite_shortcode_trademark() {
	return '™';
}
add_shortcode( 'wpsite_tm', 'wpsite_shortcode_trademark' );

/**
 * Service Mark Shortcode: [wpsite_sm]
 *
 * Displays the service mark symbol ℠.
 *
 * @return string Service mark symbol.
 */
function wpsite_shortcode_servicemark() {
	return '℠';
}
add_shortcode( 'wpsite_sm', 'wpsite_shortcode_servicemark' );
