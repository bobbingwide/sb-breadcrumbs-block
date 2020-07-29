<?php
/**
 * Plugin Name:     SB Breadcrumbs block
 * Plugin URI: 		https://www.oik-plugins.com/oik-plugins/sb-breadcrumbs-block
 * Description:     Show breadcrumbs to the current content as links
 * Version:         0.5.1
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

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "sb/breadcrumbs-block" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'sb-breadcrumbs-block-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	/*
	 * Localise the script by loading the required strings for the build/index.js file
	 * from the locale specific .json file in the languages folder
	 */
	$ok = wp_set_script_translations( 'sb-breadcrumbs-block-block-editor', 'sb-breadcrumbs-block' , $dir .'/languages'  );

	$editor_css = 'build/index.css';
	wp_register_style(
		'sb-breadcrumbs-block-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'sb-breadcrumbs-block-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'sb/breadcrumbs-block', array(
		'editor_script' => 'sb-breadcrumbs-block-block-editor',
		'editor_style'  => 'sb-breadcrumbs-block-block-editor',
		'style'         => 'sb-breadcrumbs-block-block',
		'render_callback'=>'sb_breadcrumbs_block_dynamic_block',
		'attributes' => [
			'className' => [ 'type' => 'string'],
		]
	) );

}
add_action( 'init', 'sb_breadcrumbs_block_block_init' );

function sb_breadcrumbs_block_dynamic_block( $attributes ) {
	load_plugin_textdomain( 'sb-breadcrumbs-block', false, 'sb-breadcrumbs-block/languages' );
	$color = __( 'color', 'sb-breadcrumbs-block');
	$html = null;
	if ( function_exists( 'yoast_breadcrumb') ) {
		$html = yoast_breadcrumb( '<p id=breadcrumbs', '</p>', false );
		if ( !$html ) {
			//$html = __( "Please configure Yoast SEO breadcrumbs. ", 'sb-breadcrumbs-block' );
		}
	}

	if ( !$html ) {
		$html = sb_breadcrumbs_block_dynamic_block_internal( $attributes );
	}
	return $html;

}

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
		$html = "<a href=\"$url\" >$title</a>" . $separator .  $html;
		$id = wp_get_post_parent_id( $id );
	}
	$args['home'] = __( 'Home', 'sb-breadcrumbs-block' );
	$html = sb_breadcrumbs_block_home_link( $args ) .  $separator . $html;
	return $html;

}

function sb_breadcrumbs_block_home_link( $args ) {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		$url = get_permalink( get_option( 'page_on_front') );
	} else {
		$url = trailingslashit( home_url() );
	}
	$crumb = ( is_home() && is_front_page() ) ? $args['home'] : "<a href=\"$url\" >{$args['home']}</a>";



	return $crumb;
}
