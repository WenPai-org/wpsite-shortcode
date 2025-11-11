<?php
/**
 * Media Shortcodes
 *
 * Provides shortcodes for displaying media library items.
 *
 * @package WPSite_Shortcode
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Show Images Shortcode: [wpsite_images]
 *
 * Displays images from the media library.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $orderby Order by parameter. Default 'date'.
 *     @type string $order   Sort order (ASC or DESC). Default 'DESC'.
 *     @type string $ids     Comma-separated image IDs. Default empty.
 *     @type int    $columns Number of columns. Default 3.
 * }
 * @return string HTML output of images gallery.
 */
function wpsite_shortcode_images( $atts ) {
	$atts = shortcode_atts(
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
			'ids'     => '',
			'columns' => 3,
		),
		$atts,
		'wpsite_images'
	);

	// Sanitize inputs.
	$orderby = sanitize_text_field( $atts['orderby'] );
	$order   = strtoupper( sanitize_text_field( $atts['order'] ) );
	$columns = absint( $atts['columns'] );

	// Validate order.
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	// Validate columns.
	if ( $columns < 1 || $columns > 12 ) {
		$columns = 3;
	}

	// Sanitize IDs.
	$ids = '';
	if ( ! empty( $atts['ids'] ) ) {
		$ids_array = array_map( 'absint', explode( ',', $atts['ids'] ) );
		$ids       = array_filter( $ids_array );
	}

	$images = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => $orderby,
			'order'          => $order,
			'include'        => $ids,
			'numberposts'    => -1,
		)
	);

	if ( ! $images ) {
		return '';
	}

	$output = '<div class="wpsite-gallery">';
	$i      = 0;

	foreach ( $images as $image ) {
		$i++;

		$output .= '<div class="wpsite-gallery-item">';
		$output .= wp_get_attachment_image( $image->ID, 'large' );
		$output .= '</div>';

		if ( $i % $columns === 0 ) {
			$output .= '<div class="wpsite-clearfix"></div>';
		}
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'wpsite_images', 'wpsite_shortcode_images' );

/**
 * Show Audio Shortcode: [wpsite_audio]
 *
 * Displays audio files from the media library.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $orderby Order by parameter. Default 'date'.
 *     @type string $order   Sort order (ASC or DESC). Default 'DESC'.
 *     @type string $ids     Comma-separated audio IDs. Default empty.
 *     @type int    $columns Number of columns. Default 3.
 * }
 * @return string HTML output of audio gallery.
 */
function wpsite_shortcode_audio( $atts ) {
	$atts = shortcode_atts(
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
			'ids'     => '',
			'columns' => 3,
		),
		$atts,
		'wpsite_audio'
	);

	// Sanitize inputs.
	$orderby = sanitize_text_field( $atts['orderby'] );
	$order   = strtoupper( sanitize_text_field( $atts['order'] ) );
	$columns = absint( $atts['columns'] );

	// Validate order.
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	// Validate columns.
	if ( $columns < 1 || $columns > 12 ) {
		$columns = 3;
	}

	// Sanitize IDs.
	$ids = '';
	if ( ! empty( $atts['ids'] ) ) {
		$ids_array = array_map( 'absint', explode( ',', $atts['ids'] ) );
		$ids       = array_filter( $ids_array );
	}

	$audio = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'orderby'        => $orderby,
			'order'          => $order,
			'include'        => $ids,
			'numberposts'    => -1,
		)
	);

	if ( ! $audio ) {
		return '';
	}

	$output = '<div class="wpsite-gallery">';
	$i      = 0;

	foreach ( $audio as $item ) {
		$i++;

		$url = wp_get_attachment_url( $item->ID );
		if ( ! $url ) {
			continue;
		}

		$output .= '<div class="wpsite-gallery-item">';
		$output .= wp_audio_shortcode( array( 'src' => esc_url( $url ) ) );
		$output .= '</div>';

		if ( $i % $columns === 0 ) {
			$output .= '<div class="wpsite-clearfix"></div>';
		}
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'wpsite_audio', 'wpsite_shortcode_audio' );

/**
 * Show Video Shortcode: [wpsite_video]
 *
 * Displays video files from the media library.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $orderby Order by parameter. Default 'date'.
 *     @type string $order   Sort order (ASC or DESC). Default 'DESC'.
 *     @type string $ids     Comma-separated video IDs. Default empty.
 *     @type int    $columns Number of columns. Default 3.
 * }
 * @return string HTML output of video gallery.
 */
function wpsite_shortcode_video( $atts ) {
	$atts = shortcode_atts(
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
			'ids'     => '',
			'columns' => 3,
		),
		$atts,
		'wpsite_video'
	);

	// Sanitize inputs.
	$orderby = sanitize_text_field( $atts['orderby'] );
	$order   = strtoupper( sanitize_text_field( $atts['order'] ) );
	$columns = absint( $atts['columns'] );

	// Validate order.
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	// Validate columns.
	if ( $columns < 1 || $columns > 12 ) {
		$columns = 3;
	}

	// Sanitize IDs.
	$ids = '';
	if ( ! empty( $atts['ids'] ) ) {
		$ids_array = array_map( 'absint', explode( ',', $atts['ids'] ) );
		$ids       = array_filter( $ids_array );
	}

	$videos = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'video',
			'orderby'        => $orderby,
			'order'          => $order,
			'include'        => $ids,
			'numberposts'    => -1,
		)
	);

	if ( ! $videos ) {
		return '';
	}

	$output = '<div class="wpsite-gallery">';
	$i      = 0;

	foreach ( $videos as $video ) {
		$i++;

		$url = wp_get_attachment_url( $video->ID );
		if ( ! $url ) {
			continue;
		}

		$column_width = number_format( 100 / $columns, 2 );
		$output      .= sprintf(
			'<div class="wpsite-gallery-item wpsite-video" style="flex-basis: calc(%s%% - 20px); margin: 10px;">',
			esc_attr( $column_width )
		);

		$output .= wp_video_shortcode(
			array(
				'src' => esc_url( $url ),
			)
		);

		$output .= '</div><!-- /.wpsite-gallery-item -->';

		if ( $i % $columns === 0 ) {
			$output .= '<div style="flex-basis: 100%;"></div>';
		}
	}

	$output .= '</div><!-- /.wpsite-gallery -->';

	return $output;
}
add_shortcode( 'wpsite_video', 'wpsite_shortcode_video' );

