<?php
/**
 * Menu Render hook add action here
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

// add_filter( 'bizbir_masthead_main_class', 'bizbir_header_menu_layouts', 1 );
/**
 * Header Layout classes
 *
 * @param $data
 *
 * @return mixed
 */
function bizbir_header_menu_layouts() {

	$sticky_enable = Bizbir_Theme_Options::get_option( 'field-header-menu-sticky' );

	$data[] = ( $sticky_enable ) ? 'sticky-enabled' : '';

	$result = apply_filters( 'bizbir_header_menu_layouts', $data );
	if ( ! empty( $result ) ) {
		return implode( " ", $result );
	} else {
		return false;
	}
}
