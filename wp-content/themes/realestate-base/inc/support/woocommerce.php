<?php
/**
 * WooCommerce support class.
 *
 * @package Realestate_Base
 */

/**
 * Woocommerce support class.
 *
 * @since 1.0.0
 */
class Realestate_Base_Woocommerce {

	/**
	 * Construcor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$this->setup();
		$this->init();

	}

	/**
	 * Initial setup.
	 *
	 * @since 1.0.0
	 */
	function setup() {
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	function init() {

		// Wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( $this, 'woo_wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'woo_wrapper_end' ), 10 );

		// Breadcrumb.
		add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'custom_woocommerce_breadcrumbs_defaults' ) );
		add_action( 'wp', array( $this, 'hooking_woo' ) );

		// Sidebar.
		add_action( 'woocommerce_sidebar', array( $this, 'add_secondary_sidebar' ), 11 );

		// Modify global layout.
		add_filter( 'realestate_base_filter_theme_global_layout', array( $this, 'modify_global_layout' ), 15 );

	}

	/**
	 * Hooking Woocommerce.
	 *
	 * @since 1.0.0
	 */
	function hooking_woo() {

		// Fix page title.
		add_filter( 'woocommerce_show_page_title' , '__return_false' );

		add_filter( 'realestate_base_filter_custom_page_title', array( $this, 'custom_shop_title' ), 11 );

		// Fix single product title.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

		// Remove default breadcrumb.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		if ( 'disabled' !== realestate_base_get_option( 'breadcrumb_type' ) && is_woocommerce() ) {
			add_action( 'realestate_base_action_breadcrumb', 'woocommerce_breadcrumb' );
			remove_action( 'realestate_base_action_breadcrumb', 'realestate_base_add_breadcrumb' );
		}

		// Fixing primary sidebar.
		$global_layout = realestate_base_get_option( 'global_layout' );
		$global_layout = apply_filters( 'realestate_base_filter_theme_global_layout', $global_layout );
		if ( in_array( $global_layout, array( 'no-sidebar' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

	}

	/**
	 * Modify global layout.
	 *
	 * @since 1.0.0
	 */
	function modify_global_layout( $layout ) {

		// Fix for shop page.
		if ( is_shop() && ( $shop_id = absint( wc_get_page_id( 'shop' ) ) ) > 0 ) {
			$post_options = get_post_meta( $shop_id, 'realestate_base_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = esc_attr( $post_options['post_layout'] );
			}
		}

		return $layout;

	}

	/**
	 * Add secondary sidebar in Woocommerce.
	 *
	 * @since 1.0.0
	 */
	function add_secondary_sidebar() {

		$global_layout = realestate_base_get_option( 'global_layout' );
		$global_layout = apply_filters( 'realestate_base_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

	}

	/**
	 * Woocommerce content wrapper start.
	 *
	 * @since 1.0.0
	 */
	function woo_wrapper_start() {
		echo '<div id="primary">';
		echo '<main role="main" class="site-main" id="main">';
	}

	/**
	 * Woocommerce content wrapper end.
	 *
	 * @since 1.0.0
	 */
	function woo_wrapper_end() {
		echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
	}

	/**
	 * Woocommerce breadcrumb defaults.
	 *
	 * @since 1.0.0
	 *
	 * @param array $defaults Breadcrumb defaults.
	 * @return array Modified breadcrumb defaults.
	 */
	function custom_woocommerce_breadcrumbs_defaults( $defaults ) {

		$defaults['delimiter']   = '';
		$defaults['wrap_before'] = '<div id="breadcrumb" itemprop="breadcrumb"><ul id="crumbs">';
		$defaults['wrap_after']  = '</ul></div>';
		$defaults['before']      = '<li>';
		$defaults['after']       = '</li>';
		$defaults['home']        = get_bloginfo( 'name', 'display' );

		return $defaults;
	}

	/**
	 * Modify shop title.
	 *
	 * @param  string $title Title.
	 * @return string Modified title.
	 */
	function custom_shop_title( $title ) {

		if ( is_shop() ) {
			$shop_page_id = get_option( 'woocommerce_shop_page_id' );
			if ( absint( $shop_page_id ) > 0 ) {
				$title = get_the_title( absint( $shop_page_id ) );
			}
		}

		return $title;
	}

} // End class.


// Initialize.
$realestate_base_woocommerce = new Realestate_Base_Woocommerce();
