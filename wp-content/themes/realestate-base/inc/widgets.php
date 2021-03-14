<?php
/**
 * Theme widgets.
 *
 * @package Realestate_Base
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'realestate_base_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_load_widgets() {

		// Social widget.
		register_widget( 'Realestate_Base_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Realestate_Base_Featured_Page_Widget' );

		// Latest News widget.
		register_widget( 'Realestate_Base_Latest_News_Widget' );

		// Call To Action widget.
		register_widget( 'Realestate_Base_Call_To_Action_Widget' );

		// Services widget.
		register_widget( 'Realestate_Base_Services_Widget' );

		// Recent Posts widget.
		register_widget( 'Realestate_Base_Recent_Posts_Widget' );

		if ( class_exists( 'WooCommerce' ) ) {
			// Products Grid widget.
			register_widget( 'Realestate_Base_Products_Grid_Widget' );
		}

		if ( class_exists( 'Projects' ) || class_exists( 'Essential_Content_Types' ) || class_exists( 'Essential_Content_Types_Pro' ) ) {
			// Portfolio widget.
			register_widget( 'Realestate_Base_Portfolio_Widget' );
		}
	}

endif;

add_action( 'widgets_init', 'realestate_base_load_widgets' );

if ( ! class_exists( 'Realestate_Base_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Social_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_social',
				'description'                 => __( 'Displays social icons.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'realestate-base' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'realestate-base-social', __( 'RB: Social', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Featured_Page_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => __( 'Use Page/Post Title as Widget Title', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'featured_page' => array(
					'label'            => __( 'Select Page:', 'realestate-base' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base' ),
					),
				'id_message' => array(
					'label'            => '<strong>' . _x( 'OR', 'Featured Page Widget', 'realestate-base' ) . '</strong>',
					'type'             => 'message',
					),
				'featured_post' => array(
					'label'             => __( 'Post ID:', 'realestate-base' ),
					'placeholder'       => __( 'Eg: 1234', 'realestate-base' ),
					'type'              => 'text',
					'sanitize_callback' => 'realestate_base_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => __( 'Show Content:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => __( 'Excerpt', 'realestate-base' ),
						'full'    => __( 'Full', 'realestate-base' ),
						),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base' ),
					'description' => __( 'Applies when Excerpt is selected in Content option.', 'realestate-base' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 100,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base' ),
					'type'    => 'select',
					'options' => realestate_base_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => __( 'Image Alignment:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => realestate_base_get_image_alignment_options(),
					),
				);

			parent::__construct( 'realestate-base-featured-page', __( 'RB: Featured Page', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			$our_id = '';

			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}

			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}

			if ( absint( $our_id ) > 0 ) {
				$qargs = array(
					'p'             => absint( $our_id ),
					'post_type'     => 'any',
					'no_found_rows' => true,
					);

				$the_query = new WP_Query( $qargs );
				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						echo '<div class="featured-page-widget image-align' . esc_attr( $params['featured_image_alignment'] ) . ' entry-content">';

						if ( 'disable' != $params['featured_image'] && has_post_thumbnail() ) {
							echo '<div class="featured-image post-thumbnail">';
								the_post_thumbnail( esc_attr( $params['featured_image'] ) );
							echo '</div><!-- .featured-image.post-thumbnail -->';
						}

						echo '<div class="featured-page-content">';

						if ( true === $params['use_page_title'] ) {
							the_title( $args['before_title'], $args['after_title'] );
						} else {
							if ( $params['title'] ) {
								echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
							}
						}

						if ( ! empty( $params['subtitle'] ) ) {
							echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
						}

						if ( 'excerpt' === $params['content_type'] && absint( $params['excerpt_length'] ) > 0 ) {
							$excerpt = realestate_base_the_excerpt( absint( $params['excerpt_length'] ) );
							echo wp_kses_post( wpautop( $excerpt ) );
							echo '<a href="'  . esc_url( get_permalink() ) . '" class="more-link">' . esc_html__( 'Know More', 'realestate-base' ) . '</a>';
						} else {
							the_content();
						}

						echo '</div><!-- .featured-page-content -->';
						echo '</div><!-- .featured-page-widget -->';
					}

					wp_reset_postdata();
				}

			}

			echo $args['after_widget'];
		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Latest_News_Widget' ) ) :

	/**
	 * Latest news widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Latest_News_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'realestate_base_widget_latest_news',
				'description'                 => __( 'Displays latest posts in grid.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'realestate-base' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'realestate-base' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'realestate-base' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => __( 'Number of Columns:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 3,
					'options' => realestate_base_get_numbers_dropdown_options( 3, 4 ),
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 'realestate-base-thumb',
					'options' => realestate_base_get_image_sizes_options(),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base' ),
					'description' => __( 'in words', 'realestate-base' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'more_text' => array(
					'label'   => __( 'More Text:', 'realestate-base' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base' ),
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_cat' => array(
					'label'   => __( 'Disable Category', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_excerpt' => array(
					'label'   => __( 'Disable Excerpt', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_more_text' => array(
					'label'   => __( 'Disable More Text', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'realestate-base-latest-news', __( 'RB: Latest News', 'realestate-base' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}
			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="latest-news-widget latest-news-col-<?php echo esc_attr( $params['post_column'] ); ?>">

					<div class="inner-wrapper">

						<?php foreach ( $all_posts as $key => $post ) : ?>
							<?php setup_postdata( $post ); ?>

							<div class="latest-news-item">
								<div class="latest-news-inner">
										<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
											<div class="latest-news-thumb">
												<a href="<?php the_permalink(); ?>">
													<?php
													$img_attributes = array( 'class' => 'aligncenter' );
													the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
													?>
												</a>
											</div><!-- .latest-news-thumb -->
										<?php endif; ?>
										<div class="latest-news-text-wrap">

											<div class="latest-news-text-content">
												<h3 class="latest-news-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3><!-- .latest-news-title -->
												<div class="entry-meta latest-news-meta">
													<?php if ( false === $params['disable_date'] ) : ?>
														<span class="posted-on">
															<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
														</span>
													<?php endif; ?>

													<?php if ( false === $params['disable_cat'] ) : ?>
														<?php $category = realestate_base_get_single_post_category(); ?>
														<?php if ( ! empty( $category ) ) : ?>
															<span class="cat-links"><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></span>
														<?php endif; ?>
													<?php endif; ?>

												</div><!-- .latest-news-meta -->
												<?php if ( false === $params['disable_excerpt'] ) : ?>
													<div class="latest-news-summary">
													<?php
													$summary = realestate_base_the_excerpt( esc_attr( $params['excerpt_length'] ), $post );
													echo wp_kses_post( wpautop( $summary ) );
													?>
													</div><!-- .latest-news-summary -->
												<?php endif; ?>
											</div><!-- .latest-news-text-content -->

											<?php if ( false === $params['disable_more_text'] ) : ?>
												<a class="know-more" href="<?php the_permalink(); ?>" class="learn-more"><?php echo esc_html( $params['more_text'] ); ?><span class="screen-reader-text">"<?php the_title(); ?>"</span>
												</a>
											<?php endif; ?>

										</div><!-- .latest-news-text-wrap -->
									</div><!-- .latest-news-inner -->
							</div><!-- .latest-news-item -->

						<?php endforeach; ?>
					</div><!-- .row -->

				</div><!-- .latest-news-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Call_To_Action_Widget' ) ) :

	/**
	 * Call to action widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Call_To_Action_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_call_to_action',
				'description'                 => __( 'Call To Action Widget.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'description' => array(
					'label' => __( 'Description:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'primary_button_text' => array(
					'label'   => __( 'Primary Button Text:', 'realestate-base' ),
					'default' => __( 'Learn more', 'realestate-base' ),
					'type'    => 'text',
					'class'   => 'widefat',
					),
				'primary_button_url' => array(
					'label' => __( 'Primary Button URL:', 'realestate-base' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				'secondary_button_text' => array(
					'label'   => __( 'Secondary Button Text:', 'realestate-base' ),
					'default' => '',
					'type'    => 'text',
					'class'   => 'widefat',
					),
				'secondary_button_url' => array(
					'label' => __( 'Secondary Button URL:', 'realestate-base' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				'background_image' => array(
					'label'   => __( 'Background Image:', 'realestate-base' ),
					'type'    => 'image',
					'default' => '',
					),
				'background_image_message' => array(
					'label'   => sprintf( __( 'Recommended image size: %1$dpx X %2$dpx', 'realestate-base' ) , 1920, 390 ),
					'type'    => 'message',
					),
				'enable_background_overlay' => array(
					'label'   => __( 'Enable Background Overlay', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				);

			parent::__construct( 'realestate-base-call-to-action', __( 'RB: Call To Action', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// Add background image.
			if ( ! empty( $params['background_image'] ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $params['background_image'] ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="', explode( 'class="', $args['before_widget'], 2 ) );
			}

			// Add overlay class.
			$overlay_class = ( true === $params['enable_background_overlay'] ) ? 'overlay-enabled' : 'overlay-disabled';
			$args['before_widget'] = implode( 'class="' . $overlay_class . ' ', explode( 'class="', $args['before_widget'], 2 ) );

			echo $args['before_widget'];
			echo '<div class="call-to-action-main-wrap">';
			echo '<div class="call-to-action-content-wrap">';
			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			?>
			<div class="call-to-action-content">
				<?php if ( ! empty( $params['description'] ) ) : ?>
					<div class="call-to-action-description">
						<?php echo wp_kses_post( wpautop( $params['description'] ) ); ?>
					</div><!-- .call-to-action-description -->
				<?php endif; ?>
			</div><!-- .call-to-action-content -->
			<?php echo '</div>'; ?>
			<?php if ( ( ! empty( $params['primary_button_text'] ) && ! empty( $params['primary_button_url'] ) ) || ( ! empty( $params['secondary_button_text'] ) && ! empty( $params['secondary_button_url'] ) )  ) : ?>
				<div class="call-to-action-buttons">
					<?php if ( ! empty( $params['primary_button_url'] ) && ! empty( $params['primary_button_text'] ) ) : ?>
						<a href="<?php echo esc_url( $params['primary_button_url'] ); ?>" class="custom-button btn-call-to-action button-primary"><?php echo esc_html( $params['primary_button_text'] ); ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $params['secondary_button_url'] ) && ! empty( $params['secondary_button_text'] ) ) : ?>
						<a href="<?php echo esc_url( $params['secondary_button_url'] ); ?>" class="custom-button btn-call-to-action button-secondary"><?php echo esc_html( $params['secondary_button_text'] ); ?></a>
					<?php endif; ?>
				</div><!-- .call-to-action-buttons -->
			<?php endif; ?>
			<?php echo '</div>'; ?>
			<?php

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Services_Widget' ) ) :

	/**
	 * Services widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Services_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_services',
				'description'                 => __( 'Show your services with icon and read more link.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base' ),
					'description' => __( 'in words', 'realestate-base' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'disable_excerpt' => array(
					'label'   => __( 'Disable Excerpt', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'more_text' => array(
					'label'   => __( 'Read More Text:', 'realestate-base' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base' ),
					),
				'disable_more_text' => array(
					'label'   => __( 'Disable Read More', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'enable_image' => array(
					'label'   => __( 'Show featured image instead of icon.', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			for( $i = 1; $i <= 6; $i++ ) {
				$fields[ 'block_heading_' . $i ] = array(
					'label' => __( 'Block', 'realestate-base' ) . ' #' . $i,
					'type'  => 'heading',
					'class' => 'widefat',
					);
				$fields[ 'block_page_' . $i ] = array(
					'label'            => __( 'Select Page:', 'realestate-base' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base' ),
					);
				$fields[ 'block_icon_' . $i ] = array(
					'label'       => __( 'Icon:', 'realestate-base' ),
					'description' => __( 'Eg: fa-cogs', 'realestate-base' ),
					'type'        => 'text',
					'default'     => 'fa-cogs',
					'adjacent'    => true,
					);

				if ( 1 === $i ) {
					$fields[ 'block_icon_message_' . $i ] = array(
						'label' => sprintf( __( 'Reference: %s', 'realestate-base' ), '<a href="https://fontawesome.com/cheatsheet/">' . __( 'View Icons', 'realestate-base' ) . '</a>' ),
						'type'  => 'message',
						);
				}
			}

			parent::__construct( 'realestate-base-services', __( 'RB: Services', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$service_arr = array();
			for ( $i = 0; $i < 6 ; $i++ ) {
				$block = ( $i + 1 );
				$service_arr[ $i ] = array(
					'page' => $params[ 'block_page_' . $block ],
					'icon' => $params[ 'block_icon_' . $block ],
					);
			}
			$refined_arr = array();
			if ( ! empty( $service_arr ) ) {
				foreach ( $service_arr as $item ) {
					if ( ! empty( $item['page'] ) ) {
						$refined_arr[ $item['page'] ] = $item;
					}
				}
			}

			if ( ! empty( $refined_arr ) ) {
				$this->render_widget_content( $refined_arr, $params );
			}

			echo $args['after_widget'];

		}

		/**
		 * Render services content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $service_arr Services array.
		 * @param array $params      Parameters array.
		 */
		function render_widget_content( $service_arr, $params ) {

			$column = count( $service_arr );

			$page_ids = array_keys( $service_arr );

			$qargs = array(
				'posts_per_page' => count( $page_ids ),
				'post__in'       => $page_ids,
				'post_type'      => 'page',
				'orderby'        => 'post__in',
				'no_found_rows'  => true,
			);

			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="service-block-list service-col-<?php echo esc_attr( $column ); ?>">
					<div class="inner-wrapper">

						<?php foreach ( $all_posts as $post ) : ?>
							<?php setup_postdata( $post ); ?>
							<div class="service-block-item">
								<div class="service-block-inner">
									<?php if ( true === $params['enable_image'] ) : ?>

										<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
											<a class="service-icon" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php endif; ?>

									<?php else : ?>

										<?php if ( isset( $service_arr[ $post->ID ]['icon'] ) && ! empty( $service_arr[ $post->ID ]['icon'] ) ) : ?>
											<a class="service-icon" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><i class="<?php echo 'fa ' . esc_attr( $service_arr[ $post->ID ]['icon'] ); ?>"></i></a>
										<?php endif; ?>

									<?php endif; ?>
									<div class="service-block-inner-content">
										<h3 class="service-item-title">
											<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
												<?php echo get_the_title( $post->ID ); ?>
											</a>
										</h3>
										<?php if ( true !== $params['disable_excerpt'] ) :  ?>
											<div class="service-block-item-excerpt">
												<?php
												$excerpt = realestate_base_the_excerpt( $params['excerpt_length'], $post );
												echo wp_kses_post( wpautop( $excerpt ) );
												?>
											</div><!-- .service-block-item-excerpt -->
										<?php endif; ?>

										<?php if ( true !== $params['disable_more_text'] ) :  ?>
											<a class="know-more" href="<?php echo esc_url( get_permalink( $post -> ID ) ); ?>" ><?php echo esc_html( $params['more_text'] ); ?></a>
										<?php endif; ?>
									</div><!-- .service-block-inner-content -->
								</div><!-- .service-block-inner -->
							</div><!-- .service-block-item -->
						<?php endforeach; ?>

					</div><!-- .inner-wrapper -->

				</div><!-- .service-block-list -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
		}

	}
