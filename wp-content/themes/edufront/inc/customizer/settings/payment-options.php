<?php
/**
 * This file contains required settings for the general options panel.
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_id   = 'edufront_general_options';
$section_id = 'edufront_general_options_payment_options';


$wp_customize->add_section(
	$section_id,
	array(
		'title' => __( 'Payment Options', 'edufront' ),
		'panel' => $panel_id,
	)
);



edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[payment_option_visa]',
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'default'           => false,
		'label'             => esc_html__( 'VISA', 'edufront' ),
		'section'           => $section_id,
	)
);




edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[payment_option_paypal]',
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'default'           => false,
		'label'             => esc_html__( 'PayPal', 'edufront' ),
		'section'           => $section_id,
	)
);




edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[payment_option_jcb]',
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'default'           => false,
		'label'             => esc_html__( 'JCB', 'edufront' ),
		'section'           => $section_id,
	)
);




edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[payment_option_ico_mastercard]',
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'default'           => false,
		'label'             => esc_html__( 'Master Card', 'edufront' ),
		'section'           => $section_id,
	)
);
