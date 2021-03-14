<?php
/**
 * This file has the callback functions for the theme metaboxes.
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'edufront_metabox_event_infos_cb' ) ) {

	/**
	 * Callback function for Content Icon.
	 */
	function edufront_metabox_event_infos_cb() {
		$nonce_field = 'edufront_metabox_nonce_' . get_the_ID();
		$post_data   = get_post_meta( get_the_ID(), 'edufront_metabox', true );

		$event_date     = isset( $post_data['event_date'] ) ? $post_data['event_date'] : '';
		$event_time     = isset( $post_data['event_time'] ) ? $post_data['event_time'] : '';
		$event_location = isset( $post_data['event_location'] ) ? $post_data['event_location'] : '';
		?>
		<div class="container">
			<p class="description">
				<?php esc_html_e( 'You can use below fields to display data in "Edufront Events" elementor widget.', 'edufront' ); ?>
			</p>

			<div class="event-fields-wrapper">
				<label for="edufront-event-date">
					<span><?php esc_html_e( 'Event Date', 'edufront' ); ?></span>
					<input type="date" id="edufront-event-date" name="edufront_metabox[event_date]" value="<?php echo esc_attr( $event_date ); ?>">
				</label>

				<label for="edufront-event-time">
					<span><?php esc_html_e( 'Event Time', 'edufront' ); ?></span>
					<input type="text" id="edufront-event-time" name="edufront_metabox[event_time]" value="<?php echo esc_attr( $event_time ); ?>">
				</label>

				<label for="edufront-event-location">
					<span><?php esc_html_e( 'Event Location', 'edufront' ); ?></span>
					<input type="text" id="edufront-event-location" name="edufront_metabox[event_location]" value="<?php echo esc_attr( $event_location ); ?>">
				</label>
			</div>
			<?php wp_nonce_field( "{$nonce_field}_action", $nonce_field ); ?>
		</div>
		<?php
	}
}
