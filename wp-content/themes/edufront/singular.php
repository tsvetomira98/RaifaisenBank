<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package edufront
 */

get_header();

$key = '';

if ( is_single() ) {
	$key = 'layout_posts';
} elseif ( is_page() ) {
	$key = 'layout_pages';
}

$layout = edufront_get_theme_mod( $key );

edufront_banner();
?>

<div class="content">
	<div class="container">
		<div class="inner-wrapper <?php echo esc_attr( $layout ); ?>">

			<?php
			if ( 'left-sidebar' === $layout ) {
				get_sidebar();
			}
			?>

			<main id="primary" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'singular' );

					?>
					<div class="single-page-pagination ">
					<?php
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'edufront' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'edufront' ) . '</span> <span class="nav-title">%title</span>',
							)
						);
					?>
					</div>
					<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					get_template_part( 'template-parts/content', 'author-description' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->


			<?php
			if ( 'right-sidebar' === $layout ) {
				get_sidebar();
			}
			?>

		</div><!-- .inner-wrapper -->
	</div><!-- .container -->
</div><!-- .content -->

<?php get_footer(); ?>
