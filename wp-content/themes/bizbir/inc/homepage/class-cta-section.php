<?php
/**
 * Homepage cta section
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_CTA_Section' ) ) {
	/**
	 * Constructor
	 */

	class Bizbir_CTA_Section extends Bizbir_Homepage {

		static $data_arr = [];
		
		public static function render_from_page() {
			$cta_page = Bizbir_Theme_Options::get_option( 'homepage-cta-page' );

			$page_id = absint( $cta_page );

			$page_arr['title'] = get_the_title( $page_id );
			$page_arr['url'] = get_permalink( $page_id );
			$page_arr['img'] = get_the_post_thumbnail_url( $page_id );
			$page_arr['content'] = get_the_content( null, false, $page_id );

			$page_arr['btn-txt']          = esc_html( 'View More', 'bizbir' );

			array_push( self::$data_arr, $page_arr );

			
			return apply_filters( 'bizbir_cta_page_data_arr', self::$data_arr );
		}

		public static function render_content() {
			$cta_enable = Bizbir_Theme_Options::get_option( 'homepage-cta-enable' );

			if ( 'disable' === $cta_enable ) {
				return;
			}

			$data_arr = self::render_data( self::render_from_page() );

			?>
	 		
			<?php foreach ( $data_arr  as $data ) : ?>
		 		<aside class="section cta-background background-img overlay-enabled" style="background: url( <?php echo esc_url( $data['img'] ); ?> );">
		 			<div class="call-to-action-inner-wrapper section-call-to-action cta-fluid">
		 				<div class="container">
		 					<div class="call-to-action-content">
		 						<div class="call-to-action-description">
		 							<div class="call-to-action-description">
										
										<?php if ( ! empty( $data['title'] ) ) { ?>
				 							<h2 class="section-title"><?php echo esc_html( $data['title'] ) ; ?></h2>
				 						<?php } ?>

										<?php if ( ! empty( $data['content'] ) ) { ?>
				 							<p class="section-subtitle"><?php echo wp_kses_post( $data['content'] ) ; ?></p>
				 						<?php } ?>
			
									</div><!-- .call-to-action-description -->

									<?php if ( ! empty( $data['btn-txt'] ) ) { ?>
										<div class="call-to-action-buttons">
											<a href="<?php echo esc_url( $data['url'] ); ?>"  class="custom-button custom-primary"><?php echo esc_html( $data['btn-txt'] ) ; ?></a>
										</div><!-- .call-to-action-buttons -->
				 					<?php } ?>
									
								</div><!-- .inner-wrapper -->
		 					</div> <!-- .call-to-action-content -->
		 				</div><!-- .section-cta -->
					</div> <!-- .call-to-action-inner-wrapper" -->
		 		</aside> <!-- .section-call-to-action -->
		 	<?php endforeach; ?>
		
		<?php
		}
	}

	new Bizbir_CTA_Section();
}

