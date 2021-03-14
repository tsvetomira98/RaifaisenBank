<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufront
 */

get_header();

$key = '';

if ( is_archive() || is_home() ) {
	$key = 'layout_archives_blogs';
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
				<div class="blog-post">
					<div class="wrapper">
						<div class="grid-collection">
							<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>
						</div><!-- .grid-collection -->

						<?php the_posts_pagination(); ?>

					</div><!-- .wrapper -->
				</div><!-- .blog-post -->

			</main><!-- #main -->

			<?php
			if ( 'right-sidebar' === $layout ) {
				get_sidebar();
			}
			?>


		</div><!-- .inner-wrapper -->
	</div><!-- .container -->
</div><!-- .content -->

<?php
get_footer();

