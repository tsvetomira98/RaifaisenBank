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

class Bizbir_Customizer_Register_Blog extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 
		$defaults = Bizbir_Theme_Options::load_defaults();

		$blog_archive = array(
			//Arhive page fields
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-blog-archive-column',
				'label'    => esc_html__( 'Archive columns:', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-archive-column'],
				'choices'     => [
					12 => esc_html__( '1 column', 'bizbir' ),
					6 => esc_html__( '2 columns', 'bizbir' ),
					4 => esc_html__( '3 columns', 'bizbir' ),
					3 => esc_html__( '4 columns', 'bizbir' ),
				],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-date',
				'label'    => esc_html__( 'Enable Date', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-date'],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-author-enable',
				'label'    => esc_html__( 'Enable Author', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-author-enable'],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-tag-enable',
				'label'    => esc_html__( 'Enable Tag', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-tag-enable'],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-category-enable',
				'label'    => esc_html__( 'Enable Category', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-category-enable'],
			),
			array(
				'category' => 'field',
				'type'     => 'toggle',
				'settings' => 'field-blog-comments-enable',
				'label'    => esc_html__( 'Enable Comment', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-comments-enable'],
			),
			array(
				'category' => 'field',
				'type'     => 'text',
				'settings' => 'field-blog-read-more',
				'label'    => esc_html__( 'Read more text', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-read-more'],
			),
			array(
				'category' => 'field',
				'type'     => 'number',
				'settings' => 'field-blog-excerpt-length',
				'label'    => esc_html__( 'Excerpt length', 'bizbir' ),
				'section'  => 'section-blog-archive',
				'default'  => $defaults['field-blog-excerpt-length'],
			),
		);
		


		$pagination = array(
			
			//Pagination
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-9',
				'section'  => 'section-blog-pagination',
				'default'  => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'Pagination', 'bizbir' ) . '</span>',
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-blog-post-pagination',
				'section'  => 'section-blog-pagination',
				'default'  => $defaults['field-blog-post-pagination'],
				'choices'  => array(
					'numeric'          => esc_html__( 'Numeric', 'bizbir' ),
					'legacy'           => esc_html__( 'Legacy Old/New', 'bizbir' ),
				),
			),
			array(
				'category' => 'field',
				'type'     => 'radio-buttonset',
				'settings' => 'field-pagination-alignment',
				'label'    => esc_html__( 'Pagination Alignment', 'bizbir' ),
				'section'  => 'section-blog-pagination',
				'default'  => $defaults['field-pagination-alignment'],
				'choices'  => [
					'left-align-pagination'   => esc_html__( 'Left', 'bizbir' ),
					'center-align-pagination' => esc_html__( 'Center', 'bizbir' ),
					'right-align-pagination'  => esc_html__( 'Right', 'bizbir' ),
				],
			),
		);

		$single_posts = array(
			//Author info
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'field-single-author-info-enable',
				'label'     => esc_html__( 'Enable author info ?', 'bizbir' ),
				'section'   => 'section-single-post',
				'default'   => $defaults['field-single-author-info-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'field-single-pagination-enable',
				'label'     => esc_html__( 'Enable pagination ?', 'bizbir' ),
				'section'   => 'section-single-post',
				'default'   => $defaults['field-single-pagination-enable'],
				'transport' => 'refresh',
			),
		);

		return array_merge( $configs, $blog_archive, $single_posts, $pagination );
	}
}

new Bizbir_Customizer_Register_Blog();


