<?php
/**
 * Date Shortcodes
 *
 * Provides shortcodes for displaying dates with custom formatting and offsets.
 *
 * @package WPSite_Shortcode
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Year Shortcode: [wpsite_y format="" offset=""]
 *
 * Displays the current year or an offset year with custom formatting.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $format Date format (y or Y). Default 'Y'.
 *     @type int    $offset Year offset (-100 to 100). Default 0.
 * }
 * @return string Formatted year string.
 */
function wpsite_shortcode_year( $atts ) {
	$atts = shortcode_atts(
		array(
			'format' => 'Y',
			'offset' => '0',
		),
		$atts,
		'wpsite_y'
	);

	// Validate format.
	$valid_formats = array( 'y', 'Y' );
	if ( ! in_array( $atts['format'], $valid_formats, true ) ) {
		return esc_html(
			sprintf(
				/* translators: %s: Invalid format value */
				__( '%s is not a valid year format!', 'wpsite-shortcode' ),
				$atts['format']
			)
		);
	}

	// Validate and sanitize offset.
	$offset = intval( $atts['offset'] );
	if ( $offset < -100 || $offset > 100 ) {
		return esc_html__( 'Year offset must be between -100 and 100', 'wpsite-shortcode' );
	}

	// Build date string safely using sprintf.
	$date_string = sprintf( '+%d years', $offset );
	$timestamp   = strtotime( $date_string );

	if ( false === $timestamp ) {
		return esc_html__( 'Invalid date calculation', 'wpsite-shortcode' );
	}

	return esc_html( date_i18n( $atts['format'], $timestamp ) );
}
add_shortcode( 'wpsite_y', 'wpsite_shortcode_year' );

/**
 * Month Shortcode: [wpsite_m format="" offset=""]
 *
 * Displays the current month or an offset month with custom formatting.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $format Date format (F, m, M, n). Default 'F'.
 *     @type int    $offset Month offset (-1200 to 1200). Default 0.
 * }
 * @return string Formatted month string.
 */
function wpsite_shortcode_month( $atts ) {
	$atts = shortcode_atts(
		array(
			'format' => 'F',
			'offset' => '0',
		),
		$atts,
		'wpsite_m'
	);

	// Validate format.
	$valid_formats = array( 'F', 'm', 'M', 'n' );
	if ( ! in_array( $atts['format'], $valid_formats, true ) ) {
		return esc_html(
			sprintf(
				/* translators: %s: Invalid format value */
				__( '%s is not a valid month format!', 'wpsite-shortcode' ),
				$atts['format']
			)
		);
	}

	// Validate and sanitize offset.
	$offset = intval( $atts['offset'] );
	if ( $offset < -1200 || $offset > 1200 ) {
		return esc_html__( 'Month offset must be between -1200 and 1200', 'wpsite-shortcode' );
	}

	// Build date string safely using sprintf.
	$date_string = sprintf( '+%d months', $offset );
	$timestamp   = strtotime( $date_string );

	if ( false === $timestamp ) {
		return esc_html__( 'Invalid date calculation', 'wpsite-shortcode' );
	}

	return esc_html( date_i18n( $atts['format'], $timestamp ) );
}
add_shortcode( 'wpsite_m', 'wpsite_shortcode_month' );

/**
 * Day Shortcode: [wpsite_d format="" offset=""]
 *
 * Displays the current day or an offset day with custom formatting.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $format Date format (d, D, j, N, S, w, z, t). Default 'd'.
 *     @type int    $offset Day offset (-36500 to 36500). Default 0.
 * }
 * @return string Formatted day string.
 */
function wpsite_shortcode_day( $atts ) {
	$atts = shortcode_atts(
		array(
			'format' => 'd',
			'offset' => '0',
		),
		$atts,
		'wpsite_d'
	);

	// Validate format.
	$valid_formats = array( 'd', 'D', 'j', 'N', 'S', 'w', 'z', 't' );
	if ( ! in_array( $atts['format'], $valid_formats, true ) ) {
		return esc_html(
			sprintf(
				/* translators: %s: Invalid format value */
				__( '%s is not a valid day format!', 'wpsite-shortcode' ),
				$atts['format']
			)
		);
	}

	// Validate and sanitize offset.
	$offset = intval( $atts['offset'] );
	if ( $offset < -36500 || $offset > 36500 ) {
		return esc_html__( 'Day offset must be between -36500 and 36500', 'wpsite-shortcode' );
	}

	// Build date string safely using sprintf.
	$date_string = sprintf( '+%d days', $offset );
	$timestamp   = strtotime( $date_string );

	if ( false === $timestamp ) {
		return esc_html__( 'Invalid date calculation', 'wpsite-shortcode' );
	}

	return esc_html( date_i18n( $atts['format'], $timestamp ) );
}
add_shortcode( 'wpsite_d', 'wpsite_shortcode_day' );
