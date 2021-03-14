<?php
/**
 * Registering section for customizer
 *
 * @package     Bizbir
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Bizbir_Customizer_Register_Sections extends Bizbir_Customizer_Conifg_Base {

	public function register_configuration( $configs ) {

		$global_sections = array(
			array(
				'name'     => 'section-global-container-layout',
				'category' => 'section',
				'priority' => 1,
				'title'    => esc_html__( 'Container', 'bizbir' ),
				'panel'    => 'panel-global'
			),
			array(
				'name'     => 'section-global-loader',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Loader', 'bizbir' ),
				'panel'    => 'panel-global'
			),
			//Typography
			array(
				'name'     => 'section-global-typography',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Typography', 'bizbir' ),
				'panel'    => 'panel-global'
			),
			//Colors
			array(
				'name'        => 'section-global-colors',
				'category'    => 'section',
				'priority'    => 3,
				'title'       => esc_html__( 'Colors', 'bizbir' ),
				'panel'       => 'panel-global',
			),

			//Buttons
			array(
				'name'     => 'section-global-buttons',
				'category' => 'section',
				'priority' => 4,
				'title'    => esc_html__( 'Buttons', 'bizbir' ),
				'panel'    => 'panel-global'
			)
		);

		$header_sections = array(
			//Site Identity
			array(
				'name'               => 'title_tagline',
				'category'           => 'section',
				'priority'           => 2,
				'title'              => __( 'Site Identity', 'bizbir' ),
				'panel'              => 'panel-header',
				'description_hidden' => true,
			),

			//Primary Header
			array(
				'name'     => 'section-header-primary',
				'category' => 'section',
				'priority' => 2,
				'title'    => esc_html__( 'Primary Header & Menus', 'bizbir' ),
				'panel'    => 'panel-header'
			),

			//Sticky Header
			array(
				'name'     => 'section-header-sticky',
				'category' => 'section',
				'priority' => 5,
				'title'    => esc_html__( 'Sticky Header', 'bizbir' ),
				'panel'    => 'panel-header'
			),

		);

		$home_page_sections = array(
			array(
				'name'               => 'section-homepage-sort',
				'category'           => 'section',
				'priority'           => 10,
				'title'              => __( 'Sort sections', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-slider',
				'category'           => 'section',
				'priority'           => 20,
				'title'              => __( 'Slider', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-features',
				'category'           => 'section',
				'priority'           => 40,
				'title'              => __( 'Features', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-featured',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Featured section', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-cta',
				'category'           => 'section',
				'priority'           => 55,
				'title'              => __( 'Call to Action', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-services',
				'category'           => 'section',
				'priority'           => 56,
				'title'              => __( 'Services', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-showcase',
				'category'           => 'section',
				'priority'           => 60,
				'title'              => __( 'Showcases', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-news',
				'category'           => 'section',
				'priority'           => 70,
				'title'              => __( 'News', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-video',
				'category'           => 'section',
				'priority'           => 80,
				'title'              => __( 'Video', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-team',
				'category'           => 'section',
				'priority'           => 90,
				'title'              => __( 'Team', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-counter',
				'category'           => 'section',
				'priority'           => 100,
				'title'              => __( 'Counter', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-skill',
				'category'           => 'section',
				'priority'           => 110,
				'title'              => __( 'Skill', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-testimonial',
				'category'           => 'section',
				'priority'           => 120,
				'title'              => __( 'Testimonial', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-works',
				'category'           => 'section',
				'priority'           => 130,
				'title'              => __( 'Works', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-contact',
				'category'           => 'section',
				'priority'           => 140,
				'title'              => __( 'Contact', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-projects',
				'category'           => 'section',
				'priority'           => 150,
				'title'              => __( 'Projects', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-steps',
				'category'           => 'section',
				'priority'           => 160,
				'title'              => __( 'Steps', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-pricing',
				'category'           => 'section',
				'priority'           => 170,
				'title'              => __( 'Pricing', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-newsletter',
				'category'           => 'section',
				'priority'           => 180,
				'title'              => __( 'Newsletter', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			),
			array(
				'name'               => 'section-partners',
				'category'           => 'section',
				'priority'           => 200,
				'title'              => __( 'Partners', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-homepage'
			)
		);
		
		$contact_tpl_sections = array(
			array(
				'name'        => 'section-tmpl-contact-map',
				'category'    => 'section',
				'priority'    => 10,
				'title'       => __( 'Form & Map', 'bizbir' ),
				'panel'       => 'panel-contact',

			),

			array(
				'name'        => 'section-tmpl-contact-connects',
				'category'    => 'section',
				'priority'    => 20,
				'title'       => __( 'Social Connects', 'bizbir' ),
				'panel'       => 'panel-contact',

			),
		);

		$about_sections = array(
			array(
				'name'               => 'section-about-sort',
				'category'           => 'section',
				'priority'           => 10,
				'title'              => __( 'Sort sections', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			array(
				'name'               => 'section-about-services',
				'category'           => 'section',
				'priority'           => 30,
				'title'              => __( 'Services', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			array(
				'name'               => 'section-about-features',
				'category'           => 'section',
				'priority'           => 40,
				'title'              => __( 'Features', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			array(
				'name'               => 'section-about-featured',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Featured section', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			array(
				'name'               => 'section-about-showcase',
				'category'           => 'section',
				'priority'           => 60,
				'title'              => __( 'Showcases', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			
			array(
				'name'               => 'section-about-cta',
				'category'           => 'section',
				'priority'           => 80,
				'title'              => __( 'CTA', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),

			array(
				'name'               => 'section-about-skill',
				'category'           => 'section',
				'priority'           => 110,
				'title'              => __( 'Skill', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			
			array(
				'name'               => 'section-about-newsletter',
				'category'           => 'section',
				'priority'           => 180,
				'title'              => __( 'Newsletter', 'bizbir' ),
				'description_hidden' => true,
				'panel'				 => 'panel-about'
			),
			
		);

		$breadrumb_sections = array(
			array(
				'name'               => 'section-breadcrumbs',
				'category'           => 'section',
				'priority'           => 30,
				'title'              => __( 'Breadcrumbs', 'bizbir' ),
				'description_hidden' => false,
			)
		);
		
		$blog_sections = array(
			array(
				'name'        => 'section-blog-archive',
				'category'    => 'section',
				'priority'    => 40,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect archive/blog listing page.', 'bizbir' ),
				'title'       => __( 'Blog/Archive Page', 'bizbir' ),
			),
			array(
				'name'        => 'section-single-post',
				'category'    => 'section',
				'priority'    => 45,
				'panel'       => 'panel-blog',
				'description' => esc_html__( 'Note: This option will effect only in single posts.', 'bizbir' ),
				'title'       => __( 'Single Posts', 'bizbir' ),
			),
			array(
				'name'     => 'section-blog-pagination',
				'category' => 'section',
				'priority' => 46,
				'panel'    => 'panel-blog',
				'title'    => __( 'Pagination', 'bizbir' ),
			)
		);

		$sidebar_sections = array(
			array(
				'name'               => 'section-sidebar',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Sidebar', 'bizbir' ),
				'description_hidden' => true,
			)
		);

		$footer_sections = array(
			//Footer Widgets
			array(
				'name'               => 'section-footer-widgets',
				'category'           => 'section',
				'priority'           => 50,
				'title'              => __( 'Footer Widgets', 'bizbir' ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			),
			array(
				'name'               => 'section-footer-menu',
				'category'           => 'section',
				'priority'           => 55,
				'title'              => __( 'Footer Menus', 'bizbir' ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			),
			array(
				'name'               => 'section-footer-bar',
				'category'           => 'section',
				'priority'           => 60,
				'title'              => __( 'Last Footer Bar & Scroll Up', 'bizbir' ),
				'description_hidden' => true,
				'panel'              => 'panel-footer'
			)
		);

		return array_merge( $configs, $global_sections, $header_sections, $home_page_sections, $about_sections, $contact_tpl_sections, $breadrumb_sections, $blog_sections, $sidebar_sections, $footer_sections );
	}
}

new Bizbir_Customizer_Register_Sections();