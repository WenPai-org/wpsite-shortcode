<?php
/**
 * Settings page template
 *
 * @package WPSite_Shortcode
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Render the plugin settings page.
 *
 * @return void
 */
function wpsite_shortcode_render_settings_page() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'WPSite Shortcode Settings', 'wpsite-shortcode' ); ?></h1>
		<p><?php esc_html_e( 'The WPSite.cn Shortcode plugin provides a set of pre-built shortcodes that can be used by WordPress website owners and developers without having to write custom code.', 'wpsite-shortcode' ); ?></p>
		<p><?php esc_html_e( 'By using the dynamic data of WordPress itself, the content of the website can be displayed more flexibly. It can also usually be used as a wildcard for SEO.', 'wpsite-shortcode' ); ?></p>

		<div class="wpsite-shortcode-info">
			<h2><?php esc_html_e( 'Plugin Information', 'wpsite-shortcode' ); ?></h2>
			<ul>
				<li><?php printf( esc_html__( 'Total shortcodes: %d', 'wpsite-shortcode' ), intval( wpsite_shortcode_count() ) ); ?></li>
				<li>
					<?php
					printf(
						/* translators: %s: URL to documentation */
						wp_kses_post( __( 'Support: <a href="%s" target="_blank" rel="noopener noreferrer">View Document</a>', 'wpsite-shortcode' ) ),
						esc_url( 'https://wpsite.cn/document' )
					);
					?>
				</li>
			</ul>
		</div>

		<div id="wordpress-shortcodes" class="shortcode-wrapper">
			<h2><?php esc_html_e( 'WordPress Metadata', 'wpsite-shortcode' ); ?></h2>
			<?php include plugin_dir_path( __FILE__ ) . 'wordpress-shortcodes.php'; ?>
		</div>
	</div>
	<?php
}
