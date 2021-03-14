<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'edufront_breadcrumb' ) ) {

	/**
	 * Prints breadcrumb.
	 */
	function edufront_breadcrumb( $display = true ) {

		if ( ! class_exists( 'Edufront_Breadcrumb_Trail' ) && ! function_exists( 'edufront_breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/inc/breadcrumb-class.php';
		}

		$breadcrumb            = '';
		$use_yoast_breadcrumbs = function_exists( 'yoast_breadcrumb' ) && yoast_breadcrumb( '', '', false ) ? true : false;

		$args = array(
			'container'     => 'div',
			'show_on_front' => false,
			'show_browse'   => false,
			'echo'          => false,
		);

		$breadcrumb_html = edufront_breadcrumb_trail( $args );

		$breadcrumb .= '<!-- Breadcrumb Starts -->';

		if ( $use_yoast_breadcrumbs ) {
			/**
			 * Add support for yoast breadcrumb.
			 */
			$breadcrumb .= yoast_breadcrumb( '<div id="breadcrumb"><div class="breadcrumbs breadcrumb-trail">', '</div></div><!-- Breadcrumbs-end -->', false );
		} else {
			if ( $breadcrumb_html ) {
				$breadcrumb .= '<div id="breadcrumb">';
				$breadcrumb .= '<div class="breadcrumbs breadcrumb-trail">';
				$breadcrumb .= $breadcrumb_html;
				$breadcrumb .= '</div>';
				$breadcrumb .= '</div>';
			}
		}

		$breadcrumb .= '<!-- Breadcrumb Ends -->';

		if ( ! $display ) {
			return $breadcrumb;
		}
		echo $breadcrumb; // phpcs:ignore

	}
}


if ( ! function_exists( 'edufront_banner' ) ) {

	/**
	 * Prints the banner html.
	 */
	function edufront_banner() {
		get_template_part( 'template-parts/content', 'banner' );
	}
}


if ( ! function_exists( 'edufront_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function edufront_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		/* translators: %s: post date. */
		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fas fa-clock"></i> ' . $time_string . '</a>';

		echo '<div class="date-meta">' . $posted_on . '</div><!-- .date-meta -->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'edufront_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function edufront_posted_by() {
		?>
		<span class="posted-by">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fas fa-user"></i> <?php echo esc_html( get_the_author() ); ?></a>
		</span><!-- .posted-by-->
		<?php
	}
endif;

if ( ! function_exists( 'edufront_entry_comment_link' ) ) {
	/**
	 * Prints the html for comment link.
	 */
	function edufront_entry_comment_link() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<span class="comments-link">
				<a href="<?php comments_link(); ?>">
					<i class="fas fa-comment"></i> <?php echo esc_html( get_comments_number() ); ?>
				</a>
			</span><!-- .comment-link-->
			<?php
		}
	}
}
if ( ! function_exists( 'edufront_entry_category_lists' ) ) {
	/**
	 * Prints the html for category listing.
	 */
	function edufront_entry_category_lists() {
		if ( is_single() || is_archive() || is_home() ) {
			?>
			<span class="cat-links"><i class="fas fa-bookmark"></i>
				<?php the_category( ', ' ); ?>
			</span><!-- .cat-links -->
			<?php
		}
	}
}
if ( ! function_exists( 'edufront_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function edufront_entry_footer() {
		edufront_posted_by();
		edufront_entry_comment_link();
		edufront_entry_category_lists();
	}
endif;

if ( ! function_exists( 'edufront_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function edufront_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
