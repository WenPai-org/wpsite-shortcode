<?php
/*
Includes shortocde
Since: 1.0
Author: WPSite.cn
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Year Shortcode: [wpsite_year format="" offset=""]
function wpsite_shortcode_year( $atts ) {
    $atts = shortcode_atts(
        array(
            'format' => 'Y',
            'offset' => '0',
        ), $atts, 'y' );
    $valid_formats = array( 'y', 'Y' );
    if ( in_array( $atts['format'], $valid_formats ) ) {
        return date_i18n( $atts['format'], strtotime( '+' . $atts['offset'] . ' years' ) );
    } else {
        return $atts['format'] . ' is not a valid year format!';
    }
}
add_shortcode( 'wpsite_y', 'wpsite_shortcode_year' );

// Month Shortcode: [wpsite_month format="" offset=""]
function wpsite_shortcode_month( $atts ) {
    $atts = shortcode_atts(
        array(
            'format' => 'F',
            'offset' => '0',
        ), $atts, 'm' );
    $valid_formats = array( 'F', 'm', 'M', 'n' );
    if ( in_array( $atts['format'], $valid_formats ) ) {
        return date_i18n( $atts['format'], strtotime( '+' . $atts['offset'] . ' months' ) );
    } else {
        return $atts['format'] . ' is not a valid month format!';
    }
}
add_shortcode( 'wpsite_m', 'wpsite_shortcode_month' );

// Day Shortcode: [wpsite_day format="" offset=""]
function wpsite_shortcode_day( $atts ) {
    $atts = shortcode_atts(
        array(
            'format' => 'd',
            'offset' => '0',
        ), $atts, 'd' );
    $valid_formats = array( 'd', 'D', 'j', 'N', 'S', 'w', 'z', 't' );
    if ( in_array( $atts['format'], $valid_formats ) ) {
        return date_i18n( $atts['format'], strtotime( '+' . $atts['offset'] . ' days' ) );
    } else {
        return $atts['format'] . ' is not a valid day format!';
    }
}
add_shortcode( 'wpsite_d', 'wpsite_shortcode_day' );


// Copyright Shortcode: [wpsite_c]
function wpsite_shortcode_copy() {
    return '©';
}
add_shortcode( 'wpsite_c', 'wpsite_shortcode_copy' );

// Registered Trademark Shortcode: [wpsite_r]
function wpsite_shortcode_registered_trademark() {
    return '®';
}
add_shortcode( 'wpsite_r', 'wpsite_shortcode_registered_trademark' );

// Trademark Shortcode: [wpsite_tm]
function wpsite_shortcode_trademark() {
    return '™';
}
add_shortcode( 'wpsite_tm', 'wpsite_shortcode_trademark' );

// Service Mark Trademark Shortcode: [wpsite_sm]
function wpsite_shortcode_servicemark_trademark() {
    return '℠';
}
add_shortcode( 'wpsite_sm', 'wpsite_shortcode_servicemark_trademark' );
