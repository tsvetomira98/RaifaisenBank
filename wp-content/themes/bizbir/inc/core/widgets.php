<?php
/**
 * Register widget sections
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All Rights Reserved !
 */

add_action( 'widgets_init', 'bizbir_widgets_init' );
function bizbir_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bizbir' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bizbir' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Footer widgets
	$footer_widgets = array(
		'footer-one'   => esc_html__( 'Footer 1', 'bizbir' ),
		'footer-two'   => esc_html__( 'Footer 2', 'bizbir' ),
		'footer-three' => esc_html__( 'Footer 3', 'bizbir' ),
		'footer-four'  => esc_html__( 'Footer 4', 'bizbir' ),
	);
	foreach ( $footer_widgets as $k => $footer_widget ) {
		register_sidebar( array(
			'name'          => $footer_widget,
			'id'            => $k,
			'description'   => esc_html__( 'Add widgets here.', 'bizbir' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

}