<?php
/**
 * Registering container section for customizer
 *
 * @package     Bizbir
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Bizbir_Customizer_Register_Header extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Bizbir_Theme_Options::load_defaults();

		$_header_menu_disable_cb = array(
			'setting'  => 'field-header-menu-disable',
			'operator' => '===',
			'value'    => false,
		);

		$primary_header_field = array(
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-line-container-3',
				'section'         => 'section-header-primary',
				'default'         => '<span class="customizer-bizbir-title wp-ui-text-highlight nomargin">' . __( 'Menu Section', 'bizbir' ) . '</span>',
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-header-menu-disable',
				'label'    => esc_html__( 'Disable Menu', 'bizbir' ),
				'section'  => 'section-header-primary',
				'default'  => $defaults['field-header-menu-disable'],
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-menu-disable-search',
				'label'           => esc_html__( 'Disable Search', 'bizbir' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-disable-search'],
				'active_callback' => [ $_header_menu_disable_cb ]
			),
			array(
				'category'        => 'field',
				'type'            => 'checkbox',
				'settings'        => 'field-header-menu-disable-minicart',
				'label'           => esc_html__( 'Disable Mini Cart', 'bizbir' ),
				'section'         => 'section-header-primary',
				'default'         => $defaults['field-header-menu-disable-minicart'],
				'active_callback' => [ $_header_menu_disable_cb ]
			),
		);

		$site_identity = array(
			//Site Identity
			array(
				'category' => 'field',
				'type'     => 'slider',
				'settings' => 'field-identity-logo-width',
				'label'    => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'Site Logo Width & Site Titles', 'bizbir' ) . '</span>',
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-logo-width'],
				'choices'  => [
					'min'  => 1,
					'max'  => 600,
					'step' => 1,
				],
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-title',
				'label'    => esc_html__( 'Display Site Title', 'bizbir' ),
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-display-site-title'],
			),
			array(
				'category' => 'field',
				'type'     => 'checkbox',
				'settings' => 'field-identity-display-site-tagline',
				'label'    => esc_html__( 'Display Site Tagline', 'bizbir' ),
				'section'  => 'title_tagline',
				'default'  => $defaults['field-identity-display-site-tagline'],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-identity-site-title-typography',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Site Title Typography', 'bizbir' ),
				'section'         => 'title_tagline',
				'default'         => $defaults['field-identity-site-title-typography'],
				'active_callback' => array(
					array(
						'setting'  => 'field-identity-display-site-title',
						'operator' => '===',
						'value'    => true,
					),
				),
				'output'          => [
					[
						'element' => '.site-title a, .site-title a:visited',
					],
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'typography',
				'settings'        => 'field-identity-site-tagline',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Site Tagline Typography', 'bizbir' ),
				'section'         => 'title_tagline',
				'default'         => $defaults['field-identity-site-tagline'],
				'active_callback' => array(
					array(
						'setting'  => 'field-identity-display-site-tagline',
						'operator' => '===',
						'value'    => true,
					),
				),
				'output'          => [
					[
						'element' => '.site-tagline',
					],
				],
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-favicon',
				'section'  => 'title_tagline',
				'default'  => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'Site Favicon', 'bizbir' ) . '</span>',
			),
		);
		
		$sticky_header_field = array(
			//Sticky Header
			array(
				'category'    => 'field',
				'type'        => 'toggle',
				'settings'    => 'field-header-menu-sticky',
				'label'       => __( 'Enable Sticky Header ?', 'bizbir' ),
				'description' => esc_html__( 'Enabling it will make the header stick to the top.', 'bizbir' ),
				'section'     => 'section-header-sticky',
				'default'     => $defaults['field-header-menu-sticky'],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-header-menu-sticky-background',
				'label'           => __( 'Sticky Background color', 'bizbir' ),
				'section'         => 'section-header-sticky',
				'default'         => '#fff',
				'choices'         => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'field-header-menu-sticky',
						'operator' => '===',
						'value'    => true,
					),
				),
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#masthead.sticky-enabled.sticky-header, .sticky-enabled.sticky-header',
						'property' => 'background'
					]
				]
			),
		);

		return array_merge( $configs, $site_identity, $primary_header_field, $sticky_header_field );
	}
	
}

new Bizbir_Customizer_Register_Header();


