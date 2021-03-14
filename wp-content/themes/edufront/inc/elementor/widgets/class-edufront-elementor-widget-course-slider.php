<?php

/**
 * Create elementor custom widget.
 *
 * @package edufront.
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Plugin;

if ( ! class_exists( 'Edufront_Elementor_Widget_Course_Slider' ) ) {

	/**
	 * Create course slider widget.
	 */
	class Edufront_Elementor_Widget_Course_Slider extends \Elementor\Widget_Base {


		/**
		 * Get widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_course_slider';
		}

		/**
		 * Get widget title.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Edufront Course Slider', 'edufront' );
		}


		/**
		 * Get widget categories.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return array Widget categories.
		 */
		public function get_categories() {
			return array( 'edufront' );
		}

		/**
		 * Register oEmbed widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function _register_controls() {
			$this->section_header();
			$this->section_content();
		}

		/**
		 * Creates section heading.
		 */
		private function section_header() {
			$this->start_controls_section(
				'edufront_course_slider_section_header',
				array(
					'label' => __( 'Header', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_course_slider_section_header_title',
				array(
					'label' => __( 'Title', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$this->add_control(
				'edufront_course_slider_section_header_description',
				array(
					'label' => __( 'Description', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXTAREA,
				)
			);

			$this->end_controls_section();
		}

		/**
		 * Creates section content.
		 */
		private function section_content() {
			$this->start_controls_section(
				'edufront_course_slider_section_content',
				array(
					'label' => __( 'Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			if ( edufront_customizer_get_taxonomies() ) {
				$this->add_control(
					'edufront_course_slider_section_content_taxonomy',
					array(
						'label'   => __( 'Category Type', 'edufront' ),
						'type'    => \Elementor\Controls_Manager::SELECT2,
						'options' => edufront_customizer_get_taxonomies(),
					)
				);

				$this->add_control(
					'edufront_course_slider_section_content_term_ld_course_category',
					array(
						'label'     => __( 'Courses Category', 'edufront' ),
						'type'      => \Elementor\Controls_Manager::SELECT2,
						'options'   => edufront_customizer_get_terms( 'ld_course_category' ),
						'condition' => array(
							'edufront_course_slider_section_content_taxonomy' => 'ld_course_category',
						),
					)
				);

				$this->add_control(
					'edufront_course_slider_section_content_term_category',
					array(
						'label'     => __( 'Posts Category', 'edufront' ),
						'type'      => \Elementor\Controls_Manager::SELECT2,
						'options'   => edufront_customizer_get_terms( 'category' ),
						'condition' => array(
							'edufront_course_slider_section_content_taxonomy' => 'category',
						),
					)
				);

			} else {

				$this->add_control(
					'edufront_course_slider_section_content_term_category',
					array(
						'label'   => __( 'Posts Category', 'edufront' ),
						'type'    => \Elementor\Controls_Manager::SELECT2,
						'options' => edufront_customizer_get_terms( 'category' ),
					)
				);

			}

			$this->add_control(
				'edufront_course_slider_section_content_total_posts',
				array(
					'label'       => __( 'Total Posts', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => __( 'Enter the total number of posts you want to display. You can also set "0" to display it according to WordPress backend "Reading Settings" or set "-1" to display all available posts.', 'edufront' ),
					'min'         => -1,
					'default'     => -1,
				)
			);

			$this->end_controls_section();
		}

		/**
		 * Checks if elementor is in editor mode.
		 */
		private function is_editor_mode() {
			return Plugin::$instance->editor->is_edit_mode();
		}

		/**
		 * This section header.
		 */
		private function section_header_content( $filter_by ) {
			$heading     = $this->get_settings_for_display( 'edufront_course_slider_section_header_title' );
			$description = $this->get_settings_for_display( 'edufront_course_slider_section_header_description' );

			?>

			<div class="section-heading">
				<?php if ( $heading ) { ?>
					<h2 class="section-title">
						<?php echo esc_html( $heading ); ?>
					</h2>
				<?php } ?>

				<?php if ( $description ) { ?>
					<p class="section-heading-excerpt"><?php echo esc_html( $description ); ?></p>
				<?php } ?>

				<form method="GET" class="course-filter-by-form select-option">
					<select name="filter_by" class="course-filter-by">
						<option value="default"><?php esc_html_e( 'Filter Course', 'edufront' ); ?></option>
						<option <?php selected( $filter_by, 'title' ); ?> value="title"><?php esc_html_e( 'By Title', 'edufront' ); ?></option>
						<option <?php selected( $filter_by, 'date' ); ?> value="date"><?php esc_html_e( 'By Date', 'edufront' ); ?></option>
					</select>
				</form>

				<div class="slider-nav">
					<button class="slick-prev"></button>
					<button class="slick-next"></button>
				</div>

			</div>

			<?php
		}

		/**
		 * This section loop content.
		 */
		private function section_loop_content( $tax ) {

			$category = get_the_terms( get_the_ID(), $tax );
			$cat_name = ! is_wp_error( $category ) && ! empty( $category[0]->name ) ? $category[0]->name : '';
			$cat_link = ! is_wp_error( $category ) && ! empty( $category[0] ) ? get_term_link( $category[0] ) : '';

			$course_price    = function_exists( 'learndash_get_course_price' ) ? learndash_get_course_price() : null;
			$currency_symbol = function_exists( 'learndash_30_get_currency_symbol' ) ? learndash_30_get_currency_symbol() : '';

			?>
				<div <?php post_class(); ?>>
					<div class="slider-content">
						<?php
						the_title(
							'<div class="post-title"><a href="' . esc_url( get_the_permalink() ) . '"><h3 class="column-title">',
							'</h3></a></div>'
						);
						?>

						<a href="<?php the_permalink(); ?>" class="img-container">
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						</a>

						<div class="post-meta">
							<?php if ( $cat_name ) { ?>
								<span class="category">
									<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
								</span>
							<?php } ?>
							<?php
								the_date(
									'',
									'<span class="date-meta"><a href="' . esc_url( get_the_permalink() ) . '"><i class="fas fa-clock"></i> ',
									'</a></span>'
								);
							?>

						</div>

						<?php if ( $currency_symbol && ! empty( $course_price['type'] ) && 'paynow' === $course_price['type'] && ! empty( $course_price['price'] ) ) { ?>
							<div class="pricing">
								<div class="actual-price">
									<p><?php echo esc_html( "{$currency_symbol} {$course_price['price']}" ); ?></p>
								</div><!-- .actual-price -->
							</div><!-- pricing -->
						<?php } ?>
<!--
						<div class="footer-content">
							<div class="star-rating">
								<div class="rating" title="Rated 5 out of 5">
									<a tabindex="0">
										<span style="width:100%">
											<strong class="rating">5</strong> out of <span>5</span>
										</span>
									</a>
								</div>
								<p class="vote-count"> 20 Votes</p>
							</div>
							<a href="" class="love-icon">
								<span><i class="fas fa-heart"></i></span>
							</a>
						</div> -->
					</div><!-- slider-content -->

				</div>
			<?php
		}

		/**
		 * Render the html to view.
		 */
		protected function render() {
			$tax         = $this->get_settings_for_display( 'edufront_course_slider_section_content_taxonomy' );
			$key         = "edufront_course_slider_section_content_term_{$tax}";
			$category    = $this->get_settings_for_display( $key );
			$total_posts = $this->get_settings_for_display( 'edufront_course_slider_section_content_total_posts' );
			$filter_by   = isset( $_GET['filter_by'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_by'] ) ) : '';

			$args = array(
				'post_type'      => 'ld_course_category' === $tax ? 'sfwd-courses' : 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $total_posts,
			);

			if ( $filter_by && 'default' !== $filter_by ) {
				$args['orderby'] = 'title';
				$args['order']   = 'title' === $filter_by ? 'ASC' : 'DESC';
			}

			if ( ! empty( $category ) ) {
				$args['tax_query'] = array( // phpcs:ignore
					array(
						'taxonomy' => $tax,
						'field'    => 'term_id',
						'terms'    => array( $category ),
					),
				);
			}

			$the_query = new WP_Query( $args );
			?>

			<div id="trending-course">
				<div class="container">
					<div class="wrapper">

						<?php $this->section_header_content( $filter_by ); ?>

						<div class="inner-content">
							<div class="multiple-slider">
								<?php

								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$this->section_loop_content( $tax );
								}

								?>
							</div><!-- multiple-slider -->

						</div><!-- inner-content -->

					</div>
				</div>
			</div><!-- #trending-course -->

			<?php
			wp_reset_postdata();
			$this->custom_scripts();
		}

		/**
		 * Custom scripts for this section.
		 */
		public function custom_scripts() {
			if ( ! $this->is_editor_mode() ) {
				return;
			}
			?>
			<script>
				jQuery(function($) {
					$('.multiple-slider').not('.slick-initialized').slick({
						dots: true,
						infinite: false,
						speed: 300,
						slidesToShow: 3,
						centerPadding: '40px',
						slidesToScroll: 1,
						responsive: [{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2,
									infinite: true,
									dots: false
								}
							},
							{
								breakpoint: 700,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							}
						]
					});
				});
			</script>
			<?php
		}
	}
}
