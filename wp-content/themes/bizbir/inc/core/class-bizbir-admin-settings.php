<?php
/**
 * Admin settings for Bizbir theme
 *
 * @author      CodeManas
 * @copyright   Copyright (c) 2019, CodeManas
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bizbir_Admin_Settings {

	public static $menu_title = 'Bizbir Theme';
	public static $page_title = 'Bizbir';
	public static $slug = 'bizbir-theme';
	public static $theme_updates_slug = 'bizbir-multi-purpose-wordpress-business-theme';
	public static $menu_position_screen = 'themes.php';
	public $license_key;

	/**
	 * Constructor
	 */
	function __construct() {

		$this->license_key = get_option( self::$theme_updates_slug . '_license_key' );

		if ( ! is_admin() ) {
			return;
		}

		add_action( 'after_setup_theme', array( $this, 'init_settings' ), 99 );
	}

	/**
	 * Init
	 */
	public function init_settings() {
		if ( isset( $_REQUEST['page'] ) && ( self::$slug === 'bizbir-theme' || self::$theme_updates_slug . '-license' === $_REQUEST['page'] ) ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'styles_scripts' ] );
		}

		add_action( 'admin_menu', [ $this, 'show_admin_menu' ], 1 );
	}

	/**
	 * Show Admin Menu in admin
	 */
	public function show_admin_menu() {
		$page_title = self::$page_title;
		$capability = 'manage_options';
		$slug       = self::$slug;

		add_theme_page( $page_title, $page_title, $capability, $slug, array( $this, 'render_menu' ), 2 );
	}

	/**
	 * Move importer setting into Admin Bizbir Page
	 *
	 * @param $importer
	 *
	 * @return array
	 */
	public function importer_page( $importer ) {
		if ( ! empty( $this->license_key ) ) {
			$importer['parent_slug'] = self::$slug;
		} else {
			$importer['parent_slug'] = false;
		}

		return $importer;
	}

	/**
	 * Render Admin settings HTML
	 */
	public function render_menu() {
		?>
        <div class="bizbir-menu-page-wrapper">
            <div class="bizbir-page-header">
                <div class="container bizbir-center">
                    <div class="bizbir-theme-logo">
                        <img src="<?php echo CODEMANAS_THEME_URL . 'assets/images/logo.png'; ?>" width="140"> <span class="bizbir-theme-version">v<?php echo CODEMANAS_THEME_VERSION; ?></span>
                    </div>
                </div>
            </div>
            <div class="bizbir-page-content">
                <div class="container">
                    <div class="bizbir-theme-border-palete-w-padding bizbir-theme-text-center">
                        <h3><?php esc_html_e( 'Welcome to Bizbir Theme', 'bizbir' ); ?></h3>
                        <p><?php esc_html_e( 'Bizbir is is a powerful, creative, perfect  and feature rich multi-purpose Business HTML template. It is suitable for business, portfolio, digital agencies and general corporate website. It is designed with great attention to details, flexibility and performance thus looks stunning on all types of screens and devices. Bizbir comes with creative and well-organized sections.', 'bizbir' ); ?></p>
                    </div>
                    <div class="bizbir-theme-options-container">
                        <div class="bizbir-theme-wrap-left">
                            <div class="bizbir-theme-border-palete-without-padding bizbir-theme-heading-box-style">
                                <h3><i class="dashicons dashicons-admin-site-alt2"></i> <?php esc_html_e( 'Customizer Settings', 'bizbir' ); ?></h3>
                                <div class="bizbir-row">
                                    <div class="bizbir-column"><i class="dashicons dashicons-format-image"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php esc_html_e( 'Upload Logo', 'bizbir' ); ?></a></div>
                                </div>
                                <div class="bizbir-row">
                                    <div class="bizbir-column"><i class="dashicons dashicons-slides"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-blog-post-pagination' ) ); ?>"><?php esc_html_e( 'Pagination Styles', 'bizbir' ); ?></a></div>
                                </div>
                                <div class="bizbir-row">
                                    <div class="bizbir-column"><i class="dashicons dashicons-networking"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-breadcrumb-type' ) ); ?>"><?php esc_html_e( 'Breadcrumb Settings', 'bizbir' ); ?></a></div>
                                    <div class="bizbir-column"><i class="dashicons dashicons-excerpt-view"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-sidebar-type' ) ); ?>"><?php esc_html_e( 'Sidebar Settings', 'bizbir' ); ?></a></div>
                                </div>
                                <div class="bizbir-row">
                                    <div class="bizbir-column"><i class="dashicons dashicons-admin-generic"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( admin_url( '/customize.php?autofocus[control]=field-footer-widget-layout' ) ); ?>"><?php esc_html_e( 'Footer Widgets', 'bizbir' ); ?></a></div>
                                </div>
                            </div>
							<div class="bizbir-theme-border-palete-without-padding bizbir-theme-heading-box-style">
								<h3><i class="dashicons dashicons-admin-network"></i> <?php esc_html_e( 'Get Started by Importing Demo Contents', 'bizbir' ); ?></h3>
								<div class="bizbir-theme-knowledge-base">
									<?php if ( ! empty( $this->license_key ) ) { ?>
									<p><?php esc_html_e( 'Import existing contents and design to get started with just one click.', 'bizbir' ); ?></p>
									<p><a href="<?php echo admin_url( 'admin.php?page=pt-one-click-demo-import' ); ?>"><?php esc_html_e( 'Take me to demo import page', 'bizbir' ); ?> »</a></p>
									<?php } else { ?>
									<p><?php esc_html_e( 'You need to enter a valid license key to import demo data.', 'bizbir' ); ?> <a href="<?php echo admin_url('admin.php?page=bizbir-license'); ?>">Click Here</a></p>
									<?php } ?>
								</div>
							</div>
                            <div class="bizbir-theme-border-palete-without-padding bizbir-theme-heading-box-style">
                                <h3><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e( 'Extra Plugins', 'bizbir' ); ?></h3>
                                <div class="bizbir-theme-extra-plugins">
                                    <ul>
                                        <li>
                                            <span class="bizbir-theme-extra-plugins-left"><?php esc_html_e( 'Install recommended plugins', 'bizbir' ); ?></span>
                                            <span class="bizbir-theme-extra-plugins-right"><a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>" class="button button-primary"><?php esc_html_e( 'Install and Activate', 'bizbir' ); ?></a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="bizbir-theme-wrap-right">
                            <div class="bizbir-theme-border-palete-without-padding bizbir-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-welcome-learn-more"></i> <?php esc_html_e( 'Knowledge Base', 'bizbir' ); ?></h3>
                                <div class="bizbir-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Having issues with theme or installation ? Take some time to explore our knowledge base to explore and learn about possiblities.', 'bizbir' ); ?></p>
                                    <p><a href="https://docs.codemanas.com/bizbir/"><?php esc_html_e( 'Visit Knowledge Base', 'bizbir' ); ?> »</a></p>
                                </div>
                            </div>
                            <div class="bizbir-theme-border-palete-without-padding bizbir-theme-heading-box-style ">
                                <h3><i class="dashicons dashicons-info"></i> <?php esc_html_e( 'Support', 'bizbir' ); ?></h3>
                                <div class="bizbir-theme-knowledge-base">
                                    <p><?php esc_html_e( 'Did not find what you are looking for on knowledge base ? Ask us directly.', 'bizbir' ); ?></p>
                                    <p><a href="https://www.codemanas.com/forums/forum/premium-themes/bizbir/"><?php esc_html_e( 'Visit Support Forum', 'bizbir' ); ?> »</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Get and return page URL
	 *
	 * @param string $menu_slug Menu name.
	 *
	 * @since 1.0
	 * @return  string page url
	 */
	public static function get_page_url( $menu_slug ) {

		$parent_page = self::$menu_position_screen;

		if ( strpos( $parent_page, '?' ) !== false ) {
			$query_var = '&page=' . self::$slug;
		} else {
			$query_var = '?page=' . self::$slug;
		}

		$parent_page_url = admin_url( $parent_page . $query_var );

		$url = $parent_page_url . '&action=' . $menu_slug;

		return esc_url( $url );
	}

	/**
	 * Enqueue Scripts into Admin Page
	 */
	public function styles_scripts() {
		wp_enqueue_style( 'bizbir-admin-styles', CODEMANAS_THEME_URL . 'assets/admin/css/bizbir-admin-styles.css', false, CODEMANAS_THEME_VERSION );

		do_action( 'bizbir_admin_settings_enqueue_style' );
	}

}

new Bizbir_Admin_Settings();