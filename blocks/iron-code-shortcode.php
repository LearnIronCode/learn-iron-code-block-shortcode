<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package learn-iron-code-block-shortcode
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function iron_code_shortcode_block_init() {
	// Until Gutenberg is merged into WordPress core, register_block_type()
	// will only exist when the Gutenberg plugin is installed and activated.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$dir = dirname( __FILE__ );

	$index_js = 'iron-code-shortcode/index.js';
	wp_register_script(
		'iron-code-shortcode-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'iron-code-shortcode/editor.css';
	wp_register_style(
		'iron-code-shortcode-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'iron-code-shortcode/style.css';
	wp_register_style(
		'iron-code-shortcode-block',
		plugins_url( $style_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'learn-iron-code-block-shortcode/iron-code-shortcode', array(
		'editor_script' => 'iron-code-shortcode-block-editor',
		'editor_style'  => 'iron-code-shortcode-block-editor',
		'style'         => 'iron-code-shortcode-block',
	) );
}
add_action( 'init', 'iron_code_shortcode_block_init' );
