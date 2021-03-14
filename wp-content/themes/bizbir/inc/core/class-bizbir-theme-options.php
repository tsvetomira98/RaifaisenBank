<?php
/**
 * Theme options for getters and setters
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Bizbir_Theme_Options
 *
 * Bizbir Theme options pull class
 */
class Bizbir_Theme_Options {

	public function __construct() {
		add_action( 'after_theme_setup', array( $this, 'load_defaults' ) );
	}

	/**
	 * Get singular theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_option( $option ) {
		$defaults = self::load_defaults();

		$theme_options = ! empty( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );

		$theme_options = apply_filters( 'bizbir_filter_get_option', $theme_options, $option );

		return $theme_options;
	}

	/**
	 * Get all theme data
	 *
	 * @param $option
	 *
	 * @return mixed
	 */
	static function get_options( $option = '' ) {
		$theme_options = get_theme_mods();

		$theme_options = apply_filters( 'bizbir_filter_get_options', $theme_options, $option );

		$value = ! empty( $theme_options[ $option ] ) ? $theme_options[ $option ] : $theme_options;

		return apply_filters( "bizbir_get_option_{$option}", $value, $option );
	}

	/**
	 * Save Page Settings
	 *
	 * @param $name
	 * @param $value
	 * @return void
	 */
	static function update_bizbir_page_meta( $name, $value, $post_id = 0 ) {
		$mods      = self::get_bizbir_page_meta( $post_id );
		$old_value = isset( $mods[ $name ] ) ? $mods[ $name ] : false;
	
		$mods[ $name ] = apply_filters( "bizbir_pre_set_page_setting_{$name}", $value, $old_value );
		
		update_post_meta( $post_id, 'bizbir_page_setting', $mods );
	}

	/**
	 * Get Page Settings
	 *
	 * @return mixed
	 */
	static function get_bizbir_page_meta( $post_id ) {
		$mods = get_post_meta( $post_id, "bizbir_page_setting", true );
		if ( !empty( $mods ) ) {
			return $mods;
		} else {
			return false;
		}
	}

	/**
	 * Get Page Setting by ID and Name
	 *
	 * @param $page_id
	 * @param $meta_name
	 * @return mixed
	 */
	static function get_page_setting( $meta_name, $page_id = '' ) {
		$page_id = !empty( $page_id ) ? $page_id : get_queried_object_id();
		$page_meta = !empty( $page_id ) ? self::get_bizbir_page_meta( $page_id ) : false;
		if( !empty( $page_meta ) && !empty( $page_meta[$meta_name] ) ) {
			return $page_meta[$meta_name];
		} else {
			return false;
		}
	}

