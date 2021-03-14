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

class Bizbir_Customizer_Register_Breadcrumb extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		if( bizbir_is_navxt_breadcrumbs_enabled() ){
			$defaults = Bizbir_Theme_Options::load_defaults();
			$breadcrumb_fields = array(
				array(
					'category' => 'field',
					'type'     => 'select',
					'settings' => 'field-breadcrumb-type',
					'label'    => esc_html__('Position Selection', 'bizbir'),
					'section'  => 'section-breadcrumbs',
					'default'  => $defaults['field-breadcrumb-type'],
					'priority' => 1,
					'multiple' => 1,
					'choices'  => [
						'none'          => esc_html__('Disable', 'bizbir'),
						'after-title'  => esc_html__('After title', 'bizbir'),
						'before-title' => esc_html__('Before title', 'bizbir'),
					],
				),
				array(
					'category'        => 'field',
					'type'            => 'text',
					'settings'        => 'field-breadcrumb-seperator',
					'label'           => esc_html__('Seperator', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'priority'        => 2,
					'default' 		 => $defaults['field-breadcrumb-seperator'],
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-homepage',
					'label'           => esc_html__('Disable on Homepage', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'default' 		 => $defaults['field-breadcrumb-disable-homepage'],
					'priority'        => 5,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-blog',
					'label'           => esc_html__('Disable on Blog Listing Page', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'default' 		 => $defaults['field-breadcrumb-disable-blog'],
					'priority'        => 6,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-single-page',
					'label'           => esc_html__('Disable on Single Page', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'priority'        => 7,
					'default' 		 => $defaults['field-breadcrumb-disable-single-page'],
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-single-post',
					'label'           => esc_html__('Disable on Single Post', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'default' 		 => $defaults['field-breadcrumb-disable-single-post'],
					'priority'        => 8,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-single',
					'label'           => esc_html__('Disable on all single post/pages', 'bizbir'),
					'default' 		 => $defaults['field-breadcrumb-disable-single'],
					'description'     => __('This will override single page or post options if enabled.', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'priority'        => 9,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-search',
					'label'           => esc_html__('Disable on Search page', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'default' 		 => $defaults['field-breadcrumb-disable-search'],
					'priority'        => 10,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-archive',
					'label'           => esc_html__('Disable on Archive page', 'bizbir'),
					'default' 		 => $defaults['field-breadcrumb-disable-archive'],
					'section'         => 'section-breadcrumbs',
					'priority'        => 12,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'checkbox',
					'settings'        => 'field-breadcrumb-disable-404',
					'label'           => esc_html__('Disable on 404 page', 'bizbir'),
					'default' 		 => $defaults['field-breadcrumb-disable-404'],
					'section'         => 'section-breadcrumbs',
					'priority'        => 13,
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
				),
				array(
					'category'        => 'field',
					'type'            => 'select',
					'settings'        => 'field-breadcrumb-alignment',
					'label'           => esc_html__('Alignment', 'bizbir'),
					'section'         => 'section-breadcrumbs',
					'default' 		 => $defaults['field-breadcrumb-alignment'],
					'priority'        => 14,
					'multiple'        => 1,
					'choices'         => [
						'left'   => esc_html__('Left', 'bizbir'),
						'right'  => esc_html__('Right', 'bizbir'),
						'center' => esc_html__('Center', 'bizbir'),
					],
					'transport'       => 'auto',
					'active_callback' => array(
						array(
							'setting'  => 'field-breadcrumb-type',
							'operator' => '!==',
							'value'    => 'none',
						)
					),
					'output'          => [
						[
							'element'  => '.breadcrumbs',
							'property' => 'text-align',
						]
					]
				),
			);
		} else {
			$breadcrumb_fields = array(
				array(
					'category' => 'field',
					'type'     => 'custom',
					'settings' => 'field-breadcrumb-plugin-message',
					'label'    => esc_html__('Breadcrumb Plugin Required', 'bizbir'),
					'section'  => 'section-breadcrumbs',
					'default'  => '<div style="padding: 15px;background-color: #f7e9a6;border-left: 8px solid #1c5015;font-size: 16px;line-height: 1.5;">' . sprintf( esc_html__('To enable breadcrumbs you need to install and activate breadcrumb Navxt Plugin from %s', 'bizbir'), '<a href="' . admin_url('admin.php?page=tgmpa-install-plugins') . '">Here</a>') . '</div>',
				),
			);
		}

		return array_merge( $configs, $breadcrumb_fields );
	}
}

new Bizbir_Customizer_Register_Breadcrumb();


