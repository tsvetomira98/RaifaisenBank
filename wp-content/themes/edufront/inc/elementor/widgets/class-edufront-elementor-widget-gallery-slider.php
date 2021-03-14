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


if ( ! class_exists( 'Edufront_Elementor_Widget_Gallery_Slider' ) ) {

	/**
	 * Create course slider widget.
	 */
	class Edufront_Elementor_Widget_Gallery_Slider extends \Elementor\Widget_Base {


		/**
		 * Get widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_gallery_slider';
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
			return __( 'Edufront Gallery Slider', 'edufront' );
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
			$this->section_style();
		}


		/**
		 * Creates section heading.
		 */
		private function section_header() {
			$this->start_controls_section(
				'edufront_gallery_slider_section_header',
				array(
					'label' => __( 'Header', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_header_title',
				array(
					'label' => __( 'Title', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$this->end_controls_section();
		}

		/**
		 * Creates section content.
		 */
		private function slider_content() {
			$this->start_controls_section(
				'edufront_gallery_slider_section_content',
				array(
					'label' => __( 'Slider Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_content_gallery_images',
				array(
					'label' => __( 'Gallery Images', 'edufront' ),
					'type'  => \Elementor\Controls_Manager::GALLERY,
				)
			);

			$this->end_controls_section();
		}

		/**
		 * Creates and adds options to style tab.
		 */
		private function section_style() {
			$this->start_controls_section(
				'edufront_gallery_slider_section_style',
				array(
					'label' => __( 'Colors', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_style_title_color',
				array(
					'label'   => __( 'Title Color', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_style_slider_button_background_color',
				array(
					'label'   => __( 'Button Background Color', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::COLOR,
					'default' => '#5B5B5B',
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_style_slider_button_background_hover_color',
				array(
					'label'   => __( 'Button Background Hover Color', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
				)
			);

			$this->add_control(
				'edufront_gallery_slider_section_style_slider_button_icon_color',
				array(
					'label'   => __( 'Button Icon Color', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::COLOR,
					'default' => '#959595',
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
			$title = $this->get_settings_for_display( 'edufront_gallery_slider_section_header_title' );
			?>
			<style>
				#page #home-sections #gallery .wrapper .section-heading .section-title {
					color: <?php echo esc_attr( sanitize_hex_color( $this->get_settings_for_display( 'edufront_gallery_slider_section_style_title_color' ) ) ); ?> !important;
				}
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-prev,
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-next {
					background-color: <?php echo esc_attr( sanitize_hex_color( $this->get_settings_for_display( 'edufront_gallery_slider_section_style_slider_button_background_color' ) ) ); ?> !important;
				}
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-prev:hover,
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-next:hover {
					background-color: <?php echo esc_attr( sanitize_hex_color( $this->get_settings_for_display( 'edufront_gallery_slider_section_style_slider_button_background_hover_color' ) ) ); ?> !important;
				}
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-prev:before,
				#page #home-sections #gallery .wrapper .section-heading .gallery-nav .slick-next:before {
					color: <?php echo esc_attr( sanitize_hex_color( $this->get_settings_for_display( 'edufront_gallery_slider_section_style_slider_button_icon_color' ) ) ); ?> !important;
				}
			</style>
			<div class="section-heading">

				<?php if ( $title ) { ?>
					<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
				<?php } ?>

				<div class="gallery-nav">
					<button class="slick-prev"></button>
					<button href="" class="slick-next"></button>
				</div>

			</div>
			<?php

		}



		/**
		 * Render the html to view.
		 */
		protected function render() {

			$gallery_images = $this->get_settings_for_display( 'edufront_gallery_slider_section_content_gallery_images' );

			?>

			<div id="gallery">
				<div class="container">
					<div class="wrapper">
						<?php $this->section_header_content(); ?>

						<div class="inner-container">
							<div class="gallery-slider">
								<?php
								if ( is_array( $gallery_images ) && ! empty( $gallery_images ) ) {
									foreach ( $gallery_images as $gallery_image ) {
										if ( empty( $gallery_image['url'] ) ) {
											continue;
										}
										?>

										<div>
											<div class="slider-item">
												<a href="<?php echo esc_url( $gallery_image['url'] ); ?>" class="img-container">
													<img src="<?php echo esc_url( $gallery_image['url'] ); ?>">
												</a>
											</div>
										</div><!-- div -->

										<?php
									}
								}
								?>

							</div><!-- gallery-slider -->
						</div><!-- inner-container -->
					</div>
				</div>
			</div> <!-- gallery -->

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

					$('.gallery-slider').not('.slick-initialized').slick({
						dots: false,
						infinite: false,
						speed: 300,
						slidesToShow: 5,
						centerPadding: '40px',
						slidesToScroll: 1,
						responsive: [{
								breakpoint: 1600,
								settings: {
									slidesToShow: 4,
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
									slidesToShow: 2,
									slidesToScroll: 1
								}
							},
							{
								breakpoint: 520,
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
