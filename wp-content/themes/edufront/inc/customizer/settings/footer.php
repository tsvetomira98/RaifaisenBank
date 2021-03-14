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
$section_id = 'edufront_general_options_footer';


$wp_customize->add_section(
	$section_id,
	array(
		'title' => __( 'Footer', 'edufront' ),
		'panel' => $panel_id,
	)
);



edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[enable_footer_widgets]',
		'default'           => $defaults['enable_footer_widgets'],
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'label'             => esc_html__( 'Enable Footer Widgets?', 'edufront' ),
		'section'           => $section_id,
	)
);



edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'checkbox',
		'name'              => 'edufront_theme_options[display_social_links]',
		'default'           => $defaults['display_social_links'],
		'sanitize_callback' => 'edufront_customizer_sanitize_checkbox',
		'label'             => esc_html__( 'Display Social Links?', 'edufront' ),
		'section'           => $section_id,
	)
);

