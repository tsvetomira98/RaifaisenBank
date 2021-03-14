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

if ( ! class_exists( 'Edufront_Elementor_Widget_Banner_Slider' ) ) {

	/**
	 * Create course slider widget.
	 */
	class Edufront_Elementor_Widget_Banner_Slider extends \Elementor\Widget_Base {


		/**
		 * Get widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_banner_slider';
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
			return __( 'Edufront Banner Slider', 'edufront' );
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
			$this->notice();
			$this->slider_content();
			$this->feature_cards();
		}


		private function notice() {
			$this->start_controls_section(
				'edufront_banner_slider_section_notice',
				array(
					'label' => __( 'Notice', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_notice_is_enable',
				array(
					'label' => __( 'Enable Notice', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::SWITCHER,
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_notice_description',
				array(
					'label'     => __( 'Description', 'edufront' ),
					'type'      => \Elementor\Controls_Manager::TEXTAREA,
					'condition' => array(
						'edufront_banner_slider_section_notice_is_enable' => 'yes',
					),
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_notice_btn_label',
				array(
					'label'     => __( 'Button Label', 'edufront' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'default'   => __( 'Apply Now', 'edufront' ),
					'condition' => array(
						'edufront_banner_slider_section_notice_is_enable' => 'yes',
					),
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_notice_btn_link',
				array(
					'label'     => __( 'Button Link', 'edufront' ),
					'type'      => \Elementor\Controls_Manager::URL,
					'condition' => array(
						'edufront_banner_slider_section_notice_is_enable' => 'yes',
					),
				)
			);

			$this->end_controls_section();
		}

		/**
		 * Creates section content.
		 */
		private function slider_content() {
			$this->start_controls_section(
				'edufront_banner_slider_section_content',
				array(
					'label' => __( 'Slider Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_content_alignment',
				array(
					'label'   => __( 'Alignment', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'align-left',
					'options' => array(
						'align-left'   => __( 'Left', 'edufront' ),
						'align-center' => __( 'Center', 'edufront' ),
						'align-right'  => __( 'Right', 'edufront' ),
					),
				)
			);

			if ( edufront_customizer_get_taxonomies() ) {
				$this->add_control(
					'edufront_banner_slider_section_content_taxonomy',
					array(
						'label'   => __( 'Category Type', 'edufront' ),
						'type'    => \Elementor\Controls_Manager::SELECT2,
						'options' => edufront_customizer_get_taxonomies(),
					)
				);
			}

			$this->add_control(
				'edufront_banner_slider_section_content_term_ld_course_category',
				array(
					'label'     => __( 'Courses Category', 'edufront' ),
					'type'      => \Elementor\Controls_Manager::SELECT2,
					'options'   => edufront_customizer_get_terms( 'ld_course_category' ),
					'condition' => array(
						'edufront_banner_slider_section_content_taxonomy' => 'ld_course_category',
					),
				)
			);

			if ( edufront_customizer_get_taxonomies() ) {
				$this->add_control(
					'edufront_banner_slider_section_content_term_category',
					array(
						'label'     => __( 'Posts Category', 'edufront' ),
						'type'      => \Elementor\Controls_Manager::SELECT2,
						'options'   => edufront_customizer_get_terms( 'category' ),
						'condition' => array(
							'edufront_banner_slider_section_content_taxonomy' => 'category',
						),
					)
				);
			} else {
				$this->add_control(
					'edufront_banner_slider_section_content_term_category',
					array(
						'label'   => __( 'Posts Category', 'edufront' ),
						'type'    => \Elementor\Controls_Manager::SELECT2,
						'options' => edufront_customizer_get_terms( 'category' ),
					)
				);
			}

			$this->add_control(
				'edufront_banner_slider_section_content_total_posts',
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
		 * Creates section content.
		 */
		private function feature_cards() {
			$this->start_controls_section(
				'edufront_banner_slider_section_feature_cards',
				array(
					'label' => __( 'Feature Cards', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_feature_cards_is_enable',
				array(
					'label' => __( 'Enable Cards', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::SWITCHER,
				)
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'card_title',
				array(
					'label'       => __( 'Card Title', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				)
			);

			$repeater->add_control(
				'card_icon',
				array(
					'label'       => __( 'Card Icon', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::ICON,
					'label_block' => true,
				)
			);

			$this->add_control(
				'edufront_banner_slider_section_feature_cards_repeater',
				array(
					'label'       => __( 'Cards', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => array(),
					'condition'   => array(
						'edufront_banner_slider_section_feature_cards_is_enable' => 'yes',
					),
					'title_field' => '{{{ card_title }}}',
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


		private function section_notice_content() {
			$enable_notice = $this->get_settings_for_display( 'edufront_banner_slider_section_notice_is_enable' );

			if ( ! $enable_notice ) {
				return;
			}

			$description = $this->get_settings_for_display( 'edufront_banner_slider_section_notice_description' );
			$btn_label   = $this->get_settings_for_display( 'edufront_banner_slider_section_notice_btn_label' );
			$btn_link    = $this->get_settings_for_display( 'edufront_banner_slider_section_notice_btn_link' );

			$url      = ! empty( $btn_link['url'] ) ? $btn_link['url'] : '';
			$target   = ! empty( $btn_link['is_external'] ) ? ' target="_blank"' : '';
			$nofollow = ! empty( $btn_link['nofollow'] ) ? ' rel="nofollow"' : '';

			?>

			<div class="notice-bar">
				<div class="container">
					<div class="wrapper">
						<button class="notice-bar-cross">⤬</button>
						<div class="inner-wrapper">
							<div class="notice-info">
								<p><?php echo esc_html( $description ); ?></p>
							</div><!-- .notice-info -->
							<div class="join-now-btn">
								<a href="<?php echo esc_url( $url ); ?>" <?php echo esc_attr( $target . $nofollow ); ?> class="join-now"><?php echo esc_html( $btn_label ); ?></a>
							</div><!-- .join-now-btn -->
						</div><!-- .inner-wrapper -->
					</div><!-- .wrapper -->
				</div><!-- .container -->
			</div><!-- .notice-bar -->

			<?php
		}

		/**
		 * This section loop content.
		 */
		private function section_loop_content() {
			?>
			<div <?php post_class(); ?>>
				<div class="background-image img-overlay-5" style="background:url('<?php the_post_thumbnail_url( 'full' ); ?>');">
					<div class="container">
						<div class="slider-content">

							<?php
							the_title(
								'<div class="main-title"><h1 class="title">',
								'</h1></div>'
							);

							if ( get_the_excerpt() ) {
								?>
								<div class="excerpt">
									<?php the_excerpt(); ?>
								</div>
								<?php
							}
							?>

							<div class="banner-button">
								<?php
								if ( 'sfwd-courses' === get_post_type() ) {
									$course_link = get_the_permalink() . '#ld-item-list-' . get_the_ID();
									?>
									<a href="<?php echo esc_url( $course_link ); ?>" class="btn-primary btn-prop"><?php esc_html_e( 'Start Course', 'edufront' ); ?></a>
								<?php } ?>
								<a href="<?php the_permalink(); ?>" class="btn-Secondary btn-prop learn-more"><?php esc_html_e( 'Learn More', 'edufront' ); ?></a>
							</div>

						</div><!-- .slider-content -->
					</div><!-- container -->
				</div><!-- background-image -->
			</div><!-- div -->
			<?php
		}


		private function feature_cards_content() {
			$enable_cards = $this->get_settings_for_display( 'edufront_banner_slider_section_feature_cards_is_enable' );

			if ( ! $enable_cards ) {
				return;
			}

			$cards = $this->get_settings_for_display( 'edufront_banner_slider_section_feature_cards_repeater' );
			?>

			<div class="feature-section">
				<div class="container">
					<div class="wrapper">
						<div class="inner-content">
							<?php
							if ( is_array( $cards ) && ! empty( $cards ) ) {
								foreach ( $cards as $card ) {
									?>
									<div class="feature-item">
										<?php if ( ! empty( $card['card_icon'] ) ) { ?>
											<div class="icon">
												<span><i class="<?php echo esc_attr( $card['card_icon'] ); ?>"></i></span>
											</div>
										<?php } ?>

										<?php if ( ! empty( $card['card_title'] ) ) { ?>
											<div class="feature-name">
												<p><?php echo esc_html( $card['card_title'] ); ?></p>
											</div>
										<?php } ?>
									</div>
									<?php
								}
							}
							?>

						</div>
					</div>
				</div>
			</div><!-- feature-section -->
			<?php
		}

		/**
		 * Render the html to view.
		 */
		protected function render() {
			$tax         = $this->get_settings_for_display( 'edufront_banner_slider_section_content_taxonomy' );
			$key         = "edufront_banner_slider_section_content_term_{$tax}";
			$category    = $this->get_settings_for_display( $key );
			$total_posts = $this->get_settings_for_display( 'edufront_banner_slider_section_content_total_posts' );

			$args = array(
				'post_type'      => 'ld_course_category' === $tax ? 'sfwd-courses' : 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $total_posts,
			);

			if ( ! empty( $category ) ) {
				$args['tax_query'] = array( // phpcs:ignore
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => array( $category ),
					),
				);
			}

			$the_query = new WP_Query( $args );
			?>

			<!-- home-page-banner -->
			<div id="home-banner">
				<div class="wrapper">

					<?php $this->section_notice_content(); ?>

					<div class="inner-content">
						<div class="banner-slider <?php echo esc_attr( $this->get_settings_for_display( 'edufront_banner_slider_section_content_alignment' ) ); ?>">
							<?php
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$this->section_loop_content();
								}
							}
							?>
						</div><!-- .banner-slider -->
					</div><!-- .inner-content -->

					<?php $this->feature_cards_content(); ?>

				</div>
			</div><!-- #home-banner -->

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
					$('.banner-slider').not('.slick-initialized').slick({
						autoplay: true,
						speed: 500,
						infinite: true,
						cssEase: 'linear',
						fade: true,
					});
				});
			</script>
			<?php
		}
	}
}
