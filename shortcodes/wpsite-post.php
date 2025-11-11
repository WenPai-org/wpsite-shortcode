<?php
/**
 * Post Shortcodes
 *
 * Provides shortcodes for displaying post metadata and content.
 *
 * @package WPSite_Shortcode
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Post ID Shortcode: [wpsite_postid]
 *
 * Displays the current post ID.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the post ID. Default empty.
 *     @type string $after  Text after the post ID. Default empty.
 * }
 * @return string Post ID with optional before/after text.
 */
function wpsite_shortcode_post_id( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_postid'
	);

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return '';
	}

	return esc_html( $atts['before'] ) . absint( $post_id ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_postid', 'wpsite_shortcode_post_id' );

/**
 * Post Title Shortcode: [wpsite_posttitle]
 *
 * Displays the current post title.
 *
 * @return string Post title.
 */
function wpsite_shortcode_post_title( $atts ) {
	$title = get_the_title();
	return $title ? esc_html( $title ) : '';
}
add_shortcode( 'wpsite_posttitle', 'wpsite_shortcode_post_title' );

/**
 * Post Excerpt Shortcode: [wpsite_postexcerpt]
 *
 * Displays the post excerpt or trimmed content if no excerpt exists.
 *
 * @return string Post excerpt.
 */
function wpsite_shortcode_post_excerpt( $atts ) {
	global $post;

	if ( ! $post || ! isset( $post->post_excerpt ) ) {
		return '';
	}

	$excerpt = $post->post_excerpt;
	if ( empty( $excerpt ) ) {
		$excerpt = get_the_content();
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = wp_trim_words( $excerpt, 55, '...' );
	}

	return wp_kses_post( $excerpt );
}
add_shortcode( 'wpsite_postexcerpt', 'wpsite_shortcode_post_excerpt' );

/**
 * Post Author Shortcode: [wpsite_postauthor]
 *
 * Displays the post author name.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the author name. Default empty.
 *     @type string $after  Text after the author name. Default empty.
 * }
 * @return string Author name with optional before/after text.
 */
function wpsite_shortcode_post_author( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_postauthor'
	);

	$post_author = get_the_author();

	if ( ! $post_author ) {
		return '';
	}

	return esc_html( $atts['before'] ) . esc_html( $post_author ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_postauthor', 'wpsite_shortcode_post_author' );

/**
 * Post Date Shortcode: [wpsite_postdate]
 *
 * Displays the post publication date.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the date. Default empty.
 *     @type string $after  Text after the date. Default empty.
 *     @type string $format Date format. Default site date format.
 * }
 * @return string Formatted post date with optional before/after text.
 */
function wpsite_shortcode_post_date( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
			'format' => get_option( 'date_format' ),
		),
		$atts,
		'wpsite_postdate'
	);

	$post_date = get_the_date( $atts['format'] );

	if ( ! $post_date ) {
		return '';
	}

	return esc_html( $atts['before'] ) . esc_html( $post_date ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_postdate', 'wpsite_shortcode_post_date' );

/**
 * Post Modified Date Shortcode: [wpsite_modifieddate]
 *
 * Displays the post last modified date.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the date. Default empty.
 *     @type string $after  Text after the date. Default empty.
 *     @type string $format Date format. Default site date format.
 * }
 * @return string Formatted modified date with optional before/after text.
 */
function wpsite_shortcode_post_modified_date( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
			'format' => get_option( 'date_format' ),
		),
		$atts,
		'wpsite_modifieddate'
	);

	$post_modified_date = get_the_modified_date( $atts['format'] );

	if ( ! $post_modified_date ) {
		return '';
	}

	return esc_html( $atts['before'] ) . esc_html( $post_modified_date ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_modifieddate', 'wpsite_shortcode_post_modified_date' );

/**
 * Post Slug Shortcode: [wpsite_postslug]
 *
 * Displays the post slug.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the slug. Default empty.
 *     @type string $after  Text after the slug. Default empty.
 * }
 * @return string Post slug with optional before/after text.
 */
function wpsite_shortcode_post_slug( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_postslug'
	);

	$post_id = get_the_ID();
	if ( ! $post_id ) {
		return '';
	}

	$post_slug = get_post_field( 'post_name', $post_id );

	if ( ! $post_slug ) {
		return '';
	}

	return esc_html( $atts['before'] ) . esc_attr( $post_slug ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_postslug', 'wpsite_shortcode_post_slug' );

/**
 * Post URL Shortcode: [wpsite_posturl]
 *
 * Displays the post permalink.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the URL. Default empty.
 *     @type string $after  Text after the URL. Default empty.
 * }
 * @return string Post URL with optional before/after text.
 */
function wpsite_shortcode_post_url( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_posturl'
	);

	$post_url = get_permalink();

	if ( ! $post_url ) {
		return '';
	}

	return esc_html( $atts['before'] ) . esc_url( $post_url ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_posturl', 'wpsite_shortcode_post_url' );

/**
 * Post Featured Image Shortcode: [wpsite_postimage]
 *
 * Displays the post featured image URL.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $size Image size. Default 'full'.
 * }
 * @return string Featured image URL or empty string.
 */
function wpsite_shortcode_post_featured_image( $atts ) {
	$atts = shortcode_atts(
		array(
			'size' => 'full',
		),
		$atts,
		'wpsite_postimage'
	);

	$post_id = get_the_ID();
	if ( ! $post_id ) {
		return '';
	}

	$thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( ! $thumbnail_id ) {
		return '';
	}

	$image = wp_get_attachment_image_src( $thumbnail_id, $atts['size'] );

	if ( ! $image || ! is_array( $image ) || ! isset( $image[0] ) ) {
		return '';
	}

	return esc_url( $image[0] );
}
add_shortcode( 'wpsite_postimage', 'wpsite_shortcode_post_featured_image' );

/**
 * Post Tags Shortcode: [wpsite_posttag]
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
 * @return string Tag list or empty string.
 */
function wpsite_shortcode_post_tags( $atts ) {
	$atts = shortcode_atts(
		array(
			'before'    => '',
			'after'     => '',
			'separator' => ', ',
		),
		$atts,
		'wpsite_posttag'
	);

	$tags = get_the_tag_list( $atts['before'], $atts['separator'], $atts['after'] );

	return $tags ? wp_kses_post( $tags ) : '';
}
add_shortcode( 'wpsite_posttag', 'wpsite_shortcode_post_tags' );

/**
 * Post Categories Shortcode: [wpsite_postcat]
 *
 * Displays the post categories list.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before    Text before the category list. Default empty.
 *     @type string $after     Text after the category list. Default empty.
 *     @type string $separator Category separator. Default ', '.
 * }
 * @return string Category list or empty string.
 */
function wpsite_shortcode_post_categories( $atts ) {
	$atts = shortcode_atts(
		array(
			'before'    => '',
			'after'     => '',
			'separator' => ', ',
		),
		$atts,
		'wpsite_postcat'
	);

	$categories = get_the_category_list( $atts['separator'], $atts['before'], $atts['after'] );

	return $categories ? wp_kses_post( $categories ) : '';
}
add_shortcode( 'wpsite_postcat', 'wpsite_shortcode_post_categories' );

/**
 * Post Parent Category Shortcode: [wpsite_parentcat]
 *
 * Displays the post's parent category name.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the parent category. Default empty.
 *     @type string $after  Text after the parent category. Default empty.
 * }
 * @return string Parent category name with optional before/after text.
 */
function wpsite_shortcode_post_parent_category( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_parentcat'
	);

	$parent_category = '';

	$categories = get_the_category();
	if ( ! $categories || ! is_array( $categories ) ) {
		return '';
	}

	foreach ( $categories as $category ) {
		if ( isset( $category->parent ) && $category->parent ) {
			$parent_category = get_category( $category->parent );
			break;
		}
	}

	if ( $parent_category && isset( $parent_category->name ) ) {
		return esc_html( $atts['before'] ) . esc_html( $parent_category->name ) . esc_html( $atts['after'] );
	}

	return '';
}
add_shortcode( 'wpsite_parentcat', 'wpsite_shortcode_post_parent_category' );

/**
 * Post Comments Count Shortcode: [wpsite_commentscount]
 *
 * Displays the number of comments on the post.
 *
 * @param array $atts {
 *     Shortcode attributes.
 *
 *     @type string $before Text before the comment count. Default empty.
 *     @type string $after  Text after the comment count. Default empty.
 * }
 * @return string Comment count with optional before/after text.
 */
function wpsite_shortcode_post_comments_count( $atts ) {
	$atts = shortcode_atts(
		array(
			'before' => '',
			'after'  => '',
		),
		$atts,
		'wpsite_commentscount'
	);

	$comments_count = get_comments_number();

	return esc_html( $atts['before'] ) . absint( $comments_count ) . esc_html( $atts['after'] );
}
add_shortcode( 'wpsite_commentscount', 'wpsite_shortcode_post_comments_count' );
