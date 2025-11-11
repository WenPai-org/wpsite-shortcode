<?php
/**
 * Widget Shortcodes
 *
 * Provides shortcodes for displaying WordPress widgets.
 *
 * @package WPSite_Shortcode
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Search Widget Shortcode: [wpsite_search]
 *
 * Displays the search form widget.
 *
 * @return string Search form HTML.
 */
function wpsite_shortcode_search_form( $atts ) {
	$form = get_search_form( false );

	return $form ? $form : '';
}
add_shortcode( 'wpsite_search', 'wpsite_shortcode_search_form' );

/**
 * Calendar Widget Shortcode: [wpsite_calendar]
 *
 * Displays the calendar widget.
 *
 * @param array $atts Shortcode attributes (unused).
 * @return string Calendar HTML.
 */
function wpsite_shortcode_calendar( $atts ) {
	$calendar = get_calendar( false );

	return $calendar ? $calendar : '';
}
add_shortcode( 'wpsite_calendar', 'wpsite_shortcode_calendar' );

/**
 * Tags Widget Shortcode: [wpsite_tags]
 *
 * Displays the post tags list.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before    Text before the tag list. Default empty.
 *     @type string $after     Text after the tag list. Default empty.
 *     @type string $separator Tag separator. Default ', '.
 * }
 * @return string Tag list HTML.
 */
function wpsite_shortcode_tags( $atts ) {
	$atts = shortcode_atts(
		array(
			'before'    => '',
			'after'     => '',
			'separator' => ', ',
		),
		$atts,
		'wpsite_tags'
	);

	$tags = get_the_tag_list( $atts['before'], $atts['separator'], $atts['after'] );

	return $tags ? wp_kses_post( $tags ) : '';
}
add_shortcode( 'wpsite_tags', 'wpsite_shortcode_tags' );

/**
 * Recent Posts Widget Shortcode: [wpsite_recentposts]
 *
 * Displays the recent posts widget.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type int $number Number of posts to display. Default 5.
 * }
 * @return string Recent posts widget HTML.
 */
function wpsite_shortcode_recent_posts( $atts ) {
	$atts = shortcode_atts(
		array(
			'number' => 5,
		),
		$atts,
		'wpsite_recentposts'
	);

	// Validate and sanitize number.
	$number = absint( $atts['number'] );
	if ( $number < 1 || $number > 50 ) {
		$number = 5;
	}

	ob_start();
	the_widget( 'WP_Widget_Recent_Posts', array( 'number' => $number ) );
	$output = ob_get_clean();

	return $output ? $output : '';
}
add_shortcode( 'wpsite_recentposts', 'wpsite_shortcode_recent_posts' );

/**
 * Recent Comments Widget Shortcode: [wpsite_recentcomments]
 *
 * Displays the recent comments widget.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type int $number Number of comments to display. Default 5.
 * }
 * @return string Recent comments widget HTML.
 */
function wpsite_shortcode_recent_comments( $atts ) {
	$atts = shortcode_atts(
		array(
			'number' => 5,
		),
		$atts,
		'wpsite_recentcomments'
	);

	// Validate and sanitize number.
	$number = absint( $atts['number'] );
	if ( $number < 1 || $number > 50 ) {
		$number = 5;
	}

	ob_start();
	the_widget( 'WP_Widget_Recent_Comments', array( 'number' => $number ) );
	$output = ob_get_clean();

	return $output ? $output : '';
}
add_shortcode( 'wpsite_recentcomments', 'wpsite_shortcode_recent_comments' );
