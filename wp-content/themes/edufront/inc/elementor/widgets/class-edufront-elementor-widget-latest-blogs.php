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


if ( ! class_exists( 'Edufront_Elementor_Widget_Latest_Blogs' ) ) {

	/**
	 * Create course slider widget.
	 */
	class Edufront_Elementor_Widget_Latest_Blogs extends \Elementor\Widget_Base {




		/**
		 * Get widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_latest_blogs';
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
			return __( 'Edufront Latest Blogs', 'edufront' );
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
			$this->slider_content();
		}


		/**
		 * Creates section heading.
		 */
		private function section_header() {
			$this->start_controls_section(
				'edufront_latest_blogs_section_header',
				array(
					'label' => __( 'Header', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_latest_blogs_section_header_title',
				array(
					'label' => __( 'Title', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$this->add_control(
				'edufront_latest_blogs_section_header_description',
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
		private function slider_content() {
			$this->start_controls_section(
				'edufront_latest_blogs_section_content',
				array(
					'label' => __( 'Slider Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_latest_blogs_section_content_total_posts',
				array(
					'label'       => __( 'Total Posts', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => __( 'Enter the total number of posts you want to display. You can also set "0" to display it according to WordPress backend "Reading Settings" or set "-1" to display all available posts.', 'edufront' ),
					'min'         => -1,
					'default'     => 6,
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


		private function section_header_content() {

			$title       = $this->get_settings_for_display( 'edufront_latest_blogs_section_header_title' );
			$description = $this->get_settings_for_display( 'edufront_latest_blogs_section_header_description' );
			?>
			<div class="section-heading">

				<?php if ( $title || $description ) { ?>
					<div class="title-wrapper">
						<?php if ( $title ) { ?>
							<h4 class="section-subtitle"><?php echo esc_html( $title ); ?></h4>
						<?php } ?>

						<?php if ( $description ) { ?>
							<h2 class="section-title"><?php echo esc_html( $description ); ?></h2>
						<?php } ?>
					</div>
				<?php } ?>

				<div class="section-btn">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn-prop btn-primary"><?php esc_html_e( 'View All', 'edufront' ); ?></a>
				</div>

				<div class="slider-blog-nav">
					<button class="slick-prev"></button>
					<button href="" class="slick-next"></button>
				</div>

			</div>
			<?php
		}



		private function content_loop() {
			?>
			<div>
				<div class="slider-content">
					<?php
					the_title(
						'<div class="post-title"><a href="' . esc_url( get_the_permalink() ) . '"><h3 class="column-title">',
						'</h3></a></div>'
					);
					?>

					<a href="<?php the_permalink(); ?>" class="img-container">
						<img src="<?php the_post_thumbnail_url(); ?>" alt="">
					</a>

					<div class="post-meta">
						<?php
						edufront_posted_by();
						edufront_posted_on();
						?>
					</div>

					<div class="entry-content">
						<?php if ( get_the_excerpt() ) { ?>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
						<?php } ?>
						<a class="btn-Secondary btn-prop own-prop" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'edufront' ); ?></a>
					</div>

				</div><!-- slider-content -->

			</div>
			<?php
		}



		/**
		 * Render the html to view.
		 */
		protected function render() {

			$total_posts = $this->get_settings_for_display( 'edufront_upcoming_events_section_content_total_posts' );

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $total_posts,
			);

			$the_query = new WP_Query( $args );
			?>

			<div id="latest-news">
				<div class="container">
					<div class="wrapper">

						<?php $this->section_header_content(); ?>

						<div class="inner-content">
							<div class="latest-news-slider">

								<?php
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$this->content_loop();
								}
								?>

							</div><!-- multiple-slider -->
						</div><!-- inner-content -->

					</div>
				</div>
			</div><!-- #latest-news -->

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
					$('.latest-news-slider').not('.slick-initialized').slick({
						dots: true,
						infinite: false,
						speed: 300,
						slidesToShow: 3,
						centerPadding: '40px',
						slidesToScroll: 1,
						responsive: [{
								breakpoint: 1600,
								settings: {
									slidesToShow: 3,
									slidesToScroll: 1,
									infinite: true
								}
							},
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 1
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
							// You can unslick at a given breakpoint now by adding:
							// settings: "unslick"
							// instead of a settings object
						]
					});

				});
			</script>
			<?php
		}
	}
}
