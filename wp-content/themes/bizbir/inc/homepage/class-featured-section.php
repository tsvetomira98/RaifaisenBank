<?php
/**
 * Homepage featured section
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_Featured_Section' ) ) {
	/**
	 * Constructor
	 */

	class Bizbir_Featured_Section extends Bizbir_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$post_id = Bizbir_Theme_Options::get_option( 'homepage-featured-post' );

			$post_arr['url'] = get_permalink( $post_id );
			$post_arr['content'] = get_the_content( null, false, $post_id );
			$post_arr['img'] = get_the_post_thumbnail_url( $post_id );

			$post_arr['btn_txt'] = esc_html__( 'Know More', 'bizbir' );

			array_push( self::$data_arr, $post_arr );

			return apply_filters( 'bizbir_featured_post_data_arr', self::$data_arr );
		}

		public static function render_from_page() {
			$page_id = Bizbir_Theme_Options::get_option( 'homepage-featured-page' );


			$page_arr['url'] = get_permalink( $page_id );
			$page_arr['content'] = get_the_content( null, false, $page_id );
			$page_arr['img'] = get_the_post_thumbnail_url( $page_id );

			$page_arr['btn_txt'] = esc_html__( 'Know More', 'bizbir' );

			array_push( self::$data_arr, $page_arr );

			
			return apply_filters( 'bizbir_featured_page_data_arr', self::$data_arr );
		}

		public static function render_content() {
			$featured_enable = Bizbir_Theme_Options::get_option( 'homepage-featured-enable' );

			if ( ! $featured_enable ) {
				return;
			}

			$subtitle = Bizbir_Theme_Options::get_option( 'homepage-featured-subtitle' );
			$title = Bizbir_Theme_Options::get_option( 'homepage-featured-title' );

			$layout = [
				'image',
				'content'
			];
			$background = Bizbir_Theme_Options::get_option( 'featured-bg' );

			$featured_content = Bizbir_Theme_Options::get_option( 'homepage-featured-content' );
			if ( 'post' === $featured_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'page' === $featured_content ) {
				$data_arr = self::render_data( self::render_from_page() );
			}

			?>
	 		
			<aside  class="section section-featured-page no-padding-btm ">
				<div class="container">
	 				
					<div class="inner-wrapper">

						<?php foreach ( $data_arr  as $data ) : ?>
							
	 						<?php ob_start(); ?>
							<div class="col-grid-6 no-margin">
								<img class="alignnone" src="<?php echo esc_url( $data['img'] ); ?>">
							</div>
							<?php 
							$image = ob_get_contents();
							ob_end_clean();
							?>

	 						<?php ob_start(); ?>
							<div class="col-grid-6">
								<div class="featured-page-section">
									<div class="section-title-wrap text-alignleft">

					 					<?php if ( ! empty( $subtitle ) ) { ?>
											<p class="section-top-subtitle"><?php echo esc_html( $subtitle ); ?></p>
					 					<?php } ?>
										<?php if ( ! empty( $title ) ) { ?>
											<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
					 					<?php } ?>

										<span class="divider"></span>


									</div>
									
					 				<?php if ( ! empty( $data['content'] ) ) { ?>
										<div class="featured-content-area"><?php echo wp_kses_post( $data['content'] ); ?></div>
					 				<?php } ?>

									<?php if ( ! empty( $data['btn_txt'] ) ) { ?>
										<a href="<?php echo esc_url( $data['url'] ); ?>" class="custom-button"><?php echo esc_html( $data['btn_txt'] ); ?></a>
		 							<?php } ?>

								</div>
							</div><!-- .featured-page-section -->
							<?php 
							$content = ob_get_contents();
							ob_end_clean();

							foreach( $layout as $value ) {
							   	echo $$value;
							}
							?>

						<?php endforeach; ?>

					</div> <!-- .inner-wrapper -->
	 			</div> <!-- .container -->
			</aside><!-- .section-featured-page -->
		
		<?php
		}
	}

	new Bizbir_Featured_Section();
}