	/**
	 * Load Default data in initial setup process
	 */
	static function load_defaults() {
		// Get default post id
		$posts = get_posts( array( 'numberposts' => 1, 'fields' => 'ids' ) );
		$default_post = 1;
		if ( ! empty( $posts ) ) {
			$default_post = $posts[0];
		}
		
		// Get default page id
		$pages = get_posts( array( 'numberposts' => 1, 'post_type' => 'page', 'fields' => 'ids' ) );
		$default_page = 1;
		if ( ! empty( $pages ) ) {
			$default_page = $pages[0];
		}

		$defaults = array(
			// Container
			'field-global-layout-selection'          => 'full-width',
			'field-global-page-layout-selection'     => 'full-width',
			'field-global-blog-layout-selection'     => 'full-width',
			'field-global-archives-layout-selection' => 'full-width',
			
			// Header
			'field-header-mobile-menu-background'    => '#333',
			'field-header-mobile-menu-text-color'    => '#fff',
			'field-header-mobile-menu-hamburger'     => '#ffffff',
			'field-header-menu-sticky'               => true,
			'field-header-menu-disable'              => false,
			'field-header-menu-disable-search'       => false,
			'field-header-menu-disable-minicart'     => false,
			'field-header-menu-sticky-background'             => 'rgba(10,10,10,0.75)',
			'field-header-menu-sticky-hide-logo-mobile'       => false,

			// Site identity
			'field-identity-logo-width'                       => '55',
			'field-identity-display-site-title'               => true,
			'field-identity-display-site-tagline'             => true,
			'field-identity-site-title-typography'            => array(
				'font-size'      => '26px',
				'text-transform' => 'none',
				'font-family'    => 'Roboto',
				'variant'        => '',
				'color'          => '#2761d8',
				'font-backup'    => '',
				'font-weight'    => 700,
				'font-style'     => 'normal',
			),
			'field-identity-site-tagline'                     => array(
				'font-size'      => '16px',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
				'font-family'    => 'Roboto',
				'variant'        => '',
				'color'          => '#222',
				'font-backup'    => '',
				'font-weight'    => '',
				'font-style'     => 'normal',
			),
			
			// Blog
			'field-blog-archive-column'               => 12,
			'field-blog-date'                                 => true,
			'field-blog-author-enable'                        => true,
			'field-blog-tag-enable'                           => true,
			'field-blog-category-enable'                      => true,
			'field-single-author-info-enable'                      => true,
			'field-single-pagination-enable'				=> true,
			'field-blog-comments-enable'                      => true,
			'field-blog-excerpt-length'                      => 30,
			'field-blog-read-more' =>	esc_html__( 'Read More', 'bizbir' ),
			'field-blog-post-pagination'                      => 'numeric',
			'field-pagination-alignment'                      => 'center-align-pagination',

			// Footer
			'field-footer-bar-enable-scrollup'       => true,
			'field-footer-bar-enable-scrollup-color' => '#000000',
			'field-footer-bar-background-color'      => '#ffffff',
			'field-footer-bar-enable'                         => true,
			'field-footer-widget-layout'                      => 'wd-four',
			'field-footer-widget-border-top'                  => '0',
			'field-footer-widget-background-color'            => '#080f1e',
			'field-footer-widget-heading-color'            => '#fff',
			'field-footer-widget-typography-link-hover-color' => '#254099',

			// Sidebar
			'field-sidebar-type'                              => 'right',
			'field-sidebar-post'                              => 'default',
			'field-sidebar-page'                              => 'none',
			'field-sidebar-archive'                           => 'default',
			'field-sidebar-heading-color'                     => '#222',
			
			// Breadcrumb
			'field-breadcrumb-seperator'                      => '»',
			'field-breadcrumb-type'                           => 'after-title',
			'field-breadcrumb-disable-homepage'               => true,
			'field-breadcrumb-disable-blog'                   => false,
			'field-breadcrumb-disable-single-page'            => false,
			'field-breadcrumb-disable-single-post'            => false,
			'field-breadcrumb-disable-single'                 => false,
			'field-breadcrumb-disable-search'                 => false,
			'field-breadcrumb-disable-archive'                => false,
			'field-breadcrumb-disable-404'                    => false,
			'field-breadcrumb-alignment'                      => 'center',


			/*Homepage*/
			// Homepage sorting
			'field-homepage-sort' => [
				'Slider',
				'Featured',
				'CTA',
				'Services',
				'News',
			],

			// Slider
			'homepage-slider-enable' => true,
			'homepage-slider-content' => 'post',
			'homepage-slider-post-repeater' => [
				[
					'post'		=> $default_post,
					'sub_title'  => esc_html__( 'We Are Creative & Digital Studio', 'bizbir' ),
					'button_1_txt' => esc_html__( 'Learn More', 'bizbir' ),
					'button_1_url' => '#',
				],
				[
					'post'		=> $default_post,
					'sub_title'  => esc_html__( 'We Are Creative & Digital Studio', 'bizbir' ),
					'button_1_txt' => esc_html__( 'Learn More', 'bizbir' ),
					'button_1_url' => '#',
				],
			],
			'homepage-slider-page-repeater' => [
				[
					'page'		=> $default_page,
					'sub_title'  => esc_html__( 'We Are Creative & Digital Studio', 'bizbir' ),
				],
				[
					'page'		=> $default_page,
					'sub_title'  => esc_html__( 'We Are Creative & Digital Studio', 'bizbir' ),
				],
			],


			// Featured
			'homepage-featured-enable' => true,
			'homepage-featured-subtitle' => esc_html__( 'We are a Creative Agency & Believe in Perfection & Creativity.', 'bizbir' ),
			'homepage-featured-title' => esc_html__( 'Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.', 'bizbir' ),
			'homepage-featured-content' => 'post',
			'homepage-featured-page' => strval($default_page),
			'homepage-featured-post' => strval($default_post),

			// Call to action
			'homepage-cta-enable' => 'homepage',
			'homepage-cta-content' => 'page',
			'homepage-cta-page' => strval($default_post), // converted to string since field type select provides value 

			// News
			'homepage-news-enable' => true,
			'homepage-news-title' => esc_html__( 'Recent News', 'bizbir' ),
			'homepage-news-content' => 'post',
			'homepage-news-post-repeater' => [
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
				[
					'post'		=> $default_post,
				],
			],
			'homepage-news-page-repeater' => [
				[
					'page'		=> $default_page,
				],
				[
					'page'		=> $default_page,
				],
				[
					'page'		=> $default_page,
				],
			],
			'homepage-news-btn-url' => '#',

			// Services
			'homepage-services-enable' => true,
			'homepage-services-title' => esc_html__( 'We Provided Services Since 1963', 'bizbir' ),
			'homepage-services-content' => 'page',
			'homepage-services-page-repeater' => [
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
			],
			'homepage-services-right-page-repeater' => [
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
				[
					'page'		=> $default_page,
					'icon'  => 'tools',
				],
			],
			'homepage-services-custom-image'  => '',

		);

		return apply_filters( 'bizbir_theme_defaults', $defaults );
	}
}

new Bizbir_Theme_Options();