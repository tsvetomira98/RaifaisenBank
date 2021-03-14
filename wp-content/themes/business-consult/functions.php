<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'agency_starter_default_settings' ) ) :

function agency_starter_default_settings($param){
	$values = array (
					 'background_color'=> '#fff', 
					 'page_background_color'=> '#fff', 
					 'woocommerce_menubar_color'=> '#fff', 
					 'woocommerce_menubar_text_color'=> '#333333', 
					 'link_color'=>  '#1f4a06',
					 'main_text_color' => '#1a1a1a', 
					 'primary_color'=> '#85d70d',
					 'header_bg_color'=> '#fff',
					 'header_text_color'=> '#333333',
					 'footer_bg_color'=> '#2f4d05',
					 'footer_text_color'=> '#fff',
					 'header_contact_social_bg_color'=> '#79c60a',
					 'footer_border' =>'2',
					 'hero_border' =>'1',
					 'header_layout' =>'1',
					 'heading_font' => 'Roboto', 
					 'body_font' => 'Google Sans'					 
					 );
					 
	return $values[$param];
}

endif;


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'business_consult_locale_css' ) ):
    function business_consult_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'business_consult_locale_css' );

if ( !function_exists( 'business_consult_parent_css' ) ):
    function business_consult_parent_css() {
        wp_enqueue_style( 'business_consult_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','fontawesome' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'business_consult_parent_css', 10 );


if ( class_exists( 'WP_Customize_Control' ) ) {

	require get_template_directory() .'/inc/color-picker/alpha-color-picker.php';
}


function business_consult_wp_body_open(){
	do_action( 'wp_body_open' );
}

if ( ! function_exists( 'business_consult_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 */
	function business_consult_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;



/**
 * @package twentysixteen
 * @subpackage business-consult
 * Converts a HEX value to RGB.
 */
function business_consult_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}



/* 
 * add customizer settings 
 */
add_action( 'customize_register', 'business_consult_customize_register' );  
function business_consult_customize_register( $wp_customize ) {

	// banner image
	$wp_customize->add_setting( 'banner_image' , 
		array(
			'default' 		=> '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'banner_image' ,
		array(
			'label'          => __( 'Banner Image', 'business-consult' ),
			'description'	=> __('Upload banner image', 'business-consult'),
			'settings'  => 'banner_image',
			'section'        => 'theme_header',
		))
	);
	
	$wp_customize->add_setting('banner_link' , array(
		'default'    => '#',
		'sanitize_callback' => 'esc_url_raw',
	));
	

	$wp_customize->add_control('banner_link' , array(
		'label' => __('Banner Link', 'business-consult' ),
		'section' => 'theme_header',
		'type'=> 'url',
	) );
	
					
	
}


//load widgets
require get_stylesheet_directory() .'/inc/widgets.php';

function business_consult_do_home_slider(){
	if(is_front_page() && get_theme_mod('slider_in_home_page' , 1)) 
		get_template_part('templates/header', 'slider' );
}
add_action('business_consult_home_slider', 'business_consult_do_home_slider');

function business_consult_do_before_header(){
	get_template_part( 'templates/header', 'banner' ); 
}

add_action('business_consult_before_header', 'business_consult_do_before_header');


function business_consult_do_header(){

		get_template_part( 'templates/contact', 'section' );
		
		do_action('business_consult_before_header');
		
		$business_consult_header = get_theme_mod('header_layout', 1);
		
		if ($business_consult_header == 0) {
			echo '<div id="site-header-main" class="site-header-main">';
			get_template_part( 'templates/header', 'default' );
			//woocommerce layout
		} else if($business_consult_header == 1 && class_exists('WooCommerce')){
			get_template_part( 'templates/woocommerce', 'header' ); 
			//list layout
		} else if ($business_consult_header == 2){
			get_template_part( 'templates/header', 'list' );
		} else {
			//default layout
			echo '<div id="site-header-main" class="site-header-main">';
			get_template_part( 'templates/header', 'default' );
		}
		
		if(is_front_page()){
			get_template_part( 'templates/header', 'hero' );
			get_template_part( 'templates/header', 'shortcode' );
		}
		
		/* end header div in default header layouts */
		if ($business_consult_header == 0) {
			echo '</div><!-- .site-header-main -->';
		}

}

add_action('business_consult_header', 'business_consult_do_header');
