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

class Bizbir_Customizer_Register_Footer extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Bizbir_Theme_Options::load_defaults();

		$footer_widgets = array(
			array(
				'category' => 'field',
				'type'     => 'radio-image',
				'settings' => 'field-footer-widget-layout',
				'label'    => esc_html__( 'Widget Layout Columns', 'bizbir' ),
				'section'  => 'section-footer-widgets',
				'default'         => $defaults['field-footer-widget-layout'],
				'choices'  => array(
					'no-widget' => get_theme_file_uri( '/assets/images/no-widget.svg' ),
					'wd-four'   => get_theme_file_uri( '/assets/images/widget-4.svg' ),
					'wd-three'  => get_theme_file_uri( '/assets/images/widget-3.svg' ),
					'wd-two'    => get_theme_file_uri( '/assets/images/widget-2.svg' ),
					'wd-one'    => get_theme_file_uri( '/assets/images/widget-1.svg' ),
				),
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-background-color',
				'label'           => __( 'Widget area background Color', 'bizbir' ),
				'section'         => 'section-footer-widgets',
				'default'         => $defaults['field-footer-widget-background-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#footer-widgets',
						'property' => 'background',
					]
				],
			),
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-widget-heading-color',
				'label'           => esc_html__( 'Foote widget heading color', 'bizbir' ),
				'section'         => 'section-footer-widgets',
				'default'   => $defaults['field-footer-widget-heading-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-widget-layout',
						'operator' => '!==',
						'value'    => 'no-widget',
					]
				],
				'transport'       => 'auto',
				'output'          => [
					[
						'element'  => '#footer-widgets h4.widget-title',
						'property' => 'color'
					]
				]
			),
		);
		
		$footer_bar = array(
			array(
				'category'        => 'field',
				'type'            => 'custom',
				'settings'        => 'field-horizontal-scroll-up-section',
				'section'         => 'section-footer-bar',
				'default'         => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'Scroll Up', 'bizbir' ) . '</span>',
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable',
						'operator' => '===',
						'value'    => true,
					]
				],
			),
			// Add scroll up enable option
			array(
				'category'        => 'field',
				'type'            => 'toggle',
				'settings'        => 'field-footer-bar-enable-scrollup',
				'label'           => esc_html__( 'Enable scroll up', 'bizbir' ),
				'description'     => esc_html__( 'This option toggles the "Scroll to top" arrow.', 'bizbir' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-enable-scrollup'],
			),
			// Add scroll up color option
			array(
				'category'        => 'field',
				'type'            => 'color',
				'settings'        => 'field-footer-bar-enable-scrollup-color',
				'transport'       => 'auto',
				'label'           => esc_html__( 'Scroll up background color', 'bizbir' ),
				'section'         => 'section-footer-bar',
				'default'	=> $defaults['field-footer-bar-enable-scrollup-color'],
				'active_callback' => [
					[
						'setting'  => 'field-footer-bar-enable-scrollup',
						'operator' => '===',
						'value'    => true,
					],
				],
				'output'          => [
					[
						'element'  => '#btn-scrollup a.scrollup',
						'property' => 'background'
					]
				]
			),
		);

		return array_merge( $configs, $footer_widgets, $footer_bar );
	}
}

new Bizbir_Customizer_Register_Footer();


