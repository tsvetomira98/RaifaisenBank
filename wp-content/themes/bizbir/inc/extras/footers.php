<?php
/**
 * Footer Section Hooks
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'bizbir_get_footer_widgets' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function bizbir_get_footer_widgets() {
		$layout = Bizbir_Theme_Options::get_option( 'field-footer-widget-layout' );
		switch ( $layout ) {
			case 'wd-four':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
					'footer-four'  => 'Footer 4',
				);

				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
						<aside class="footer-active-4 footer-widget-area">
                        <!-- <aside class="col-md-3 widget-<?php echo $k; ?> bizbir-widget-<?php echo $k; ?> widget-section-wrap"> -->
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-two':
				$footer_widgets = array(
					'footer-one' => 'Footer 1',
					'footer-two' => 'Footer 2',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                        <aside class="footer-active-2 footer-widget-area">
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-three':
				$footer_widgets = array(
					'footer-one'   => 'Footer 1',
					'footer-two'   => 'Footer 2',
					'footer-three' => 'Footer 3',
				);
				foreach ( $footer_widgets as $k => $footer_widget ) {
					if ( is_active_sidebar( $k ) ) {
						?>
                       <aside class="footer-active-3 footer-widget-area">
							<?php dynamic_sidebar( $k ); ?>
                        </aside>
						<?php
					}
				}
				break;
			case 'wd-one':
				if ( is_active_sidebar( 'footer-one' ) ) {
					?>
                    <aside class="footer-active-1 footer-widget-area">
						<?php dynamic_sidebar( 'footer-one' ); ?>
                    </aside>
					<?php
				}
				break;
		}
	}
}

if ( ! function_exists( 'bizbir_get_copyright' ) ) {
	/**
	 * Get footer social menu
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function bizbir_get_copyright() { ?>
			<div class="copyright">
				<p><?php echo esc_html__( 'Copyright &#169; 2020', 'bizbir' ); ?> </p>
			</div>
		
		<?php 
	}
}

if ( ! function_exists( 'bizbir_get_site_info' ) ) {
	/**
	 * Get footer social menu
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function bizbir_get_site_info() {
		$siteinfo = '<p>Bizbir by <a rel="" href="http://codemanas.com" target="_blank">Code Manas</a> </p>';

		if ( ! empty( $siteinfo ) ) { ?>
			
			<div class="site-info">
				<?php echo wp_kses_post( $siteinfo ); ?> 
			</div> <!-- .site-info -->
		<?php 
		}
	}
}