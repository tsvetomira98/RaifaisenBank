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
$section_id = 'edufront_general_options_header';


$wp_customize->add_section(
	$section_id,
	array(
		'title' => __( 'Header', 'edufront' ),
		'panel' => $panel_id,
	)
);


edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[enable_header_cta_btn]',
		'default'           => $defaults['enable_header_cta_btn'],
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'label'             => esc_html__( 'Enable Call To Action?', 'edufront' ),
		'section'           => $section_id,
	)
);




edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'text',
		'name'              => 'edufront_theme_options[header_cta_btn_label]',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Button Label', 'edufront' ),
		'section'           => $section_id,
		'active_callback'   => 'edufront_customizer_is_header_cta_enabled',
	)
);


edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'url',
		'name'              => 'edufront_theme_options[header_cta_btn_link]',
		'sanitize_callback' => 'esc_url_raw',
		'label'             => esc_html__( 'Button Link', 'edufront' ),
		'section'           => $section_id,
		'active_callback'   => 'edufront_customizer_is_header_cta_enabled',
	)
);


