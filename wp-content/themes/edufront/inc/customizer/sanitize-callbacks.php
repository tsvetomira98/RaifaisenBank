<?php
/**
 * All the sanitization function required for the customizer settings.
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
 * Sanitization function for the select controls.
 */
function edufront_customizer_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


function edufront_customizer_sanitize_checkbox( $input ) {
	return ( isset( $input ) ? 1 : 0 );
}
