<?php
/**
 * Registering panels for customizer
 *
 * @package     Bizbir
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Bizbir_Customizer_Register_Panels extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$panel = array(
			array(
				'category' => 'panel',
				'name'     => 'panel-global',
				'priority' => 10,
				'title'    => esc_html__( 'Global', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-header',
				'priority' => 20,
				'title'    => esc_html__( 'Header', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-blog',
				'priority' => 30,
				'title'    => esc_html__( 'Blog', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-homepage',
				'priority' => 40,
				'title'    => esc_html__( 'Homepage', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-about',
				'priority' => 50,
				'title'    => esc_html__( 'About Us Template', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-contact',
				'priority' => 60,
				'title'    => esc_html__( 'Contact Page', 'bizbir' ),
			),
			array(
				'category' => 'panel',
				'name'     => 'panel-footer',
				'priority' => 70,
				'title'    => esc_html__( 'Footer', 'bizbir' ),
			),
		);

		return array_merge( $configs, $panel );
	}

}

new Bizbir_Customizer_Register_Panels();