<?php
/**
 * Plugin Name:     SB Breadcrumbs block
 * Plugin URI: 		https://www.oik-plugins.com/oik-plugins/sb-breadcrumbs-block
 * Description:     Show breadcrumbs to the current content as links
 * Version:         0.6.0
 * Author:          bobbingwide
 * Author URI: 		https://www.bobbingwide.com/about-bobbing-wide
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     sb-breadcrumbs-block
 *
 *
 * @package         sb-breadcrumbs-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function sb_breadcrumbs_block_block_init() {
	$dir = dirname( __FILE__ );
	load_plugin_textdomain( 'sb-breadcrumbs-block', false, 'sb-breadcrumbs-block/languages' );
	$args = [ 'render_callback' => 'sb_breadcrumbs_block_dynamic_block'];
	register_block_type_from_metadata( __DIR__, $args );
	/**
	 * Localise the script by loading the required strings for the build/index.js file
	 * from the locale specific .json file in the languages folder.
	 * oik-sb/sb-starting-block
	 */
	$ok = wp_set_script_translations( 'sb-breadcrumbs-block-editor-script', 'sb-breadcrumbs-block' , __DIR__ .'/languages' );
	//bw_trace2( $ok, "OK?");
	//add_filter( 'load_script_textdomain_relative_path', 'oik_sb_sb_starting_block_load_script_textdomain_relative_path', 10, 2);



}
add_action( 'init', 'sb_breadcrumbs_block_block_init' );


/**
 * Implements the Breadcrumbs block
 *
 * Note: When server side rendering we can't use the Yoast or Genesis solutions; they don't work in the editor.
 * So we just display the default logic.
 *
 * In the front end ( not REST ) then we try WordPress SEO first, then Genesis.
 * If no result then we use the default implementation.
 *
 * @param $attributes
 *
 * @return string|null
 */
function sb_breadcrumbs_block_dynamic_block( $attributes ) {
	//load_plugin_textdomain( 'sb-breadcrumbs-block', false, 'sb-breadcrumbs-block/languages' );
	$html = null;

	if ( defined('REST_REQUEST') && REST_REQUEST ) {
		// Don't do anything special for REST requests
		// while the plugins don't support it
	} else {
		if ( function_exists( 'yoast_breadcrumb') )  {
			$html = yoast_breadcrumb( '<p id=breadcrumbs', '</p>', false );
		}
		if ( !$html ) {
			if ( class_exists( 'Genesis_Breadcrumb') ) {
				$gb = new Genesis_Breadcrumb();
				$html = $gb->get_output( [ 'labels' => [ 'prefix' => null] ]  );
			}
		}
	}

	if ( !$html ) {
		$html = sb_breadcrumbs_block_dynamic_block_internal( $attributes );
	}

	$classes = '';
	if ( isset( $attributes['textAlign'] ) ) {
		$classes .= 'has-text-align-' . $attributes['textAlign'];
	}
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classes ) );
	$html = sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, $html );
	return $html;
}

/**
 * Implements default logic for the Breadcrumbs block
 *
 * The values for Home and separator are currently hard coded.
 *
 * @param array $attributes Attributes for the block.
 * @return string|null
 */
function sb_breadcrumbs_block_dynamic_block_internal( $attributes ) {
	$html = null;
	$post = get_post();
	if ( $post ) {
		$html = $post->post_title;
	}
	$id = wp_get_post_parent_id( null );
	$separator = ' / ';
	while ( $id ) {
		$url = get_permalink( $id );
		$title = get_the_title( $id );
		$html = "<a href=\"$url\" >$title</a>" . $separator . $html;
		$id = wp_get_post_parent_id( $id );
	}
	$args['home'] = __( 'Home', 'sb-breadcrumbs-block' );
	$html         = sb_breadcrumbs_block_home_link( $args ) . $separator . $html;
	return $html;
}

/**
 * Creates a link to "Home".
 *
 * @param array $args Array of attrubutes.
 * @return mixed|string
 */
function sb_breadcrumbs_block_home_link( $args ) {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		$url = get_permalink( get_option( 'page_on_front' ) );
	} else {
		$url = trailingslashit( home_url() );
	}
	$crumb = ( is_home() && is_front_page() ) ? $args['home'] : "<a href=\"$url\" >{$args['home']}</a>";
	return $crumb;
}