endif;

if ( ! class_exists( 'Realestate_Base_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Recent_Posts_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'realestate-base' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'realestate-base' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'realestate-base' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => realestate_base_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => __( 'Image Width:', 'realestate-base' ),
					'type'        => 'number',
					'description' => __( 'px', 'realestate-base' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 70,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'realestate-base' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'realestate-base-recent-posts', __( 'RB: Recent Posts', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}
			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = $params['post_category'];
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) :  ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) :  ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) :  ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) :  ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Products_Grid_Widget' ) ) :

	/**
	 * Products Grid Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Products_Grid_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_products_grid',
				'description'                 => esc_html__( 'Displays products in grid.', 'realestate-base' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'product_category' => array(
					'label'           => esc_html__( 'Select Product Category:', 'realestate-base' ),
					'type'            => 'dropdown-taxonomies',
					'taxonomy'        => 'product_cat',
					'show_option_all' => esc_html__( 'All Product Categories', 'realestate-base' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Products:', 'realestate-base' ),
					'type'    => 'number',
					'default' => 6,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => esc_html__( 'Number of Columns:', 'realestate-base' ),
					'type'    => 'select',
					'default' => 4,
					'options' => realestate_base_get_numbers_dropdown_options( 3, 4 ),
					),
				);

			parent::__construct( 'realestate-base-products-grid', esc_html__( 'RB: Products Grid', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			// Render now.
			$this->render_products( $params );

			echo $args['after_widget'];

		}

		/**
		 * Render products.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_products( $params ) {

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => esc_attr( $params['post_number'] ),
				'no_found_rows'       => true,
			);
			if ( absint( $params['product_category'] ) > 0 ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => absint( $params['product_category'] ),
						),
					);
			}

			global $woocommerce_loop;
			$products = new WP_Query( $query_args );

			if ( $products->have_posts() ) {
				?>
				<div class="inner-wrapper">
					<div class="realestate-base-woocommerce realestate-base-woocommerce-product-grid-<?php echo absint( $params['post_column'] ); ?>">

						<ul class="products">

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; ?>

						</ul><!-- .products -->

					</div><!-- .woocommerce -->
				</div> <!-- .inner-wrapper -->
				<?php
			}
			woocommerce_reset_loop();
			wp_reset_postdata();

		}
	}
endif;

if ( ! class_exists( '	' ) ) :

	/**
	 * Portfolio widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Portfolio_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'realestate_base_widget_portfolio',
				'description' => __( 'Displays portfolio.', 'realestate-base' ),
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_number' => array(
					'label'   => __( 'No. of Projects:', 'realestate-base' ),
					'type'    => 'number',
					'default' => 6,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => __( 'No. of Columns:', 'realestate-base' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 3,
					'max'     => 4,
					),
				);

			parent::__construct( 'realestate-base-portfolio', __( 'RB: Portfolio', 'realestate-base' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			// Load assets.
			wp_enqueue_script( 'realestate-base-portfolio' );

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$this->render_projects( $params );

			echo $args['after_widget'];

		}

		/**
		 * Render projects.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_projects( $params ) {

			$portfolio_details = array();
			$portfolio_category_details = array();

			if ( class_exists( 'Projects' ) ) {
				$projecttype = "project";
			}
			else {
				$projecttype = "jetpack-portfolio";
			}

			$portfolio_args = array(
				'post_type'      => $projecttype,
				'post_status'    => 'publish',
				'posts_per_page' => absint( $params['post_number'] ),
			);

			// The Query.
			$the_query = new WP_Query( $portfolio_args );
			global $post;

			// The Loop.
			if ( $the_query->have_posts() ) {
				$i = 0;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					$portfolio_item = array();
					$portfolio_item['title'] = get_the_title();
					$portfolio_item['url']   = get_permalink();
					$portfolio_item['image'] = array();
					$portfolio_item['categories'] = array();
					$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-thumb' );
					if ( ! empty( $image_array ) ) {
						$portfolio_item['image'] = $image_array;
					}

					if ( class_exists( 'Projects' ) ) {
						$terms = get_the_terms( $post->ID, 'project-category' );
					}
					else {
						$terms = get_the_terms( $post->ID, 'jetpack-portfolio-type' );
					}

					if ( ! empty( $terms ) && is_array( $terms ) ) {
						$portfolio_item['categories'] = $terms;
						// Push categories to main array.
						foreach ( $terms as $term ) {
							$portfolio_category_details[ $term->slug ] = $term->name;
						}
					}

					$portfolio_details[ $i ] = $portfolio_item;

					$i++;
				} // End while loop.

				// Reset post data.
				wp_reset_postdata();
			}
			?>
			<div class="portfolio-main-wrapper portfolio-wrapper-col-<?php echo absint( $params['post_column'] );?>">

				<?php
				if ( ! empty( $portfolio_category_details ) ) : ?>

					<div class="portfolio-filter">
						<a href="#"  data-filter="*" class="current"><?php _e( 'All', 'realestate-base' ); ?></a>
						<?php foreach ( $portfolio_category_details as $key => $category ) { ?>
							<a data-filter=".<?php echo esc_attr( $key ); ?>" href="#"><?php echo esc_html( $category ); ?></a>
						<?php } ?>
					</div>

				<?php endif; ?>

				<div class="portfolio-container">
					<?php if ( ! empty( $portfolio_details ) ) : ?>
						<?php foreach ( $portfolio_details as $key => $portfolio ) : ?>
							<?php
								$filter_classes = '';
								if ( ! empty( $portfolio['categories'] ) ) {
									foreach ( $portfolio['categories'] as $key => $cat ) {
										$filter_classes .= ' ' . $cat->slug;
									}
								}

							 ?>

							<div class="portfolio-item <?php echo esc_attr( $filter_classes ); ?> ">
								<div class="item-wrapper">
									<h3 class="portfolio-item-title"><a href="<?php echo esc_url( $portfolio['url'] ); ?>"><?php echo esc_html( $portfolio['title'] ); ?></a></h3>
									<?php if ( ! empty( $portfolio['image'] ) ) : ?>
										<a class="portfolio-thumb" href="<?php echo esc_url( $portfolio['url'] ); ?>"><img src="<?php echo esc_url( $portfolio['image'][0] ); ?>" alt="<?php echo esc_attr( $portfolio['title'] ); ?>" /></a>
									<?php endif ?>
								</div><!-- .item-wrapper -->
							</div><!-- .portfolio-item -->

						<?php endforeach ?>
					<?php endif ?>

				</div> <!-- .portfolio-container -->
			</div>
			<?php

		}

	}
endif;
