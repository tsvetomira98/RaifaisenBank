<?php
/**
 * @author Deepen.
 * @created_on 12/3/19
 *
 * @since 1.0.0
 * @copyright 2019. CodeManas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AFter head tag hook
 */
function bizbir_after_head() {
	do_action( 'bizbir_after_head' );
}

/**
 * Main body top
 */
function bizbir_body_top() {
	do_action( 'bizbir_body_top' );
}

/**
 * Before main header hook
 */
function bizbir_before_header() {
	do_action( 'bizbir_before_header' );
}

/**
 * Main header hook
 */
function bizbir_header() {
	do_action( 'bizbir_header' );
}

/**
 * After main header hook
 */
function bizbir_after_header() {
	do_action( 'bizbir_after_header' );
}

/**
 * Main Header Content
 */
function bizbir_masthead_content() {
	do_action( 'bizbir_masthead_content' );
}

/**
 * Before Main Header Content
 */
function bizbir_before_masthead_content() {
	do_action( 'bizbir_before_masthead_content' );
}

/**
 * After Main Header Content
 */
function bizbir_after_masthead_content() {
	do_action( 'bizbir_after_masthead_content' );
}

/**
 * Before top banner image content
 */
function bizbir_before_top_banner_image() {
	do_action( 'bizbir_before_top_banner_image' );
}

/**
 * Top banner image content
 */
function bizbir_top_banner_image() {
	do_action( 'bizbir_top_banner_image' );
}

/**
 * After Top banner image content
 */
function bizbir_after_top_banner_image() {
	do_action( 'bizbir_after_top_banner_image' );
}

/**
 * Before main navigation
 */
function bizbir_before_main_nav() {
	do_action( 'bizbir_before_main_nav' );
}


/**
 * Before main navigation
 */
function bizbir_after_main_nav() {
	do_action( 'bizbir_after_main_nav' );
}

/**
 * Before main footer render
 */
function bizbir_before_footer() {
	do_action( 'bizbir_before_footer' );
}

/**
 * After main container
 */
function bizbir_after_main_container() {
	do_action( 'bizbir_after_main_container' );
}

/**
 * Main Footer Hook
 */
function bizbir_footer() {
	do_action( 'bizbir_footer' );
}

/**
 * After main footer render
 */
function bizbir_after_footer() {
	do_action( 'bizbir_after_footer' );
}

/**
 * Top Header
 */
function bizbir_top_header_main() {
	do_action( 'bizbir_top_header_main' );
}

/**
 * Bottom footer
 */
function bizbir_body_bottom() {
	do_action( 'bizbir_body_bottom' );
}

/**
 * Output before footer widgets
 */
function bizbir_before_footer_widgets() {
	do_action( 'bizbir_before_footer_widgets' );
}

/**
 * Output after footer widgets
 */
function bizbir_after_footer_widgets() {
	do_action( 'bizbir_after_footer_widgets' );
}

/**
 * Output before social menus
 */
function bizbir_before_social_menus() {
	do_action( 'bizbir_before_social_menus' );
}

/**
 * Output after social menus
 */
function bizbir_after_social_menus() {
	do_action( 'bizbir_after_social_menus' );
}

/**
 * Post Hooks Start
 */
function bizbir_before_main_content() {
	do_action( 'bizbir_before_main_content' );
}

function bizbir_after_main_content() {
	do_action( 'bizbir_after_main_content' );
}

function bizbir_before_post_content() {
	do_action( 'bizbir_before_post_content' );
}

function bizbir_after_post_content() {
	do_action( 'bizbir_after_post_content' );
}

function bizbir_before_sidebar() {
	do_action( 'bizbir_before_sidebar' );
}

function bizbir_after_sidebar() {
	do_action( 'bizbir_after_sidebar' );
}

function bizbir_main_content() {
	do_action( 'bizbir_main_content' );
}

function bizbir_main_comments() {
	do_action( 'bizbir_main_comments' );
}

function bizbir_contact_before_main_content() {
	do_action( 'bizbir_contact_before_main_content' );
}

function bizbir_contact_main_content() {
	do_action( 'bizbir_contact_main_content' );
}

function bizbir_contact_after_main_content() {
	do_action( 'bizbir_contact_after_main_content' );
}


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function bizbir_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#content">' . __( 'Skip to the content', 'bizbir' ) . '</a>';
}

add_action( 'wp_body_open', 'bizbir_skip_link', 5 );

