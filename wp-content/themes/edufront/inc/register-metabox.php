<?php
/**
 * This file has the required codes for registering the metaboxes in posts or pages.
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Bail if static front page is not set.
 */
if ( 'page' !== get_option( 'show_on_front' ) ) {
	return;
}

if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
	return;
}

require_once get_template_directory() . '/inc/metabox-callbacks.php';

if ( ! function_exists( 'edufront_register_custom_metabox' ) ) {

	/**
	 * Adds custom metaboxes to post types.
	 */
	function edufront_register_custom_metabox() {

		$args = edufront_get_metabox_args();

		if ( is_array( $args ) && count( $args ) > 0 ) {
			foreach ( $args as $key => $arg ) {
				$box_id     = "edufront_metabox_{$key}";
				$box_title  = ! empty( $arg['box_title'] ) ? $arg['box_title'] : '';
				$callback   = ! empty( $arg['callback'] ) ? $arg['callback'] : "{$box_id}_cb";
				$box_screen = ! empty( $arg['screen'] ) ? $arg['screen'] : 'post';
				$context    = ! empty( $arg['context'] ) ? $arg['context'] : 'normal';
				$priority   = ! empty( $arg['priority'] ) ? $arg['priority'] : 'high';

				add_meta_box( $box_id, $box_title, $callback, $box_screen, $context, $priority );
			}
		}
	}
	add_action( 'add_meta_boxes', 'edufront_register_custom_metabox' );
}

/**
 * Returns the array of metabox arguments.
 */
function edufront_get_metabox_args() {

	$args = array(
		'event_infos' => array(
			'box_title' => esc_html__( 'Event Informations', 'edufront' ),
		),
	);

	return apply_filters( 'edufront_get_metabox_args', $args );

}




if ( ! function_exists( 'edufront_save_post_meta' ) ) {

	/**
	 * Save post metabox value.
	 *
	 * @param int $post_id Current post id.
	 */
	function edufront_save_post_meta( $post_id ) {

		$nonce_field    = "edufront_metabox_nonce_{$post_id}";
		$submitted_data = isset( $_POST[ $nonce_field ] ) && wp_verify_nonce( sanitize_post( wp_unslash( $_POST[ $nonce_field ] ) ), "{$nonce_field}_action" ) ? sanitize_post( wp_unslash( $_POST ) ) : array(); // phpcs:ignore
		$metabox_data   = isset( $submitted_data['edufront_metabox'] ) ? $submitted_data['edufront_metabox'] : false;

		if ( is_array( $metabox_data ) && ! empty( $metabox_data ) ) {
			update_post_meta( $post_id, 'edufront_metabox', $metabox_data );
		}

	}
	add_action( 'save_post', 'edufront_save_post_meta' );
}

