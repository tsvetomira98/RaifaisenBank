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

if ( ! edufront_get_newsletter_form( 0, false ) ) {
	return;
}

$panel_id   = 'edufront_general_options';
$section_id = 'edufront_general_options_newsletter';


$wp_customize->add_section(
	$section_id,
	array(
		'title' => __( 'Newsletter', 'edufront' ),
		'panel' => $panel_id,
	)
);



edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'text',
		'name'              => 'edufront_theme_options[newsletter_heading]',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Newsletter Heading', 'edufront' ),
		'section'           => $section_id,
	)
);



edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'textarea',
		'name'              => 'edufront_theme_options[newsletter_description]',
		'sanitize_callback' => 'sanitize_textarea_field',
		'label'             => esc_html__( 'Newsletter Description', 'edufront' ),
		'section'           => $section_id,
	)
);

