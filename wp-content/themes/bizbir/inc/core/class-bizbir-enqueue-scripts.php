<?php
/**
 * Script enqueue
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Bizbir_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Bizbir_Enqueue_Scripts {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Load Assets into array
		 *
		 * @return mixed
		 */
		private function theme_assets() {
			$default_assets = array(
				'js'      => array(
					'bizbir-custom' => 'custom',
					'skip-link-focus-fix' => 'skip-link-focus-fix',
					'bizbir-navigation' => 'navigation'
				),

				'css'     => array(
					'bizbir-man' => 'main',
					'bizbir-custom' => 'custom',
					'bizbir-ecommerce' => 'ecommerce',
				),

				'vendors_css' => array(
					'slick'        => 'slick/css/slick',
					'swipercss'        => 'swiper/css/swiper',
					'animate'        => 'wow/css/animate',
					'prettyPhoto'        => 'prettyphoto/css/prettyPhoto',
					'magnific-popup'        => 'magnific-popup/css/magnific-popup',
					'accordion'        => 'accordionjs/css/accordion',
					'fontAwesome'        => 'fontawesome/css/all',
					'icons'        => 'icons/icons',
				),
				'vendors_js' => array(
					'swiper'        => 'swiper/js/swiper',
					'slick'        => 'slick/js/slick',
					'wow'        => 'wow/js/wow',
					'counterup'        => 'counter-up/js/jquery.counterup',
					'bizbir-accordion'        => 'accordionjs/js/accordion',
					'prettyPhoto'        => 'prettyphoto/js/jquery.prettyPhoto',
					'magnific-popup'        => 'magnific-popup/js/jquery.magnific-popup',
					'imagesloaded'        => 'imagesloaded/imagesloaded.pkgd',
				),
			);

			return apply_filters( 'bizbir_theme_assets', $default_assets );
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {
			$this->enqueue_fonts();

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';

			$js_uri     = CODEMANAS_THEME_URL . 'assets/scripts/';
			$css_uri    = CODEMANAS_THEME_URL . 'assets/styles/';
			$vendor_uri = CODEMANAS_THEME_URL . 'assets/vendors/';

			// All assets.
			$all_assets = $this->theme_assets();
			$styles     = $all_assets['css'];
			$scripts    = $all_assets['js'];
			$vendors_css    = $all_assets['vendors_css'];
			$vendors_js    = $all_assets['vendors_js'];

			if ( is_array( $styles ) && ! empty( $styles ) ) {
				// Register & Enqueue Styles.
				foreach ( $styles as $key => $style ) {

					$uri = filter_var( $style, FILTER_VALIDATE_URL ) ? $style : $css_uri . $style;

					// Generate CSS URL.
					$css_file = $uri . $file_prefix . '.css';

					// Register.
					wp_register_style( $key, $css_file, false, CODEMANAS_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );
				}
			}

			if ( is_array( $scripts ) && ! empty( $scripts ) ) {
				// Register & Enqueue Scripts.
				foreach ( $scripts as $key => $script ) {

					// Register.
					wp_register_script( $key, $js_uri . $script . $file_prefix . '.js', array( 'jquery' ), CODEMANAS_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			if ( is_array( $vendors_css ) && ! empty( $vendors_css ) ) {
				// Register & Enqueue Scripts.
				foreach ( $vendors_css as $key => $vendor ) {

					// Register.
					wp_register_style( $key, $vendor_uri . $vendor . $file_prefix . '.css', false, CODEMANAS_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );
				}
			}

			if ( is_array( $vendors_js ) && ! empty( $vendors_js ) ) {
				// Register & Enqueue Scripts.
				foreach ( $vendors_js as $key => $vendor ) {

					// Register.
					wp_register_script( $key, $vendor_uri . $vendor . $file_prefix . '.js', array( 'jquery' ), CODEMANAS_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			$this->localize_scripts();
		}

		function enqueue_fonts() {
			wp_enqueue_style( 'bizbir-google-fonts', '//fonts.googleapis.com/css?family=Lato:400,500,600,700|Roboto+Condensed:300,300i,400,400i,500,700,700i|Roboto:300,300i,400,400i,500,500i,700,900', false );
		}

		/**
		 * Script Localizations
		 */
		function localize_scripts() {
			$options = array(
				'loader_bg'       => Bizbir_Theme_Options::get_option( 'field-global-theme-color' ),
				'ajaxurl'             => admin_url( 'admin-ajax.php' ),
				'ajaxButtonType'      => Bizbir_Theme_Options::get_option( 'field-blog-post-pagination' ),
				'ajaxLoadMoreLocales' => array(
					'loading'   => __( 'Loading...', 'bizbir' ),
					'load_more' => __( 'Load More', 'bizbir' ),
					'error'     => __( 'Error loading the posts.', 'bizbir' ),
				),
			);

			wp_localize_script( 'bizbir-custom', 'bizbir_options', $options );

			wp_localize_script( 'bizbir-navigation', 'bizbirScreenReaderText', array(
				'expand'   => esc_html__( 'expand child menu', 'bizbir' ),
				'collapse' => esc_html__( 'collapse child menu', 'bizbir' ),
			) );
		}
	}

	new Bizbir_Enqueue_Scripts();
}
