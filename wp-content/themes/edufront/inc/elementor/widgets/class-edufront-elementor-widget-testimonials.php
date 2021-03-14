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


if ( ! class_exists( 'Edufront_Elementor_Widget_Testimonials' ) ) {

	/**
	 * Create slider one widget.
	 */
	class Edufront_Elementor_Widget_Testimonials extends \Elementor\Widget_Base {


		/**
		 * Get widget name.
		 *
		 * Retrieve oEmbed widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_testimonials';
		}


		/**
		 * Get widget title.
		 *
		 * Retrieve oEmbed widget title.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Edufront Testimonials', 'edufront' );
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
				'edufront_testimonials_section_header',
				array(
					'label' => __( 'Header', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_testimonials_section_header_title',
				array(
					'label' => __( 'Title', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$this->add_control(
				'edufront_testimonials_section_header_description',
				array(
					'label' => __( 'Description', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXTAREA,
				)
			);

			$this->add_control(
				'edufront_testimonials_section_header_button_label',
				array(
					'label' => __( 'Button Label', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$this->add_control(
				'edufront_testimonials_section_header_button_link',
				array(
					'label' => __( 'Button Link', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::URL,
				)
			);

			$this->end_controls_section();
		}


		/**
		 * Creates section content.
		 */
		private function section_content() {
			$this->start_controls_section(
				'edufront_testimonials_section_content',
				array(
					'label' => __( 'Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'reviewer_name',
				array(
					'label'       => __( 'Reviewer Name', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				)
			);

			$repeater->add_control(
				'reviewer_position',
				array(
					'label'       => __( 'Reviewer Position', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				)
			);

			$repeater->add_control(
				'reviewer_review',
				array(
					'label'       => __( 'Review', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'label_block' => true,
				)
			);

			$repeater->add_control(
				'reviewer_rating',
				array(
					'label'       => __( 'Rating', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::SELECT2,
					'options'     => array(
						'1' => __( 'One Star', 'edufront' ),
						'2' => __( 'Two Stars', 'edufront' ),
						'3' => __( 'Three Stars', 'edufront' ),
						'4' => __( 'Four Stars', 'edufront' ),
						'5' => __( 'Five Stars', 'edufront' ),
					),
					'label_block' => true,
				)
			);

			$repeater->add_control(
				'reviewer_img',
				array(
					'label'       => __( 'Reviewer Image', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				)
			);

			$this->add_control(
				'edufront_testimonials_section_content_repeater_testimonials',
				array(
					'label'       => __( 'Testimonials', 'edufront' ),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => array(),
					'title_field' => '{{{ reviewer_name }}}',
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
		private function section_header_content() {
			$heading     = $this->get_settings_for_display( 'edufront_testimonials_section_header_title' );
			$description = $this->get_settings_for_display( 'edufront_testimonials_section_header_description' );

			$button_label = $this->get_settings_for_display( 'edufront_testimonials_section_header_button_label' );
			$button_link  = $this->get_settings_for_display( 'edufront_testimonials_section_header_button_link' );
			$url          = ! empty( $button_link['url'] ) ? $button_link['url'] : '';
			$target       = ! empty( $button_link['is_external'] ) ? ' target="_blank"' : '';
			$nofollow     = ! empty( $button_link['nofollow'] ) ? ' rel="nofollow"' : '';

			?>
			<div class="section-heading">
				<div class="title-wrapper">
					<?php echo $heading ? wp_kses_post( "<h4 class='section-subtitle'>{$heading}</h4>" ) : null; ?>
					<?php echo $description ? wp_kses_post( "<h2 class='section-title'>{$description}</h2>" ) : null; ?>
				</div>

				<?php
				if ( $button_label ) {
					?>
					<div class="section-btn">
						<a href="<?php echo esc_url( $url ); ?>" <?php echo esc_attr( $target . $nofollow ); ?> class="btn-prop btn-primary"><?php echo esc_html( $button_label ); ?></a>
					</div>
					<?php
				}
				?>
			</div>

			<?php
		}


		/**
		 * Render the html to view.
		 */
		protected function render() {
			$testimonials = $this->get_settings_for_display( 'edufront_testimonials_section_content_repeater_testimonials' );

			?>

			<div id="testimonial">
				<div class="wrapper">
					<div class="container">
						<div class="slider-content-wrapper">

							<div class="inner-content">
								<div class="testimonial-slider">

									<?php
									if ( is_array( $testimonials ) && ! empty( $testimonials ) ) {
										foreach ( $testimonials as $testimonial ) {

											$rate    = ! empty( $testimonial['reviewer_rating'] ) ? $testimonial['reviewer_rating'] : 0;
											$ratings = $rate ? ( $testimonial['reviewer_rating'] / 5 ) * 100 : 0;
											?>

											<div>
												<div class="slider-content">
													<div class="content">
														<div class="content-wrapper">

															<div class="user-detail">

																<?php if ( ! empty( $testimonial['reviewer_img']['url'] ) ) { ?>
																	<div class="user-image">
																		<img src="<?php echo esc_url( $testimonial['reviewer_img']['url'] ); ?>">
																	</div>
																<?php } ?>

																<div class="detail">
																	<?php if ( ! empty( $testimonial['reviewer_name'] ) ) { ?>
																		<h4 class="user-name"><?php echo esc_html( $testimonial['reviewer_name'] ); ?></h4>
																	<?php } ?>
																	<?php if ( ! empty( $testimonial['reviewer_position'] ) ) { ?>
																		<p><?php echo esc_html( $testimonial['reviewer_position'] ); ?></p>
																	<?php } ?>
																</div>

															</div>


															<?php
															if ( $testimonial['reviewer_review'] ) {
																echo '<div class="saying">' . wp_kses_post( wpautop( $testimonial['reviewer_review'] ) ) . '</div>';
															}

															if ( $ratings ) {
																?>
																<div class="star-rating">
																	<div class="rating">
																		<a tabindex="0">
																			<span style="width:<?php echo esc_attr( $ratings ); ?>%">
																			</span>
																		</a>
																	</div>
																</div><!-- .star-rating -->
																<?php
															}
															?>


														</div>
													</div>
												</div>

											</div><!-- div -->

											<?php
										}
									}
									?>

								</div><!-- testimonial-slider -->
							</div><!-- inner-content -->

							<?php $this->section_header_content(); ?>
						</div>

					</div>
				</div>

			</div><!-- #testimonial -->


			<?php
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

					$('.testimonial-slider').not('.slick-initialized').slick({
						dots: true,
						infinite: false,
						speed: 300,
						slidesToShow: 2,
						rows: 2,
						centerPadding: '40px',
						slidesToScroll: 1,
						responsive: [{
								breakpoint: 1024,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 1,
									infinite: true
								}
							},
							{
								breakpoint: 768,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									rows: 1,
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
