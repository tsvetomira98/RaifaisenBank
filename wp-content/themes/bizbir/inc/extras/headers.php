<?php
/**
 * Head Render hook add action here
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bizbir_masthead_logo() {
	$display_site_title   = get_bloginfo( 'name' );
	$display_site_tagline = get_bloginfo( 'description' );
	$custom_logo          = has_custom_logo();

	$site_title_enable   = Bizbir_Theme_Options::get_option( 'field-identity-display-site-title' );
	$site_tagline_enable = Bizbir_Theme_Options::get_option( 'field-identity-display-site-tagline' );
	?>
    <div class="site-branding pull-left">
		<div id="site-identity">
			<?php
			//If we have a logo
			if ( $custom_logo ) {
				//Filter out the sizes first
				add_filter( 'wp_get_attachment_image_src', 'bizbir_header_logo_attr', 10, 4 );

				echo get_custom_logo();

				//UNhook to remove any errors that might be caused in other images
				remove_filter( 'wp_get_attachment_image_src', 'bizbir_header_logo_attr', 10 );
			}
			?>

			<?php if ( ! empty( $site_title_enable ) || ! empty( $site_tagline_enable ) ) { ?>

				<div class="site-title-wrapper">

					<?php if ( ! empty( $site_title_enable ) ) { ?>
			            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $display_site_title; ?></a></h1>
					<?php }

					if ( ! empty( $site_tagline_enable ) ) { ?>
			            <p class="site-tagline"><?php echo $display_site_tagline; ?></p>
					<?php } ?>
				</div>

			<?php } ?>

		</div><!-- #site-identity -->
	</div><!-- .site-branding -->


	<?php
}

function bizbir_header_search_trigger() { ?>

	<div id="header-search" class="pull-right">
		<a href="#" id="search-button" class=" search-icon"><i class="fa fa-search"></i></a>
	</div>

	<?php
}

function bizbir_masthead_search() {
	$disable_search = Bizbir_Theme_Options::get_option( 'field-header-menu-disable-search' );

	if ( $disable_search ) {
		return;
	}
	?>
	<div class="search-box-wrap">
		<div class="searchform" role="search">
			<?php get_search_form(); ?>
		</div><!-- .searchform -->
	</div><!-- .search-box-wrap -->
	<?php
}

if( class_exists( 'woocommerce' ) ) {

	add_filter( 'woocommerce_add_to_cart_fragments', 'bizbir_refresh_mini_cart_count');
	function bizbir_refresh_mini_cart_count($fragments){
	    ob_start();
	    ?>

	    <span id="bizbir-woo-cart-count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span>

	    <?php
	    $fragments['#bizbir-woo-cart-count'] = ob_get_clean();
	    return $fragments;
	}
}

function bizbir_header_right_wrapper_start() {
?>
	<div id="header-right" class="pull-right">
<?php
}

function bizbir_header_right_wrapper_end() {
?>
	</div>
<?php
}

function bizbir_header_right_head_start() {
?>
	<div class="right-head pull-right">
<?php
}

function bizbir_header_right_head_end() {
?>
	</div>
<?php
}

function bizbir_masthead_mini_cart() {
	if( ! class_exists( 'woocommerce' ) ) {
		return;
	}
	$disable_minicart = Bizbir_Theme_Options::get_option( 'field-header-menu-disable-minicart' );

	if ( $disable_minicart ) {
		return;
	}
	?>

		<div id="header-right" class="pull-right">
			<div class="hearder-min-cart">
				<ul>
					<li class="cart-button mini-cart-wrap">
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class=" icon-basket"></i><span><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span></a>
					</li>
				</ul>
			</div>
		</div>
	<?php
}

/**
 * Head navigation primary menu
 */
function bizbir_masthead_nav() {

	$disable_menu = Bizbir_Theme_Options::get_option( 'field-header-menu-disable' );
	if ( ! $disable_menu ) { ?>
		<div id="main-navigation" class="pull-left">
			<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="fas fa-bars"></i><span class="menu-label"><?php esc_html_e( 'Menu', 'bizbir' ); ?></span>
			</button>

			<div id="site-header-menu" class="site-primary-menu">
				<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'bizbir' ); ?>">
					<?php wp_nav_menu( array(
						'theme_location'	=> 'primary-menu',
						'container_class'	=> 'primary-menu-container',
						'menu_class'		=> 'primary-menu',
					) ); ?>
				</nav><!-- #site-primary-navigation.custom-primary-menu -->
			</div><!-- .site-header-main -->
		</div>
		<?php
	}
}


/**
 * Customize Width According to settings from customizer.
 *
 * @param $image
 * @param $attachment_id
 * @param $size
 * @param $icon
 *
 * @return mixed
 */
function bizbir_header_logo_attr( $image, $attachment_id, $size, $icon ) {
	$logo_width = Bizbir_Theme_Options::get_option( 'field-identity-logo-width' );
	if ( ! empty( $logo_width ) ) {
		$image[1] = $logo_width;
		$image[2] = 0;
	}

	return $image;
}

/**
 * Show Page title banner in inner pages
 */
function bizbir_pageshow_title_in_banner() {
	$enable_title        = true;
	$breadcrumb_position = Bizbir_Theme_Options::get_option( 'field-breadcrumb-type' );

	if ( ! empty( $breadcrumb_position ) && $breadcrumb_position === "before-title" ) {
		Bizbir_Template_Functions::get_breadcrumbs( 'breadcrumb-after-header' );
	}

	if ( ! empty( $enable_title ) ) { ?>
		<h1 class="page-title">
		<?php
			if (is_singular() ) {
				single_post_title();
			} elseif ( is_404() ) {
				esc_html_e( '404', 'bizbir' );
			} elseif ( is_search() ) {
				_e( 'Search results for:', 'bizbir' );
				echo '<div class="search-query">' . get_search_query() . '</div>';
			} elseif(  ! is_front_page() || is_home() ) {
				esc_html_e( 'Blogs', 'bizbir' );
			}
		?>
		</h1>
	<?php }

	if ( ! empty( $breadcrumb_position ) && $breadcrumb_position === "after-title" ) {
		Bizbir_Template_Functions::get_breadcrumbs( 'breadcrumb-after-header' );
	}
}

function bizbir_body_class( $classes ) {
	$classes[] = bizbir_content_layout_type();

	// Button design
	$classes[] = Bizbir_Theme_Options::get_option( 'field-global-button-design' );
	$classes[] = Bizbir_Theme_Options::get_option( 'field-global-button-size' );

	return apply_filters( 'bizbir_body_class', $classes );
}


function bizbir_sticky_main_nav( $classes = '' ) {
	$sticky_enable = Bizbir_Theme_Options::get_option( 'field-header-menu-sticky' );

	if( $sticky_enable ) {
		$classes = 'sticky-enabled';
	}

	return apply_filters( 'bizbir_sticky_main_nav', $classes );
}
