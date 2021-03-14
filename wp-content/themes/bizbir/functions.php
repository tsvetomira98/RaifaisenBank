<?php
/**
 * Main functions for the theme
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2019. All Rights reserved.
 */

$bizbir_theme = wp_get_theme();
define( 'CODEMANAS_THEME_VERSION', esc_html( $bizbir_theme->get( 'Version' ) ) );
define( 'CODEMANAS_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'CODEMANAS_THEME_URL', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// Core
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-enqueue-scripts.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-theme-options.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-theme-setup.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-admin-settings.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-admin-meta-fields.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/theme-hooks.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/widgets.php';
require_once CODEMANAS_THEME_DIR . 'inc/helpers.php';
require_once CODEMANAS_THEME_DIR . 'inc/core/class-bizbir-comment-walker.php';

/**
 * Template related functions
 */
require_once CODEMANAS_THEME_DIR . 'inc/class-bizbir-template-functions.php';
require_once CODEMANAS_THEME_DIR . 'inc/template-tags.php';

/**
 * Customizer
 */
require_once CODEMANAS_THEME_DIR . 'inc/customizer/class-bizbir-customizer.php';

// Render Elements
require_once CODEMANAS_THEME_DIR . 'inc/extras/headers.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/menus.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/posts-pages-sidebars.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/footers.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/paginations.php';
require_once CODEMANAS_THEME_DIR . 'inc/extras/info-author.php';

require_once CODEMANAS_THEME_DIR . 'inc/core/required-plugins.php';

