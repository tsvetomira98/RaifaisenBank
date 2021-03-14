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
$section_id = 'edufront_general_options_layouts';

$layouts = array(
	'no-sidebar'    => __( 'No Sidebar', 'edufront' ),
	'left-sidebar'  => __( 'Left Sidebar', 'edufront' ),
	'right-sidebar' => __( 'Right Sidebar', 'edufront' ),
);


$wp_customize->add_section(
	$section_id,
	array(
		'title' => __( 'Layouts', 'edufront' ),
		'panel' => $panel_id,
	)
);




edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => 'edufront_theme_options[layout_archives_blogs]',
		'sanitize_callback' => 'edufront_customizer_sanitize_select',
		'label'             => esc_html__( 'Archives Layout', 'edufront' ),
		'description'       => __( 'Select sidebar layout for archives and blogs.', 'edufront' ),
		'default'           => $defaults['layout_archives_blogs'],
		'section'           => $section_id,
		'choices'           => $layouts,
	)
);





edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => 'edufront_theme_options[layout_posts]',
		'sanitize_callback' => 'edufront_customizer_sanitize_select',
		'label'             => esc_html__( 'Posts Layouts', 'edufront' ),
		'description'       => __( 'Select sidebar layout for single posts.', 'edufront' ),
		'default'           => $defaults['layout_posts'],
		'section'           => $section_id,
		'choices'           => $layouts,
	)
);





edufront_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => 'edufront_theme_options[layout_pages]',
		'sanitize_callback' => 'edufront_customizer_sanitize_select',
		'label'             => esc_html__( 'Pages Layouts', 'edufront' ),
		'description'       => __( 'Select sidebar layout for single pages.', 'edufront' ),
		'default'           => $defaults['layout_pages'],
		'section'           => $section_id,
		'choices'           => $layouts,
	)
);

