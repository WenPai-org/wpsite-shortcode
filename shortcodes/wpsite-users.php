<?php
/*
Includes shortocdes
Since: 1.0
Author: WPSite.cn
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


//User Name Shortcode:[wpsite_username]
function wpsite_shortcode_user_name( $atts ) {
  $atts = shortcode_atts( array(
    'before' => '',
    'after' => '',
  ), $atts );

  $current_user = wp_get_current_user();
  $user_name = $current_user->display_name;

  return $atts['before'] . $user_name . $atts['after'];
}
add_shortcode( 'wpsite_username', 'wpsite_shortcode_user_name' );


//Nick Name Shortcode:[wpsite_nickname]
function wpsite_user_nickname_shortcode() {
    $user_nickname = get_the_author_meta( 'nickname' );
    return $user_nickname;
}
add_shortcode( 'wpsite_nickname', 'wpsite_user_nickname_shortcode' );


//User Bio Shortcode:[wpsite_userbio]
function wpsite_user_bio_shortcode() {
    $user_bio = get_the_author_meta( 'description' );
    return $user_bio;
}
add_shortcode( 'wpsite_userbio', 'wpsite_user_bio_shortcode' );


// User Website Shortcode: [wpsite_website]
function wpsite_user_website_shortcode() {
    $user_website = get_the_author_meta( 'user_url' );
    $parsed_website = parse_url($user_website);
    $display_website = preg_replace('/^(www\.)/i', '', $parsed_website['host']);
        if (!empty($display_website)) {
        return '<a href="' . esc_url($user_website) . '" target="_blank">' . esc_html($display_website) . '</a>';
    }
    return '';
}
add_shortcode( 'wpsite_website', 'wpsite_user_website_shortcode' );



//User EMail Shortcode:[wpsite_useremail]
function wpsite_shortcode_user_email( $atts ) {
  $atts = shortcode_atts( array(
    'before' => '',
    'after' => '',
  ), $atts );

  $user = wp_get_current_user();
  $user_email = $user->user_email;

  return $atts['before'] . $user_email . $atts['after'];
}
add_shortcode( 'wpsite_useremail', 'wpsite_shortcode_user_email' );


//User Avatar Shortcode:[wpsite_avatar]
function wpsite_shortcode_user_avatar( $atts ) {
  $atts = shortcode_atts( array(
    'size' => 96,
    'class' => '',
    'alt' => '',
  ), $atts );

  $user_avatar = get_avatar( get_current_user_id(), $atts['size'], '', '', array(
    'class' => $atts['class'],
    'alt' => $atts['alt'],
  ) );

  return $user_avatar;
}
add_shortcode( 'wpsite_avatar', 'wpsite_shortcode_user_avatar' );


//User Role Shortcode:[wpsite_userrole]
function wpsite_shortcode_user_role( $atts ) {
  $atts = shortcode_atts( array(
    'before' => '',
    'after' => '',
  ), $atts );

  $user_roles = wp_get_current_user()->roles;
  $user_role = reset($user_roles); // get first user role

  return $atts['before'] . $user_role . $atts['after'];
}
add_shortcode( 'wpsite_userrole', 'wpsite_shortcode_user_role' );


//User Registered Date:[wpsite_userdate]
function wpsite_shortcode_user_reg_date( $atts ) {
  $atts = shortcode_atts( array(
    'before' => '',
    'after' => '',
    'format' => get_option( 'date_format' ),
  ), $atts );

  $user_reg_date = get_the_author_meta( 'user_registered', get_current_user_id() );
  $user_reg_date = date_i18n( $atts['format'], strtotime( $user_reg_date ) );

  return $atts['before'] . $user_reg_date . $atts['after'];
}
add_shortcode( 'wpsite_userdate', 'wpsite_shortcode_user_reg_date' );


 //User Last Login:[wpsite_lastlogin]
function wpsite_shortcode_user_last_login( $atts ) {
  $atts = shortcode_atts( array(
    'before' => '',
    'after' => '',
    'format' => get_option( 'date_format' ),
  ), $atts );

  $user_last_login = get_the_author_meta( 'last_login', get_current_user_id() );
  if ( ! empty( $user_last_login ) ) {
    $user_last_login = date_i18n( $atts['format'], strtotime( $user_last_login ) );
  } else {
    $user_last_login = __( 'Never', 'wpsite-shortcode' );
  }

  return $atts['before'] . $user_last_login . $atts['after'];
}
add_shortcode( 'wpsite_lastlogin', 'wpsite_shortcode_user_last_login' );