/**
 * Post Hooks End
 */


/* Homepage hooks */
function bizbir_homepage_main_content() {
	do_action( 'bizbir_homepage_main_content' );
}

function bizbir_homepage_before_main_content() {
	do_action( 'bizbir_homepage_before_main_content' );
}

function bizbir_homepage_after_main_content() {
	do_action( 'bizbir_homepage_after_main_content' );
}


/* About hooks */
function bizbir_about_main_content() {
	do_action( 'bizbir_about_main_content' );
}

function bizbir_about_before_main_content() {
	do_action( 'bizbir_about_before_main_content' );
}

function bizbir_about_after_main_content() {
	do_action( 'bizbir_about_after_main_content' );
}


/**
 * Headers
 *
 * @see  Bizbir_Template_Functions::master_header()
 * @see  Bizbir_Template_Functions::after_header_contents()
 * @see  bizbir_masthead_logo()
 * @see  bizbir_masthead_nav()
 * @see  Bizbir_Template_Functions::top_header()
 * @see  Bizbir_Template_Functions::breadcrumbs_inside_header()
 */

add_action( 'bizbir_header', array( 'Bizbir_Template_Functions', 'master_header' ) );
add_action( 'bizbir_after_header', array( 'Bizbir_Template_Functions', 'after_header_contents' ), 10 );

add_action( 'wp', 'bizbir_header_design_layout_cb' ); // Hooked to wp since the template functions does not work until wp is loaded.
function bizbir_header_design_layout_cb() {
	add_action( 'bizbir_masthead_content', 'bizbir_masthead_logo', 10 );
	add_action( 'bizbir_masthead_content', 'bizbir_header_right_wrapper_start', 15 );
	add_action( 'bizbir_masthead_content', 'bizbir_masthead_nav', 20 );
	add_action( 'bizbir_masthead_content', 'bizbir_header_right_head_start', 25 );
	add_action( 'bizbir_masthead_content', 'bizbir_header_search_trigger', 30 );
	add_action( 'bizbir_masthead_content', 'bizbir_masthead_search', 40 );
	add_action( 'bizbir_masthead_content', 'bizbir_masthead_mini_cart', 50 );
	add_action( 'bizbir_masthead_content', 'bizbir_header_right_head_end', 55 );
	add_action( 'bizbir_masthead_content', 'bizbir_header_right_wrapper_end', 60 );
}

// Top header
// add_action( 'bizbir_before_masthead_content', array( 'Bizbir_Template_Functions', 'mobile_menu' ), 10 );



/**
 * Top banner image
 *
 * @see  bizbir_pageshow_title_in_banner()
 */

add_action( 'bizbir_top_banner_image', 'bizbir_pageshow_title_in_banner' );

/**
 * Homepage sections
 *
 * @see  bizbir_pageshow_title_in_banner()
 */
add_action( 'wp', 'bizbir_homepage_sorting_cb' ); // Hooked to wp since the template functions does not work until wp is loaded.
function bizbir_homepage_sorting_cb() {
	$homepage_sort_sections = Bizbir_Theme_Options::get_option( 'field-homepage-sort' );

	$section_priority = 10;
	foreach ( $homepage_sort_sections as $section ) {
		add_action( 'bizbir_homepage_main_content', array( 'Bizbir_' . esc_html( $section ) . '_Section', 'render_content' ), $section_priority );
	}
}


/**
 * Footer
 *
 * @see Bizbir_Template_Functions::master_footer()
 * @see Bizbir_Template_Functions::main_footer()
 * @see Bizbir_Template_Functions::super_footer()
 */

add_action( 'bizbir_footer', array( 'Bizbir_Template_Functions', 'footer_widgets' ) );
add_action( 'bizbir_footer', array( 'Bizbir_Template_Functions', 'footer_site_info' ), 30 );
add_action( 'bizbir_body_bottom', array( 'Bizbir_Template_Functions', 'bizbir_scrollToTop' ), 10 );


/**
 * Singular hooks
 *
 * @see bizbir_before_main_content_wrapper_start()
 * @see Bizbir_Template_Functions::main_footer()
 */

add_action( 'bizbir_main_content', 'bizbir_content_post_sortable', 10 );
add_action( 'bizbir_main_comments', 'bizbir_show_comments' );


// Post/body classes
add_filter( 'post_class', 'bizbir_blog_archive_column', 10, 1 );
add_filter( 'body_class', 'bizbir_body_class', 10, 1 );