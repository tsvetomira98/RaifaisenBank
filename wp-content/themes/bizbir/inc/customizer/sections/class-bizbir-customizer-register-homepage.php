<?php
/**
 * Registering homepage section for customizer
 *
 * @package     Bizbir
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Bizbir_Customizer_Register_Homepage extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) { 

		$defaults = Bizbir_Theme_Options::load_defaults();

		$homepage_sections = array(
			array(
				'category'    => 'field',
				'type'        => 'sortable',
				'settings'    => 'field-homepage-sort',
				'label'       => esc_html__( 'Drag and drop the homepage sections', 'bizbir' ),
				'section'     => 'section-homepage-sort',
				'default'     => $defaults['field-homepage-sort'],
				'choices'     => [
					'Slider'      => esc_html__( 'Slider', 'bizbir' ),
					'Featured'    => esc_html__( 'Featured Section', 'bizbir' ),
					'CTA'    => esc_html__( 'CTA Section', 'bizbir' ),
					'Services'    => esc_html__( 'Services Section', 'bizbir' ),
					'News'        => esc_html__( 'News', 'bizbir' ),
				],
			),
		);

		$slider_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-slider-enable',
				'label'     => esc_html__( 'Enable Slider ?', 'bizbir' ),
				'section'   => 'section-slider',
				'default'   => $defaults['homepage-slider-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-slider-content',
				'label'       => esc_html__( 'Content Type:', 'bizbir' ),
				'section'     => 'section-slider',
				'default'	  => $defaults['homepage-slider-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-slider-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'bizbir' ),
					'page' => esc_html__( 'Page', 'bizbir' ),
					'category' => esc_html__( 'Category', 'bizbir' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post slider:', 'bizbir' ),
				'section'     => 'section-slider',
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Slider', 'bizbir' ),
				],
				'button_label' => esc_html__('Add slider', 'bizbir' ),
				'settings'     => 'homepage-slider-post-repeater',
				'default'	  => $defaults['homepage-slider-post-repeater'],
				'active_callback' => $this->slider_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'bizbir' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
					'sub_title'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Sub Title', 'bizbir' ),
					],
				],
				'choices' => [
					'limit' => 2
				],
			),

			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Page slider:', 'bizbir' ),
				'section'     => 'section-slider',
				
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Slider', 'bizbir' ),
				],
				'button_label' => esc_html__('Add slider', 'bizbir' ),
				'settings'     => 'homepage-slider-page-repeater',
				'default'	  => $defaults['homepage-slider-page-repeater'],
				'active_callback' => $this->slider_content_active_cb( 'page' ),
				'fields' => [
					'page' => [
						'type'        => 'dropdown-pages',
						'label'       => esc_html__( 'Page', 'bizbir' ),
					],
					'sub_title'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Sub Title', 'bizbir' ),
					],
				],
				'choices' => [
					'limit' => 2
				],
			),

			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-slider-category',
				'label'       => esc_html__( 'Select Category:', 'bizbir' ),
				'section'     => 'section-slider',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->slider_content_active_cb( 'category' )
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Category slider content:', 'bizbir' ),
				'section'     => 'section-slider',
				'active_callback' => $this->slider_content_active_cb( 'category' ),
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Slider content', 'bizbir' ),
				],
				'button_label' => esc_html__('Add slider content', 'bizbir' ),
				'settings'     => 'homepage-slider-cat-repeater',
				'choices' => [
					'limit' => $this->count_posts_in_category( 'homepage-slider-category' )
				],
				'fields' => [
					'sub_title'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Sub Title', 'bizbir' ),
					],
				],
				'choices' => [
					'limit' => 2
				],
			),

		);
		
		$featured_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-featured-enable',
				'label'     => esc_html__( 'Enable Featured ?', 'bizbir' ),
				'section'   => 'section-featured',
				'default'   => $defaults['homepage-featured-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-featured-title',
				'label'     => esc_html__( 'Title', 'bizbir' ),
				'section'   => 'section-featured',
				'default'   => $defaults['homepage-featured-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-featured-enable' ),
				'partial_refresh'    => [
					'homepage-featured-title' => [
						'selector'        => '.page-template-tmpl-home .section-featured-page .section-title',
						'render_callback' => function() {
							return 	Bizbir_Theme_Options::get_option( 'homepage-featured-title' );
						},
					],
				],
			),
			array(
				'category'  => 'field',
				'type'      => 'textarea',
				'settings'  => 'homepage-featured-subtitle',
				'label'     => esc_html__( 'Sub title', 'bizbir' ),
				'section'   => 'section-featured',
				'default'   => $defaults['homepage-featured-subtitle'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-featured-enable' ),
				'partial_refresh'    => [
					'homepage-featured-subtitle' => [
						'selector'        => '.page-template-tmpl-home .section-featured-page h5',
						'render_callback' => function() {
							return 	Bizbir_Theme_Options::get_option( 'homepage-featured-subtitle' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-featured-content',
				'label'       => esc_html__( 'Content Type:', 'bizbir' ),
				'section'     => 'section-featured',
				'default'	  => $defaults['homepage-featured-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-featured-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'bizbir' ),
					'page' => esc_html__( 'Page', 'bizbir' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'label'       => esc_html__( 'Featured Post:', 'bizbir' ),
				'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
				'section'     => 'section-featured',
				'settings'     => 'homepage-featured-post',
				'default'	  => $defaults['homepage-featured-post'],
				'active_callback' => $this->featured_content_active_cb( 'post' ),
			),
			array(
				'category'    => 'field',
				'type'        => 'dropdown-pages',
				'label'       => esc_html__( 'Featured Page:', 'bizbir' ),
				'section'     => 'section-featured',
				'settings'     => 'homepage-featured-page',
				'default'	  => $defaults['homepage-featured-page'],
				'active_callback' => $this->featured_content_active_cb( 'page' ),
			),
		);
		
		$cta_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'select',
				'settings'  => 'homepage-cta-enable',
				'label'     => esc_html__( 'Enable "call to action" section on ?', 'bizbir' ),
				'section'   => 'section-cta',
				'default'   => $defaults['homepage-cta-enable'],
				'choices'     => [
					'homepage' => esc_html__( 'Homepage Template', 'bizbir' ),
					'entire-site' => esc_html__( 'Entire Site', 'bizbir' ),
					'disable' => esc_html__( 'Disable', 'bizbir' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'dropdown-pages',
				'label'       => esc_html__( 'Page:', 'bizbir' ),
				'section'     => 'section-cta',
				'settings'     => 'homepage-cta-page',
				'default'	  => $defaults['homepage-cta-page'],
				'active_callback' => $this->section_enable_on_active_cb( 'homepage-cta-enable' ),
			),
		);
		$services_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-services-enable',
				'label'     => esc_html__( 'Enable Services ?', 'bizbir' ),
				'section'   => 'section-services',
				'default'   => $defaults['homepage-services-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-services-title',
				'label'     => esc_html__( 'Title', 'bizbir' ),
				'section'   => 'section-services',
				'default'   => $defaults['homepage-services-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-services-enable' ),
				'partial_refresh'    => [
					'homepage-services-title' => [
						'selector'        => '.page-template-tmpl-home .section-key-features .section-title',
						'render_callback' => function() {
							return 	Bizbir_Theme_Options::get_option( 'homepage-services-title' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'image',
				'label'       => esc_html__( 'Image', 'bizbir' ),
				'section'     => 'section-services',
				'active_callback' => $this->section_enable_active_cb( 'homepage-services-enable' ),
				'default'	  => $defaults['homepage-services-custom-image'],
				'settings'     => 'homepage-services-custom-image',
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Page services:', 'bizbir' ),
				'section'     => 'section-services',
				
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Services', 'bizbir' ),
				],
				'button_label' => esc_html__('Add service', 'bizbir' ),
				'settings'     => 'homepage-services-page-repeater',
				'default'	  => $defaults['homepage-services-page-repeater'],
				'choices' => [
					'limit' => 3
				],
				'active_callback' => $this->section_enable_active_cb( 'homepage-services-enable' ),
				'fields' => [
					'page' => [
						'type'        => 'dropdown-pages',
						'label'       => esc_html__( 'Page', 'bizbir' ),
					],
					'icon'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Icon', 'bizbir' ),
						'description' => __( 'You can choose any of <a href="http://rhythm.nikadevs.com/content/icons-et-line" target="_blank">ET Icons</a>', 'bizbir' ),
					],
				]
			),

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-services-right',
				'active_callback' => $this->section_enable_active_cb('homepage-services-enable'),
				'section'  => 'section-services',
				'default'  => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'Right Services Options', 'bizbir' ) . '</span>',
			),
			
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Page services:', 'bizbir' ),
				'section'     => 'section-services',
				
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'Services', 'bizbir' ),
				],
				'button_label' => esc_html__('Add service', 'bizbir' ),
				'settings'     => 'homepage-services-right-page-repeater',
				'default'	  => $defaults['homepage-services-page-repeater'],
				'choices' => [
					'limit' => 3
				],
				'active_callback' => $this->section_enable_active_cb( 'homepage-services-enable' ),
				'fields' => [
					'page' => [
						'type'        => 'dropdown-pages',
						'label'       => esc_html__( 'Page', 'bizbir' ),
					],
					'icon'  => [
						'type'        => 'text',
						'label'       => esc_html__( 'Icon', 'bizbir' ),
						'description' => __( 'You can choose any of <a href="http://rhythm.nikadevs.com/content/icons-et-line" target="_blank">ET Icons</a>', 'bizbir' ),
					],
				]
			),
		);

		$news_sections = array(
			array(
				'category'  => 'field',
				'type'      => 'toggle',
				'settings'  => 'homepage-news-enable',
				'label'     => esc_html__( 'Enable News ?', 'bizbir' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-enable'],
				'transport' => 'refresh',
			),
			array(
				'category'  => 'field',
				'type'      => 'text',
				'settings'  => 'homepage-news-title',
				'label'     => esc_html__( 'Title', 'bizbir' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-title'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
				'partial_refresh'    => [
					'homepage-news-title' => [
						'selector'        => '.page-template-tmpl-home .section-latest-posts .section-title',
						'render_callback' => function() {
							return 	Bizbir_Theme_Options::get_option( 'homepage-news-title' );
						},
					],
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-news-content',
				'label'       => esc_html__( 'Content Type:', 'bizbir' ),
				'section'     => 'section-news',
				'default'	  => $defaults['homepage-news-content'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
				'choices'     => [
					'post' => esc_html__( 'Post', 'bizbir' ),
					'page' => esc_html__( 'Page', 'bizbir' ),
					'category' => esc_html__( 'Category', 'bizbir' ),
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Post news:', 'bizbir' ),
				'section'     => 'section-news',
				
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'News', 'bizbir' ),
				],
				'button_label' => esc_html__('Add news', 'bizbir' ),
				'settings'     => 'homepage-news-post-repeater',
				'default'	  => $defaults['homepage-news-post-repeater'],
				'active_callback' => $this->news_content_active_cb( 'post' ),
				'fields' => [
					'post' => [
						'type'        => 'select',
						'label'       => esc_html__( 'Post', 'bizbir' ),
						'choices' 	  => Kirki_Helper::get_posts( array( 'post_type' => 'post', 'posts_per_page' => 999 ) ),
					],
				],
				'choices' => [
					'limit' => 3
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'repeater',
				'label'       => esc_html__( 'Page news:', 'bizbir' ),
				'section'     => 'section-news',
				
				'row_label' => [
					'type'  => 'text',
					'value' => esc_html__( 'News', 'bizbir' ),
				],
				'button_label' => esc_html__('Add news', 'bizbir' ),
				'settings'     => 'homepage-news-page-repeater',
				'default'	  => $defaults['homepage-news-page-repeater'],
				'active_callback' => $this->news_content_active_cb( 'page' ),
				'fields' => [
					'page' => [
						'type'        => 'dropdown-pages',
						'label'       => esc_html__( 'Page', 'bizbir' ),
					],
				],
				'choices' => [
					'limit' => 2
				],
			),
			array(
				'category'    => 'field',
				'type'        => 'select',
				'settings'    => 'homepage-news-category',
				'label'       => esc_html__( 'Select Category:', 'bizbir' ),
				'section'     => 'section-news',
				'choices'	  => Kirki_Helper::get_terms( 'category' ),
				'active_callback' => $this->news_content_active_cb( 'category' )
			),
			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-news',
				'active_callback' => $this->section_enable_active_cb('homepage-news-enable'),
				'section'  => 'section-news',
				'default'  => '<span class="customizer-bizbir-title wp-ui-text-highlight">' . __( 'News Options', 'bizbir' ) . '</span>',
			),
			array(
				'category'  => 'field',
				'type'      => 'link',
				'settings'  => 'homepage-news-btn-url',
				'label'     => esc_html__( 'Button link', 'bizbir' ),
				'section'   => 'section-news',
				'default'   => $defaults['homepage-news-btn-url'],
				'active_callback' => $this->section_enable_active_cb( 'homepage-news-enable' ),
			),
		);

		return array_merge( $configs, $homepage_sections, $slider_sections, $featured_sections, $cta_sections, $services_sections, $news_sections );
	}

	private function section_enable_active_cb( $setting ) {
		return [
			[
				'setting'  => $setting,
				'operator' => '===',
				'value'    => true,
			]
		];
	}

	private function section_enable_on_active_cb( $setting ) {
		return [
			[
				'setting'  => $setting,
				'operator' => '!=',
				'value'    => 'disable',
			]
		];
	}

	private function slider_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-slider-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-slider-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function featured_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-featured-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-featured-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}


	private function news_content_active_cb( $value ) {
		return [
			[
				'setting'  => 'homepage-news-enable',
				'operator' => '===',
				'value'    => true,
			],
			[
				'setting'  => 'homepage-news-content',
				'operator' => '===',
				'value'    => $value,
			],
		];
	}

	private function count_posts_in_category( $setting ) {
		$selected_cat = Bizbir_Theme_Options::get_option( $setting );

		$cat = get_category( absint( $selected_cat ) );

		if ( ! empty( $cat->count ) ) {
			return $cat->count;
		} else {
			return 1;
		}

	}
}

new Bizbir_Customizer_Register_Homepage();

