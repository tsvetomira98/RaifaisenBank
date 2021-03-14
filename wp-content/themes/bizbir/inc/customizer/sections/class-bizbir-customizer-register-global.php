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

class Bizbir_Customizer_Register_Global extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {
		$defaults = Bizbir_Theme_Options::load_defaults();

		$selectors = $this->theme_color_element_selectors();

		$container_sections = array(

			array(
				'category' => 'field',
				'type'     => 'custom',
				'settings' => 'field-horizontal-line-container-1',
				'section'  => 'section-global-container-layout',
				'default'  => '<hr>',
				'priority' => 2,
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-global-layout-selection',
				'label'    => esc_html__( 'Layout', 'bizbir' ),
				'section'  => 'section-global-container-layout',
				'default'  => $defaults['field-global-layout-selection'],
				'priority' => 3,
				'multiple' => 1,
				'choices'  => [
					'boxed'      => esc_html__( 'Boxed', 'bizbir' ),
					'full-width' => esc_html__( 'Full width', 'bizbir' ),
				]
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-global-page-layout-selection',
				'label'    => esc_html__( 'Page Layout', 'bizbir' ),
				'section'  => 'section-global-container-layout',
				'default'  => $defaults['field-global-page-layout-selection'],
				'priority' => 4,
				'multiple' => 1,
				'choices'  => [
					'boxed'      => esc_html__( 'Boxed', 'bizbir' ),
					'full-width' => esc_html__( 'Full width', 'bizbir' ),
				],
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-global-blog-layout-selection',
				'label'    => esc_html__( 'Blog Layout', 'bizbir' ),
				'section'  => 'section-global-container-layout',
				'default'  => $defaults['field-global-blog-layout-selection'],
				'priority' => 5,
				'multiple' => 1,
				'choices'  => [
					'boxed'      => esc_html__( 'Boxed', 'bizbir' ),
					'full-width' => esc_html__( 'Full width', 'bizbir' ),
				],
			),
			array(
				'category' => 'field',
				'type'     => 'select',
				'settings' => 'field-global-archives-layout-selection',
				'label'    => esc_html__( 'Archive Layout', 'bizbir' ),
				'section'  => 'section-global-container-layout',
				'default'  => $defaults['field-global-archives-layout-selection'],
				'priority' => 6,
				'multiple' => 1,
				'choices'  => [
					'boxed'      => esc_html__( 'Boxed', 'bizbir' ),
					'full-width' => esc_html__( 'Full width', 'bizbir' ),
				],
			),
		);

		return array_merge( $configs, $container_sections );
	}

	public function theme_color_element_selectors() {
		$selectors = [];

		$selectors['color'] = '
			blockquote:before,
			.section-teams .team-position,
			.section-counter .counter-icon i,
			a:hover,
			a:focus,
			a:active,
			.site-title a:hover,
			.site-title a:focus,
			.site-title a:active,
			#header-nav ul li a:hover,
			#header-nav li.current-menu-item a,
			#header-nav li.current_page_item a,
			#header-nav li:hover > a,
			.header-v1 .main-navigation li > a:hover,
			.header-v1 .main-navigation li.current-menu-item > a,
			.header-v1 .main-navigation li.current-page-item > a,
			.header-v1 .main-navigation li:hover > a,
			.header-v1 .main-navigation ul ul li a:hover,
			.header-v1 .header-box-icon,
			.entry-meta a:hover,
			.entry-meta a:focus,
			.entry-meta a:active,
			.entry-title a:hover,
			.entry-title a:focus,
			.entry-title a:active,
			.widget .tagcloud a:hover,
			.sidebar  ul li a:hover,
			.sidebar  ul li a:focus,
			.sidebar  ul li a:active,
			.list-check li:before,
			#footer-navigation li a:hover,
			.section.section-featured-page li:before,
			.section-services .service-block-item a.service-icon,
			.portfolio-filter a.active, .portfolio-filter a:hover,
			.section-plan .pricing-plan-content li i ,#quick-contact li i,
			.main-navigation li li > a:hover, .main-navigation li li.current-menu-item > a, .main-navigation li li.current-page-item > a, .main-navigation li li:hover > a
		';

		$selectors['background'] = '
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			button,
			.custom-button,
			.custom-button:visited,
			a.button,
			.custom-button.custom-primary-button,
			.custom-button.custom-primary-button:visited,
			.custom-button.custom-secondary-button:hover,
			.quick-link a.quick-button-links,
			.skillbar-bar,
			.main-navigation li a:after,
			.pagination .nav-links .current,
			.pagination .nav-links a:hover,
			.pagination .nav-links a:active,
			.pagination .nav-links a:focus,
			.sidebar .widget-title:after,
			.section-plan .pricing-plan-item.pricing-plan-recommended .pricing-plan-header,
			.section-featured-banner .featured-banner > a::after,
			a.scrollup,
			a.scrollup:visited,
			.section-featured-banner .featured-banner > a::after,
			#content .section-title-wrap span.divider:before,
			.section-featured-slider .cycle-pager .cycle-pager-active,
			.section-featured-slider .cycle-prev:hover,
			.section-featured-slider .cycle-next:hover,
			.custom-button:hover,
			a.button:hover,
			button:focus,
			a.button:hover,
			button:focus,
			a.button:focus,h3.contact-title,
			.custom-button:focus,
			.custom-button:active,
			.custom-button.custom-primary-button:hover,
			 .custom-button.custom-primary-button:active,
			 .custom-button.custom-primary-button:focus,
			 .section-carousel-enabled .slick-prev.slick-arrow:hover,
			  .section-carousel-enabled .slick-next.slick-arrow:hover,
			  .woocommerce #respond input#submit,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt
		';

		$selectors['border'] = '
			.pagination .nav-links .current,
			.pagination .nav-links a:hover,
			.pagination .nav-links a:active,
			.pagination .nav-links a:focus,
			.widget .tagcloud a:hover,
			.portfolio-filter a.active, .portfolio-filter a:hover,
			#content .section-title-wrap span.divider
		';

		$selectors['button-color'] = '
			 .custom-button,
			.custom-button:visited,
			a.button.custom-button,
			a.button.custom-button:visited
			.custom-button.custom-primary-button,
			.custom-button.custom-primary-button:visited,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.bizbir-btn-mediu a.more-link,
			.bizbir-btn-mediu .pagination .nav-links .page-numbers,
			.bizbir-btn-mediu .bizbir-pagination button
			.bizbir-btn-mediu .bizbir-pagination > a,
			.bizbir-btn-mediu .slider-buttons .custom-button
		';

		return $selectors;
	}

}

new Bizbir_Customizer_Register_Global();


