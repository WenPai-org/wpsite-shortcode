<?php
/**
 * User shortcodes
 *
 * @package WPSite_Shortcode
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * User Name Shortcode: [wpsite_username]
 *
 * @param array $atts Shortcode attributes.
 * @return string User display name.
 */
function wpsite_shortcode_user_name( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	$user_name    = $current_user->display_name;

	return esc_html( $atts['before'] ) . esc_html( $user_name ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_username', 'wpsite_shortcode_user_name' );

/**
 * User Login Shortcode: [wpsite_userlogin]
 *
 * @return string User login name.
 */
function wpsite_user_login_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	return esc_html( $current_user->user_login );
}
add_shortcode( 'wpsite_userlogin', 'wpsite_user_login_shortcode' );

/**
 * Nickname Shortcode: [wpsite_nickname]
 *
 * @return string User nickname.
 */
function wpsite_user_nickname_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	return esc_html( $current_user->nickname );
}
add_shortcode( 'wpsite_nickname', 'wpsite_user_nickname_shortcode' );

/**
 * User Bio Shortcode: [wpsite_userbio]
 *
 * @return string User bio/description.
 */
function wpsite_user_bio_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	return wp_kses_post( $current_user->description );
}
add_shortcode( 'wpsite_userbio', 'wpsite_user_bio_shortcode' );

/**
 * User Website Shortcode: [wpsite_website]
 *
 * @return string User website URL.
 */
function wpsite_user_website_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	return esc_url( $current_user->user_url );
}
add_shortcode( 'wpsite_website', 'wpsite_user_website_shortcode' );

/**
 * User Email Shortcode: [wpsite_useremail]
 *
 * @param array $atts Shortcode attributes.
 * @return string User email.
 */
function wpsite_shortcode_user_email( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	$user       = wp_get_current_user();
	$user_email = sanitize_email( $user->user_email );

	return esc_html( $atts['before'] ) . esc_html( $user_email ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_useremail', 'wpsite_shortcode_user_email' );

/**
 * User Avatar Shortcode: [wpsite_avatar]
 *
 * @param array $atts Shortcode attributes.
 * @return string User avatar HTML.
 */
function wpsite_shortcode_user_avatar( $atts ) {
	$atts = shortcode_atts(
		array(
			'size'  => 256,
			'class' => '',
			'alt'   => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	// Sanitize attributes.
	$size  = absint( $atts['size'] );
	$class = sanitize_html_class( $atts['class'] );
	$alt   = sanitize_text_field( $atts['alt'] );

	$user_avatar = get_avatar(
		get_current_user_id(),
		$size,
		'',
		$alt,
		array(
			'class' => $class,
		)
	);

	return $user_avatar;
}
add_shortcode( 'wpsite_avatar', 'wpsite_shortcode_user_avatar' );

/**
 * User Role Shortcode: [wpsite_userrole]
 *
 * @param array $atts Shortcode attributes.
 * @return string User role slug.
 */
function wpsite_shortcode_user_role( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	$user       = wp_get_current_user();
	$user_roles = $user->roles;
	$user_role  = ! empty( $user_roles ) ? reset( $user_roles ) : '';

	return esc_html( $atts['before'] ) . esc_html( $user_role ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_userrole', 'wpsite_shortcode_user_role' );

/**
 * User Role Name Shortcode: [wpsite_role]
 *
 * @param array $atts Shortcode attributes.
 * @return string Translated user role name.
 */
function wpsite_shortcode_role( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	$user       = wp_get_current_user();
	$user_roles = $user->roles;
	$user_role  = ! empty( $user_roles ) ? reset( $user_roles ) : '';

	$role_name = '';

	$role_map = array(
		'administrator' => __( 'Administrator', 'wpsite-shortcode' ),
		'editor'        => __( 'Editor', 'wpsite-shortcode' ),
		'author'        => __( 'Author', 'wpsite-shortcode' ),
		'contributor'   => __( 'Contributor', 'wpsite-shortcode' ),
		'subscriber'    => __( 'Subscriber', 'wpsite-shortcode' ),
	);

	if ( array_key_exists( $user_role, $role_map ) ) {
		$role_name = $role_map[ $user_role ];
	}

	return esc_html( $atts['before'] ) . esc_html( $role_name ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_role', 'wpsite_shortcode_role' );

/**
 * User Registered Date: [wpsite_userdate]
 *
 * @param array $atts Shortcode attributes.
 * @return string User registration date.
 */
function wpsite_shortcode_user_reg_date( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
			'format' => get_option( 'date_format' ),
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user  = wp_get_current_user();
	$user_reg_date = $current_user->user_registered;
	$user_reg_date = date_i18n( sanitize_text_field( $atts['format'] ), strtotime( $user_reg_date ) );

	return esc_html( $atts['before'] ) . esc_html( $user_reg_date ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_userdate', 'wpsite_shortcode_user_reg_date' );

/**
 * Track user last login time.
 *
 * @param string  $user_login User login name.
 * @param WP_User $user User object.
 * @return void
 */
function wpsite_user_last_login( $user_login, $user ) {
	update_user_meta( $user->ID, 'last_login', time() );
}
add_action( 'wp_login', 'wpsite_user_last_login', 10, 2 );

/**
 * User Last Login Shortcode: [wpsite_lastlogin]
 *
 * @return string Time since last login or 'Never'.
 */
function wpsite_shortcode_user_lastlogin() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$current_user = wp_get_current_user();
	$user_id      = $current_user->ID;
	$last_login   = get_user_meta( $user_id, 'last_login', true );

	if ( ! $last_login ) {
		return esc_html__( 'Never', 'wpsite-shortcode' );
	}

	$the_login_date = human_time_diff( absint( $last_login ) );
	return esc_html( $the_login_date );
}
add_shortcode( 'wpsite_lastlogin', 'wpsite_shortcode_user_lastlogin' );
