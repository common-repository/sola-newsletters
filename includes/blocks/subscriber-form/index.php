<?php
/**
 * BLOCK: Sola Newsletters Subsriber Sign-up form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'enqueue_block_editor_assets', 'sola_subscriber_form_block_editor_assets' );

function sola_subscriber_form_block_editor_assets() {
	// Scripts
	wp_enqueue_script(
		'sola-nl-block-subscriber-form',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

	wp_enqueue_script( 'sola_nl_nonce_script' );
    $data = array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'sola_nl' )
    );

    wp_localize_script( 'sola_nl_nonce_script', 'sola_nl_nonce_object', $data );
    setcookie('sola_nl',wp_create_nonce("sola_nl"));

	// Styles
	wp_enqueue_style(
		'sola-nl-block-subscriber-form-editor',
		plugins_url( 'editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);
}

add_action( 'enqueue_block_assets', 'sola_subscriber_form_block_block_assets' );

function sola_subscriber_form_block_block_assets() {
	// Styles for front-end
	wp_enqueue_style(
		'sola-nl-block-subscriber-form-front-end',
		plugins_url( 'style.css', __FILE__ ),
		array( 'wp-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);
}