/**
 * Show Documents Shortcode: [wpsite_documents]
 *
 * Displays document files from the media library.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $orderby Order by parameter. Default 'date'.
 *     @type string $order   Sort order (ASC or DESC). Default 'DESC'.
 *     @type string $ids     Comma-separated document IDs. Default empty.
 *     @type int    $columns Number of columns. Default 3.
 * }
 * @return string HTML output of documents gallery.
 */
function wpsite_shortcode_documents( $atts ) {
	$atts = shortcode_atts(
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
			'ids'     => '',
			'columns' => 3,
		),
		$atts,
		'wpsite_documents'
	);

	// Sanitize inputs.
	$orderby = sanitize_text_field( $atts['orderby'] );
	$order   = strtoupper( sanitize_text_field( $atts['order'] ) );
	$columns = absint( $atts['columns'] );

	// Validate order.
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	// Validate columns.
	if ( $columns < 1 || $columns > 12 ) {
		$columns = 3;
	}

	// Sanitize IDs.
	$ids = '';
	if ( ! empty( $atts['ids'] ) ) {
		$ids_array = array_map( 'absint', explode( ',', $atts['ids'] ) );
		$ids       = array_filter( $ids_array );
	}

	$documents = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'application/pdf,application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/plain',
			'orderby'        => $orderby,
			'order'          => $order,
			'include'        => $ids,
			'numberposts'    => -1,
		)
	);

	if ( ! $documents ) {
		return '';
	}

	$output = '<div class="wpsite-gallery">';
	$i      = 0;

	foreach ( $documents as $document ) {
		$image = wp_get_attachment_image_src( $document->ID, 'thumbnail' );
		$title = get_the_title( $document->ID );
		$url   = wp_get_attachment_url( $document->ID );

		if ( ! $url ) {
			continue;
		}

		$description = get_post_field( 'post_excerpt', $document->ID );

		$output .= '<div class="wpsite-gallery-item">';
		$output .= sprintf(
			'<a href="%s" target="_blank">',
			esc_url( $url )
		);

		if ( $image && is_array( $image ) && isset( $image[0] ) ) {
			$output .= sprintf(
				'<img src="%s" alt="%s">',
				esc_url( $image[0] ),
				esc_attr( $title )
			);
		}

		$output .= '</a>';
		$output .= sprintf(
			'<h4><a href="%s" target="_blank">%s</a></h4>',
			esc_url( $url ),
			esc_html( $title )
		);

		if ( $description ) {
			$output .= '<p>' . wp_kses_post( $description ) . '</p>';
		}

		$output .= '</div>';

		$i++;

		if ( $i % $columns === 0 ) {
			$output .= '<div class="clear"></div>';
		}
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'wpsite_documents', 'wpsite_shortcode_documents' );

/**
 * Show Spreadsheets Shortcode: [wpsite_spreadsheets]
 *
 * Displays spreadsheet files from the media library.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $orderby Order by parameter. Default 'date'.
 *     @type string $order   Sort order (ASC or DESC). Default 'DESC'.
 *     @type string $ids     Comma-separated spreadsheet IDs. Default empty.
 *     @type int    $columns Number of columns. Default 3.
 * }
 * @return string HTML output of spreadsheets gallery.
 */
function wpsite_shortcode_spreadsheets( $atts ) {
	$atts = shortcode_atts(
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
			'ids'     => '',
			'columns' => 3,
		),
		$atts,
		'wpsite_spreadsheets'
	);

	// Sanitize inputs.
	$orderby = sanitize_text_field( $atts['orderby'] );
	$order   = strtoupper( sanitize_text_field( $atts['order'] ) );
	$columns = absint( $atts['columns'] );

	// Validate order.
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	// Validate columns.
	if ( $columns < 1 || $columns > 12 ) {
		$columns = 3;
	}

	// Sanitize IDs.
	$ids = '';
	if ( ! empty( $atts['ids'] ) ) {
		$ids_array = array_map( 'absint', explode( ',', $atts['ids'] ) );
		$ids       = array_filter( $ids_array );
	}

	$spreadsheets = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'orderby'        => $orderby,
			'order'          => $order,
			'include'        => $ids,
			'numberposts'    => -1,
		)
	);

	if ( ! $spreadsheets ) {
		return '';
	}

	$output = '<div class="wpsite-gallery">';
	$i      = 0;

	foreach ( $spreadsheets as $spreadsheet ) {
		$title = get_the_title( $spreadsheet->ID );

		$output .= '<div class="wpsite-gallery-item">';
		$output .= wp_get_attachment_image( $spreadsheet->ID, 'thumbnail' );
		$output .= '<h4>' . esc_html( $title ) . '</h4>';
		$output .= '</div>';

		$i++;

		if ( $i % $columns === 0 ) {
			$output .= '<div style="clear:both;"></div>';
		}
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'wpsite_spreadsheets', 'wpsite_shortcode_spreadsheets' );
