<?php
/**
 * Homepage news section
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bizbir_News_Section' ) ) {
	/**
	 * Constructor
	 */

	class Bizbir_News_Section extends Bizbir_Homepage {

		static $data_arr = [];
		
		public static function render_from_post() {
			$news_posts = Bizbir_Theme_Options::get_option( 'homepage-news-post-repeater' );

			foreach ( $news_posts as $news ) {
				$post_id = absint( $news['post'] );

				$cats = get_the_category( $post_id );

				$post_arr['title'] = get_the_title( $post_id );
				$post_arr['img'] = get_the_post_thumbnail( $post_id );
				$post_arr['date'] = get_the_date( get_option( 'date_format' ), $post_id );
				if ( ! empty( $cats[0] ) ) {
					$post_arr['cat'] = $cats[0]->name;
				}
				$post_arr['url'] = get_permalink( $post_id );
				$post_arr['content'] = get_the_excerpt( $post_id );

				array_push( self::$data_arr, $post_arr );
			}

			return apply_filters( 'bizbir_news_post_data_arr', self::$data_arr );
		}

		public static function render_from_page() {
			$news_pages = Bizbir_Theme_Options::get_option( 'homepage-news-page-repeater' );

			foreach ( $news_pages as $news ) {
				$page_id = absint( $news['page'] );

				$page_arr['title'] = get_the_title( $page_id );
				$page_arr['img'] = get_the_post_thumbnail( $page_id );
				$page_arr['date'] = get_the_date( get_option( 'date_format' ), $page_id );
				$page_arr['url'] = get_permalink( $page_id );
				$page_arr['content'] = get_the_content( null, false, $page_id );

				array_push( self::$data_arr, $page_arr );

			}
			
			return apply_filters( 'bizbir_news_page_data_arr', self::$data_arr );
		}

		public static function render_from_category() {
			$news_cat = Bizbir_Theme_Options::get_option( 'homepage-news-category' );
			$cat_query = new WP_Query( 
				array(
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'cat'					=> absint( $news_cat ),
					'posts_per_page'		=> 999,
				)
			);



			$post_merging_arr = [];
			$news_cat_content = Bizbir_Theme_Options::get_option( 'homepage-news-cat-repeater' );
			foreach ( $news_cat_content as $news ) {
				
				array_push( $post_merging_arr, $post_content );
			}

			// Defining a new array to be merged later
			// Since there are two loops, the result of two loops will have double arrays to be merged, it is defined such that the data in this array will be merged with later formed array and structure will be like that of previous ones.
			$i = 0;
			while ( $cat_query->have_posts() ): 
				$cat_query->the_post();
				
				$post_id = get_the_ID();
				$post_arr['title'] = get_the_title();
				$post_arr['img']   = get_the_post_thumbnail();
				$post_arr['cat'] = get_cat_name( absint( $news_cat ) );

				$post_arr['date'] = get_the_date( get_option( 'date_format' ), $post_id );
				$post_arr['url']   = get_permalink();
				$post_arr['content'] = get_the_excerpt( $post_id );

				if ( ! empty( $post_merging_arr[$i] ) ) {
					$post_merged_arr = array_merge( $post_merging_arr[ $i ], $post_arr );

					array_push( self::$data_arr, $post_merged_arr );
				} else {
					array_push( self::$data_arr, $post_arr );
				}

				$i++;

			endwhile; 
			wp_reset_postdata();

			return apply_filters( 'bizbir_news_category_data_arr', self::$data_arr );
		}



		public static function render_content() {
			$news_enable = Bizbir_Theme_Options::get_option( 'homepage-news-enable' );

			if ( ! $news_enable ) {
				return;
			}

			$title = Bizbir_Theme_Options::get_option( 'homepage-news-title' );

			$news_btn_txt = esc_html__( 'View More', 'bizbir' );
			$news_btn_url = Bizbir_Theme_Options::get_option( 'homepage-news-btn-url' );

			$content_layout = [
				'image',
				'content'
			];

			$columns = 4;

			$news_content = Bizbir_Theme_Options::get_option( 'homepage-news-content' );
			if ( 'post' === $news_content ) {
				$data_arr = self::render_data( self::render_from_post() );
			} elseif ( 'page' === $news_content ) {
				$data_arr = self::render_data( self::render_from_page() );
			} elseif ( 'category' === $news_content ) {
				$data_arr = self::render_data( self::render_from_category() );
			} elseif ( 'custom' === $news_content ) {
				$data_arr = self::render_data( self::render_from_custom() );
			}

			?>
	 		
	 		<aside class="section section-latest-posts">
				<div class="container">
	 				<div class="latest-posts-section">

		 				<div class="section-title-wrap">

		 					<?php if ( ! empty( $title ) ) { ?>
		 						<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
		 					<?php } ?>

		 					<span class="divider"></span>
		 					
		 				</div>
						
						<div class="inner-wrapper">
				
							<?php foreach ( $data_arr  as $data ) : ?>
								<div class="col-grid-<?php echo esc_attr( $columns ); ?> latest-posts-item">
									<div class="latest-posts-wrapper box-shadow-block">

										<?php 
										$image = '';
										if ( ! empty( $data['img'] ) ) { 
											$image = '<div class="latest-posts-thumb">
														<a href="' . esc_url( $data['url'] ) . '" >' . $data['img'] . '</a>
													</div>';
										?>
	 									<?php } ?>


	 									<?php ob_start(); ?>
										<div class="latest-posts-text-content-wrapper">
											<div class="latest-posts-text-content">
												
												<?php if ( ! empty( $data['title'] ) ) { ?>
													<h3 class="latest-posts-title">
														<a href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['title'] ); ?></a>
													</h3>
	 											<?php } ?>

	 											<div class="entry-meta latest-posts-meta">

													<?php if ( ! empty( $data['date'] ) ) { ?>
	 													<span class="posted-on"><?php echo esc_html( $data['date'] ); ?></span>
	 												<?php } ?>

													<?php if ( ! empty( $data['cat'] ) ) { ?>
	 													<span class="cat-links"><?php echo esc_html( $data['cat'] ); ?></span>
	 												<?php } ?>

	 											</div>

												<?php if ( ! empty( $data['content'] ) ) { ?>
													<div class="latest-posts-summary">
														<p><?php echo wp_kses_post( $data['content'] ); ?></p>
													</div>
	 											<?php } ?>

												<?php if ( ! empty( $data['btn_txt'] ) ) { ?>
													<a href="<?php echo esc_url( $data['url'] ); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'bizbir' );?></a>
	 											<?php } ?>

											</div> <!-- .latest-posts-text-content -->
										</div> <!-- .latest-posts-text-content-wrapper -->
										<?php 
										$content = ob_get_contents();
										ob_end_clean();

										foreach( $content_layout as $value ) {
										   	echo $$value;
										}
										?>

									</div> <!-- .latest-posts-wrapper -->
								</div> <!-- .latest-posts-item  -->

							<?php endforeach; ?>

							<?php if ( ! empty( $news_btn_txt ) ){ ?>
								<div class="more-wrapper">
									<a href="<?php echo esc_url( $news_btn_url ); ?>" class="custom-button"><?php echo esc_html( $news_btn_txt ); ?></a>
								</div> <!-- .more-wrapper -->
	 						<?php } ?>

						</div> <!-- .inner-wrapper -->

					</div> <!-- .latest-posts-section -->
	 			</div> <!-- .container -->
			</aside> <!-- .section-latest-posts -->
		
		<?php
		}
	}

	new Bizbir_News_Section();
}

