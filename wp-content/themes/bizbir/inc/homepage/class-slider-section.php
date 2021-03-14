<?php
/**
 * Homepage sections
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_Slider_Section' ) ) {
	/**
	 * Constructor
	 */

	class Bizbir_Slider_Section extends Bizbir_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$slider_posts = Bizbir_Theme_Options::get_option( 'homepage-slider-post-repeater' );

			foreach ( $slider_posts as $slider ) {
				$post_id = absint( $slider['post'] );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['img'] = get_the_post_thumbnail( $post_id );
				$post_arr['url'] = get_permalink( $post_id );

				$post_arr['sub_title'] = $slider['sub_title'];

				array_push( self::$data_arr, $post_arr );


			}
			
			return apply_filters( 'bizbir_slider_post_data_arr', self::$data_arr );
		}

		public static function render_from_page() {
			$slider_pages = Bizbir_Theme_Options::get_option( 'homepage-slider-page-repeater' );

			foreach ( $slider_pages as $slider ) {
				$page_id = absint( $slider['page'] );


				$page_arr['title'] = get_the_title( $page_id );
				$page_arr['img'] = get_the_post_thumbnail( $page_id );
				$page_arr['url'] = get_permalink( $page_id );

				$page_arr['sub_title'] = $slider['sub_title'];

				array_push( self::$data_arr, $page_arr );

			}
			
			return apply_filters( 'bizbir_slider_page_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$slider_cat = Bizbir_Theme_Options::get_option( 'homepage-slider-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'posts_per_page'		=> 999,
					'cat'					=> absint( $slider_cat ),
				)
			);

			// Defining a new array to be merged later
			// Since there are two loops, the result of two loops will have double arrays to be merged, it is defined such that the data in this array will be merged with later formed array and structure will be like that of previous ones.

			$post_merging_arr = [];
			$slider_cat_content = Bizbir_Theme_Options::get_option( 'homepage-slider-cat-repeater' );
			foreach ( $slider_cat_content as $slider ) {
				
				$post_content['sub_title']    = $slider['sub_title'];

				array_push( $post_merging_arr, $post_content );
			}

			$i = 0;
			while ( $cat_query->have_posts() ): 
				$cat_query->the_post();
				
				$post_arr['title'] = get_the_title();
				$post_arr['img']   = get_the_post_thumbnail();
				$post_arr['url']   = get_permalink();

				if ( ! empty( $post_merging_arr[$i] ) ) {
					$post_merged_arr = array_merge( $post_merging_arr[ $i ], $post_arr );
					array_push( self::$data_arr, $post_merged_arr );
				} else {
					array_push( self::$data_arr, $post_arr );
				}
				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'bizbir_slider_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$slider_enable = Bizbir_Theme_Options::get_option( 'homepage-slider-enable' );

			if ( ! $slider_enable ) {
				return;
			}

			$text_align_class = "text-aligncenter";
			$slider_pause_enable = false;
			$slider_next_icon_enable = true;
			$slider_pager_enable = false;

			$slider_overlay_enable = true;
			$overlay_class = ( $slider_overlay_enable ) ? 'overlay-enabled' : '';

			$slider_transitions = 'fadeout';
			$slider_speed = 3000;


			$slider_content = Bizbir_Theme_Options::get_option( 'homepage-slider-content' );
			if ( 'post' === $slider_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'page' === $slider_content ) {
				$data_arr = self::render_data( self::render_from_page() );
			} elseif ( 'category' === $slider_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			} 
			?>
	 		
	 		<aside class="section no-padding">
				<div class="section-featured-slider">
	 				<div class="swiper-container <?php echo esc_attr( $overlay_class ); ?>" dir="rtl">
	 					<div class="swiper-wrapper">
		 				
							<?php foreach ( $data_arr  as $data ) : ?>
				 				
				 				<?php if ( ! empty( $data['img'] ) ) { ?>
				 				
					 				<article class="swiper-slide">
					 					<div class="caption">
					 						<div class="cycle-caption <?php echo esc_attr( $text_align_class ); ?>">
													
													<?php if ( ! empty( $data['sub_title'] ) ) { ?>
					 									<h4><?php echo esc_html( $data['sub_title'] ); ?></h4>
													<?php } ?>
													
													<?php if ( ! empty( $data['title'] ) ) { ?>
				 									<h3>
				 											<a href="<?php echo esc_url( $data['url'] ); ?>" >

				 											<?php echo wp_kses_post( $data['title'] ); ?>

				 											</a>
					 									</h3>
													<?php } ?>

													<p>It is a crafty team of designers, developers, copywriters and strategists. We work with motivated clients across a wide range of sectors including established brands, startups and entrepreneurs.</p>

					 								<div class="slider-buttons">

					 									<a class="custom-button" href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html__( 'View More', 'bizbir' ); ?></a>

					 								</div> <!-- .slider-buttons -->

					 						</div> <!-- .cycle-caption -->
					 					</div> <!-- .caption -->

					 					<?php if ( ! empty( $data['img'] ) ) { ?>

						 					<a href="<?php  echo esc_url( $data['url'] ); ?>"  >
						 						<?php echo $data['img']; ?>
						 					</a>

					 					<?php } ?>

					 				</article>  <!-- article -->
				 				
				 				<?php } ?>

							<?php endforeach; ?>

		 				</div><!-- #main-slider -->

		 				<?php if ( $slider_next_icon_enable ) : ?>
						    <!-- If we need navigation buttons -->
						    <div class="swiper-button-prev"></div>
						    <div class="swiper-button-next"></div>
		 				<?php endif; ?>

		 				<?php if ( $slider_pager_enable ) : ?>
			 				 <!-- If we need pagination -->
						    <div class="swiper-pagination"></div>
		 				<?php endif; ?>

	 				</div>
	 			</div>
	 		</aside> <!-- .section-featured-slider -->
		
		<?php
		}
	}

	new Bizbir_Slider_Section();
}

