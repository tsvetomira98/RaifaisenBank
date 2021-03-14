<?php
/**
 * Activation Plugn notices for the theme.
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All Rights Reserved !
 */

require_once CODEMANAS_THEME_DIR . 'inc/core/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bizbir_register_required_plugins' );

//If PRO VERSION exists remove notice
function bizbir_check_if_pro_plugin_exists() {
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'     => __( 'One Click Demo Importer', 'bizbir' ),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => __( 'Breadcrumb NavXT', 'bizbir' ),
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		),
		array(
			'name'     => __( 'Contact Form 7', 'bizbir' ),
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => __( 'Mailpoet', 'bizbir' ),
			'slug'     => 'mailpoet',
			'required' => false,
		),
		array(
			'name'     => __( 'WooCommerce', 'bizbir' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),
	);

	return $plugins;
}

/**
 * Register the required plugins for this theme.
 */
function bizbir_register_required_plugins() {

	$plugins = bizbir_check_if_pro_plugin_exists();

	$config = array(
		'id'           => 'bizbir',
		'default_path' => CODEMANAS_THEME_DIR . 'assets/plugins/',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'bizbir-theme',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
	);

	tgmpa( $plugins, $config );
}