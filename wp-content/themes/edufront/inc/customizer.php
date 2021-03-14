<?php
/**
 * Edufront Customizer
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
 * Function to register control and setting.
 */
function edufront_register_option( $wp_customize, $option ) {

	// Initialize Setting.
	$wp_customize->add_setting(
		$option['name'],
		array(
			'sanitize_callback' => $option['sanitize_callback'],
			'default'           => isset( $option['default'] ) ? $option['default'] : '',
			'transport'         => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
			'theme_supports'    => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
		)
	);

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['mime_type'] ) ) {
		$control['mime_type'] = $option['mime_type'];
	}

	if ( ! empty( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}


require_once get_template_directory() . '/inc/customizer/sanitize-callbacks.php';
require_once get_template_directory() . '/inc/customizer/active-callbacks.php';


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function edufront_customize_register( $wp_customize ) {

	/**
	 * This variable is used by other files that are included here.
	 */
	$defaults = edufront_customizer_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'edufront_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'edufront_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Create panel General Options
	 */
	$wp_customize->add_panel(
		'edufront_general_options',
		array(
			'title'       => __( 'General Options', 'edufront' ),
			'description' => '<p>' . __( 'All the options that will effect over all theme appearances.', 'edufront' ) . '</p>',
			'priority'    => 160,
		)
	);

	/**
	 * These below files uses the variables like $defaults, $wp_customize.
	 */
	require_once get_template_directory() . '/inc/customizer/settings/colors.php';
	require_once get_template_directory() . '/inc/customizer/settings/header.php';
	require_once get_template_directory() . '/inc/customizer/settings/social-links.php';
	require_once get_template_directory() . '/inc/customizer/settings/payment-options.php';
	require_once get_template_directory() . '/inc/customizer/settings/layouts.php';
	require_once get_template_directory() . '/inc/customizer/settings/newsletter.php';
	require_once get_template_directory() . '/inc/customizer/settings/footer.php';
}
add_action( 'customize_register', 'edufront_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function edufront_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function edufront_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function edufront_customize_preview_js() {
	wp_enqueue_script( 'edufront-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'edufront_customize_preview_js' );

/**
 * Customizer defaults.
 */
function edufront_customizer_defaults() {
	$defaults = array(
		'enable_notice'           => false,
		'enable_top_bar'          => false,
		'enable_login_signup'     => true,
		'enable_header_cta_btn'   => false,
		'layout_archives_blogs'   => 'right-sidebar',
		'layout_posts'            => 'right-sidebar',
		'layout_pages'            => 'right-sidebar',
		'enable_footer_widgets'   => true,
		'display_social_links'    => true,
		'sharer_facebook'         => true,
		'sharer_twitter'          => true,
		'sharer_whatsapp'         => true,
		'sharer_linkedin'         => true,
		'primary_color'           => '#F7B200',
		'secondary_color'         => '#54B77E',
		'footer_background_color' => '#4E4E4E',
		'copyright_text'          => 'Copyright © 2020 | Edufront by <a href="https://bunnytemplates.com">Bunny Templates</a> | All rights reserved',
	);

	return apply_filters( 'edufront_customizer_defaults', $defaults );
}



function edufront_get_theme_mod( $key = '' ) {
	$mods = get_theme_mod( 'edufront_theme_options' );

	if ( ! $key ) {
		return $mods;
	}

	$defaults = edufront_customizer_defaults();

	$default = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

	return isset( $mods[ $key ] ) ? $mods[ $key ] : $default;
}

