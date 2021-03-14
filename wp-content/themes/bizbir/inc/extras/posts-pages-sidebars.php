<?php
/**
 * Sidebar Functions Here
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bizbir_blog_archive_column( $classes ) {
	if ( wp_doing_ajax() || is_archive() || is_home() ) {

		$col = Bizbir_Theme_Options::get_option( 'field-blog-archive-column' );

		if ( ! empty( $col ) ) {
			$classes[] = 'col-grid-' . absint( $col );
		}
		return apply_filters( 'bizbir_blog_archive_column', $classes );
	} elseif( is_singular() ) {
		$classes[] = 'col-grid-12';
	}

	return $classes;
}

/**
 * Fetch type of sidebar style
 *
 * @param $sidebar
 *
 * @return mixed
 */
function bizbir_get_sidebar_style( $sidebar ) {
	if ( $sidebar === 'left' ) {
		$result = 'left-sidebar';
	} elseif ( $sidebar === 'right' ) {
		$result = 'right-sidebar';
	} elseif ( $sidebar === 'default' ) {
		$result = Bizbir_Theme_Options::get_option( 'field-sidebar-type' );
		$result = bizbir_get_sidebar_style( $result );
	} else {
		$result = 'none';
	}

	return apply_filters( 'bizbir_sidebar_layout_style', $result );
}

/**
 * Fetch sidebar layout
 */
function bizbir_get_sidebar_layout() {
	if ( ! bizbir_search_results() ) {
		return;
	}

	// Global Sidebar
	$sidebar_layout = array(
		'field-sidebar-type'    => Bizbir_Theme_Options::get_option( 'field-sidebar-type' ),
		'field-sidebar-post'    => Bizbir_Theme_Options::get_option( 'field-sidebar-post' ),
		'field-sidebar-page'    => Bizbir_Theme_Options::get_option( 'field-sidebar-page' ),
		'field-sidebar-archive' => Bizbir_Theme_Options::get_option( 'field-sidebar-archive' ),
	);

	// Post Sidebar
	$global_sidebar = ! empty( $sidebar_layout['field-sidebar-type'] ) ? $sidebar_layout['field-sidebar-type'] : false;
	// Return global sidebar
	$sidebar = $global_sidebar;

	if ( $global_sidebar !== 'none' ) {



		// If is WooCommerce
		if ( ( is_home() || is_single() ) ) {
			// Post Sidebar
			$page_setting = Bizbir_Theme_Options::get_page_setting( 'page-sidebar' );

			if( 'default' == $page_setting || ! $page_setting ) {
				$post_sidebar = ! empty( $sidebar_layout['field-sidebar-post'] ) ? $sidebar_layout['field-sidebar-post'] : false;
			} else {
				$post_sidebar = $page_setting;
			}
			$sidebar = bizbir_get_sidebar_style( $post_sidebar );
		} elseif ( is_page() ) {
			// Pages Sidebar

			$page_setting = Bizbir_Theme_Options::get_page_setting( 'page-sidebar' );

			if( 'default' == $page_setting || ! $page_setting ) {
				$pages_sidebar = ! empty( $sidebar_layout['field-sidebar-page'] ) ? $sidebar_layout['field-sidebar-page'] : false;
			} else {
				$pages_sidebar = $page_setting;
			}
			$sidebar = bizbir_get_sidebar_style( $pages_sidebar );

		} elseif ( is_archive() || is_search() ) {
			// Archives Sidebar
			$archive_sidebar = ! empty( $sidebar_layout['field-sidebar-archive'] ) ? $sidebar_layout['field-sidebar-archive'] : false;
			$sidebar = bizbir_get_sidebar_style( $archive_sidebar );
		} else {
			$sidebar = bizbir_get_sidebar_style( $sidebar );
		}
	}

	return apply_filters( 'bizbir_sidebar_layout', $sidebar, $sidebar_layout );
}

function bizbir_sidebar_class() {
	if( is_page_template( 'custom-tmpl/tmpl-home.php' ) || is_page_template( 'custom-tmpl/tmpl-full-width.php' ) || is_page_template( 'custom-tmpl/tmpl-about.php' ) || is_page_template( 'custom-tmpl/tmpl-contact.php' ) ){
		$class = 'global-layout-no-sidebar';
	} else {
		$sidebar_layout = bizbir_get_sidebar_layout();
		if ( $sidebar_layout == 'none' ) {
			$archive_column = Bizbir_Theme_Options::get_option( 'field-blog-archive-column' );
			if ( 12 != $archive_column ) {
				$class = "default-full-width blog-grid-layout";
			}  else {
				$class = "default-full-width blog-full-width";
			}
		} elseif ( $sidebar_layout == 'left-sidebar' ) { 
			$class = "global-layout-left-sidebar";
		} else {
			$class = "global-layout-right-sidebar";
		}
	}

	return apply_filters( 'bizbir_sidebar_class', $class );
}

/**
 * Make Content Sortable Here
 */
if ( ! function_exists( 'bizbir_content_post_sortable' ) ) {
	function bizbir_content_post_sortable() {
		// Blog Archive Page
		$post_content = array(
				'image',
				'title',
				'meta',
				'content',
			);
		if ( ! empty( $post_content ) ) {
			foreach ( $post_content as $cont ) {
				switch ( $cont ) {
					case 'title':
						?>
						<header class="entry-header">
							<?php
							if ( is_singular() ) :
								the_title( '<h1 class="entry-title">', '</h1>' );
							else :
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;
							?>
						</header><!-- .entry-header -->
						<?php
						break;

					case 'image':
						if ( has_post_thumbnail() ) {
							?>
							<div class="entry-thumb aligncenter">
								<?php bizbir_post_thumbnail(); ?>
							</div>
							<?php
						}
						break;

					case 'meta':
						?>
						<?php
						if ( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta">
								<?php
								bizbir_post_posted_on();
								bizbir_post_category_links();
								bizbir_post_posted_by();
								bizbir_post_leave_comment();
								?>
							</div>
						<?php endif; ?>
						<?php
						break;

					case 'content':
						?>
						<div class="entry-content">
							<?php
							if ( is_singular() ) :
								the_content();
								wp_link_pages();
							else :
								the_excerpt();
							endif;
							?>
						</div><!-- .entry-content -->
						<?php
						break;
				}
			}
		}
	}
}

