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


if ( ! class_exists( 'Edufront_Elementor_Widget_Upcoming_Events' ) ) {

	/**
	 * Create course slider widget.
	 */
	class Edufront_Elementor_Widget_Upcoming_Events extends \Elementor\Widget_Base {



		/**
		 * Get widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'edufront_upcoming_events';
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
			return __( 'Edufront Events', 'edufront' );
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
				'edufront_upcoming_events_section_header',
				array(
					'label' => __( 'Header', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_upcoming_events_section_header_title',
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
				'edufront_upcoming_events_section_content',
				array(
					'label' => __( 'Content', 'edufront' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'edufront_upcoming_events_section_content_term_category',
				array(
					'label'   => __( 'Category', 'edufront' ),
					'type'    => \Elementor\Controls_Manager::SELECT2,
					'options' => edufront_customizer_get_terms( 'category' ),
				)
			);

			$this->add_control(
				'edufront_upcoming_events_section_content_total_posts',
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


		private function content_loop() {

			$post_data = get_post_meta( get_the_ID(), 'edufront_metabox', true );

			$event_date     = isset( $post_data['event_date'] ) ? gmdate( get_option( 'date_format' ), strtotime( $post_data['event_date'] ) ) : '';
			$event_time     = isset( $post_data['event_time'] ) ? $post_data['event_time'] : '';
			$event_location = isset( $post_data['event_location'] ) ? $post_data['event_location'] : '';
			?>
			<div class="grid-item">
				<div class="grid-item__wrapper">

					<?php
					the_title(
						'<div class="post-title"><a href="' . esc_url( get_the_permalink() ) . '"><h3 class="column-title">',
						'</h3></a></div>'
					);
					?>

					<?php if ( get_post_thumbnail_id() ) { ?>
						<div class="img-container">
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						</div>
					<?php } ?>

					<?php if ( $event_date || $event_time || $event_location ) { ?>
					<div class="meta-data">

						<?php if ( $event_date || $event_time ) { ?>
							<div class="date-time-meta">
								<?php if ( $event_date ) { ?>
									<span><i class="far fa-calendar-alt"></i> <?php echo esc_html( $event_date ); ?></span>
								<?php } ?>

								<?php if ( $event_time ) { ?>
									<span><i class="fas fa-clock"></i> <?php echo esc_html( $event_time ); ?></span>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if ( $event_location ) { ?>
						<span class="location">
							<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $event_location ); ?>
						</span>
						<?php } ?>

					</div>
					<?php } ?>

					<?php if ( get_the_excerpt() ) { ?>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>

				</div>
			</div><!-- grid-item -->
			<?php
		}



		/**
		 * Render the html to view.
		 */
		protected function render() {
			$title       = $this->get_settings_for_display( 'edufront_upcoming_events_section_header_title' );
			$category    = $this->get_settings_for_display( 'edufront_upcoming_events_section_content_term_category' );
			$total_posts = $this->get_settings_for_display( 'edufront_upcoming_events_section_content_total_posts' );

			$args = array(
				'post_type'      => 'post',
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

			<div id="upcoming-events">
				<div class="wrapper">
					<div class="container">
						<div class="section-heading">
							<?php if ( $title ) { ?>
								<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
							<?php } ?>
							<div class="section-button">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn-primary btn-prop"><?php esc_html_e( 'View All', 'edufront' ); ?></a>
							</div>
						</div>
						<div class="inner-content">
							<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$this->content_loop();
							}
							?>
						</div>
					</div>
				</div>

			</div><!-- #upcoming-events -->

			<?php
			wp_reset_postdata();
		}
	}
}
