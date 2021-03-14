<?php
/**
 * Homepage services section
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_Services_Section' ) ) {
	
	/**
	 * Constructor
	 */

	class Bizbir_Services_Section extends Bizbir_Homepage {

		static $data_arr = [];
		
		public static function render_from_page() {
			$services_pages = Bizbir_Theme_Options::get_option( 'homepage-services-page-repeater' );

			self::$data_arr['left'] = [];
			foreach ( $services_pages as $services ) {
				$page_id = absint( $services['page'] );

				$page_arr['title'] = get_the_title( $page_id );
				$page_arr['url'] = get_permalink( $page_id );
				$page_arr['content'] = get_the_content( null, false, $page_id );

				$page_arr['icon'] = $services['icon'];

				array_push( self::$data_arr['left'], $page_arr );

			}
			
			$services_right_pages = Bizbir_Theme_Options::get_option( 'homepage-services-right-page-repeater' );

			self::$data_arr['right'] = [];
			foreach ( $services_right_pages as $services ) {
				$page_id = absint( $services['page'] );

				$page_arr['right-title'] = get_the_title( $page_id );
				$page_arr['right-url'] = get_permalink( $page_id );
				$page_arr['right-content'] = get_the_excerpt( $page_id );

				$page_arr['right-icon'] = ( empty( $services['icon'] ) ) ? '' :  $services['icon'];
				array_push( self::$data_arr['right'], $page_arr );
			}

			return apply_filters( 'bizbir_services_page_data_arr', self::$data_arr );
		}

		public static function render_content() {
			$services_enable = Bizbir_Theme_Options::get_option( 'homepage-services-enable' );

			if ( ! $services_enable ) {
				return;
			}

			$title = Bizbir_Theme_Options::get_option( 'homepage-services-title' );
			$image = Bizbir_Theme_Options::get_option( 'homepage-services-custom-image' );


			$data_arr = self::render_data( self::render_from_page() );

			?>
	 		
	 		<aside class="section">
	 			<div class="section-key-features">
					<div class="container">
		 				<div class="section-title-wrap">

		 					<?php if ( ! empty( $title ) ) { ?>
		 						<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
		 					<?php } ?>

		 					<span class="divider"></span>

		 				</div>
						
						<div class="key-features-wrapper">
							<div class="inner-wrapper">
								
								<div class="col-grid-4 icon-right">
									<?php foreach ( $data_arr['left']  as $data ) : ?>
										<div class="key-features-block-inner">
											
			 								<?php if ( ! empty( $data['icon'] ) ) { ?>
												<a class="key-features-icon" href="#" ><i class="icon-<?php echo esc_attr( $data["icon"] ); ?>"></i></a>
			 								<?php } ?>

											<div class="key-features-block-inner-content">
												
												<?php if ( ! empty( $data['title'] ) ) { ?>
													<h3 class="key-features-item-title"><a href="<?php echo esc_url( $data['url'] ); ?>" ><?php echo esc_html( $data['title'] ); ?></a></h3>
			 									<?php } ?>

			 									<?php if ( ! empty( $data['content'] ) ) { ?>
													<p><?php echo wp_kses_post( $data['content'] ); ?></p>
			 									<?php } ?>

											</div>

										</div> <!-- .featured-page-grid-item  -->

									<?php endforeach; ?>
								</div>

								<?php if ( ! empty( $image ) ) { ?>
									<div class="col-grid-4">
										<div class="feature-thumb">
											<img alt="featured-page" src="<?php echo esc_url( $image );  ?>">
										</div>
										<!-- .feature-thumnb -->
									</div>
			 					<?php } ?>

								<div class="col-grid-4">
									<?php foreach ( $data_arr['right']  as $data ) : ?>
										<div class="key-features-block-inner">


			 								<?php if ( ! empty( $data['right-icon'] ) ) { ?>
												<a class="key-features-icon" href="<?php echo esc_url( $data['right-url'] ); ?>" ><i class="icon-<?php echo esc_attr( $data["right-icon"] ); ?>"></i></a>
			 								<?php } ?>

											<div class="key-features-block-inner-content">
												
												<?php if ( ! empty( $data['right-title'] ) ) { ?>
													<h3 class="key-features-item-title"><a href="<?php echo esc_url( $data['right-url'] ); ?>" ><?php echo esc_html( $data['right-title'] ); ?></a></h3>
			 									<?php } ?>

			 									<?php if ( ! empty( $data['right-content'] ) ) { ?>
													<p><?php echo wp_kses_post( $data['right-content'] ); ?></p>
			 									<?php } ?>

											</div>

										</div> <!-- .featured-page-grid-item  -->

									<?php endforeach; ?>
								</div>

							</div> <!-- .inner-wrapper -->
						</div> <!-- .service-block-list -->
		 			</div> <!-- .container -->
		 		</div>
			</aside> <!-- .section section-services -->
		
		<?php
		}
	}

	new Bizbir_Services_Section();
}

