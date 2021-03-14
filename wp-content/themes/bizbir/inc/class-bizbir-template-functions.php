<?php
/**
 * Template Override functions here
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_Template_Functions' ) ) {

	class Bizbir_Template_Functions {
		/**
		 * Primary Header
		 *
		 * @author CodeManas
		 * @since 1.0.0
		 */
		static function master_header() {
			get_template_part( 'template-parts/header/header-main-layout' );
		}

		/**
		 * Mobile menu
		 *
		 * @author CodeManas
		 * @since 1.0.0
		 */
		static function mobile_menu() {
			?>
			<a href="#" id="mobile-trigger" class="open-sidr"><i class="fa fa-list" aria-hidden="true"></i></a>
				<div id ="mob-menu">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'container'		 => 'ul',
						'menu_class'  => 'primary-menu',
						'menu' => 'primary-menu'
					) );
					?>
				</div>
			<?php
		}

		/**
		 * Show Breadcrumbs and background image
		 *
		 * @since 1.0.0
		 * @author Deepen
		 */
		static function after_header_contents() {
			$banner = true;
			//If banner exists show this instead of breacrumbs only
			if ( ! empty( $banner ) ) {
				if( ! is_page_template( 'custom-tmpl/tmpl-home.php' ) ){
					get_template_part( 'template-parts/header/top-banner-image' );
				}
			}
		}

		/**
		 * Get type of breadcrumb and layout
		 *
		 * @param $part
		 * @param string $type
		 */
		static function get_breadcrumbs( $part ) {
			$breacrumbs = self::breadcrumb_conditions();
			if ( ! empty( $breacrumbs['field-breadcrumb-type'] ) ) {
				get_template_part( 'template-parts/header/' . $part );
			}
		}

		/**
		 * Breadcrumb conditions
		 * @return mixed
		 */
		static function breadcrumb_conditions() {
			$breacrumbs = array(
				'field-breadcrumb-type'                => Bizbir_Theme_Options::get_option( 'field-breadcrumb-type' ),
				'field-breadcrumb-disable-homepage'    => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-homepage' ),
				'field-breadcrumb-disable-blog'        => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-blog' ),
				'field-breadcrumb-disable-single'      => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-single' ),
				'field-breadcrumb-disable-single-page' => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-single-page' ),
				'field-breadcrumb-disable-single-post' => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-single-post' ),
				'field-breadcrumb-disable-archive'     => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-archive' ),
				'field-breadcrumb-disable-404'         => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-404' ),
				'field-breadcrumb-disable-search'      => Bizbir_Theme_Options::get_option( 'field-breadcrumb-disable-search' ),
			);

			//Disable on homepage
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-homepage'] ) ) {
				if ( is_front_page() ) {
					return;
				}
			}

			//Disable on Blog Listing page
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-blog'] ) ) {
				if ( is_home() ) {
					return;
				}
			}

			//Override Setting on all single pages and posts
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single'] ) ) {
				if ( is_singular() ) {
					return;
				}
			}

			//Disable on Single pages
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single-page'] ) ) {
				if ( is_page() ) {
					return;
				}
			}

			//Disable on Single post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-single-post'] ) ) {
				if ( is_single() ) {
					return;
				}
			}

			//Disable on Archive post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-archive'] ) ) {
				if ( is_archive() ) {
					return;
				}
			}

			//Disable on Archive post
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-404'] ) ) {
				if ( is_404() ) {
					return;
				}
			}

			//Disable on Search page
			if ( ! empty( $breacrumbs['field-breadcrumb-disable-search'] ) ) {
				if ( is_search() ) {
					return;
				}
			}

			return $breacrumbs;
		}

		/**
		 * Main footer render
		 */
		static function footer_widgets() {
			$footer_setting = Bizbir_Theme_Options::get_page_setting( 'footer-widget-display' );
			if( !empty( $footer_setting ) && $footer_setting === "disable" && $footer_setting !== "global" ) {
				$layout = false;
			} else {
				$layout = Bizbir_Theme_Options::get_option( 'field-footer-widget-layout' );
			}

			if( !$layout ) {
				return;
			}

			if ( ! empty( $layout ) && $layout === "no-widget" ) {
				return;
			}

			get_template_part( 'template-parts/footer/footer-widgets' );
		}

		/**
		 * Super footer render
		 */
		static function footer_site_info() {
			get_template_part( 'template-parts/footer/footer-site-info' );
		}

		/*
		 * Add Scroll to Top functionality
		 */
		static function bizbir_scrollToTop() {
			$scroller = Bizbir_Theme_Options::get_option( 'field-footer-bar-enable-scrollup' );
			if ( ! empty( $scroller ) ) {
				?>
		        <div id="btn-scrollup">
        			<a  title="<?php esc_attr_e( 'Go Top', 'bizbir' ); ?>"  class="scrollup button-circle" href="#"><i class="fas fa-angle-up"></i></a>
        		</div>
				<?php
			}
		}
	}

	new Bizbir_Template_Functions();
}

