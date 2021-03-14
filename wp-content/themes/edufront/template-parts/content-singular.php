<?php

/**
 * Template part for displaying page content in single page and posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufront
 */

?>

<div class="singular-content-wrapper ">
	<!-- class no-thumbnail is used when there is no feature image -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-detail">
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<div class="single-post-meta-info">
				<div class="content-wrapper">
					<footer class="entry-footer">
						<?php edufront_entry_footer(); ?>
					</footer><!-- entry-footer -->
				</div>

			</div><!-- single-post-meta-info -->
		</div>
		<div class="post-title">
			<?php
			the_title( '<h2 class="entry-title">', '</h2>' );
			?>
		</div>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edufront' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<?php if ( get_the_tags() ) { ?>
			<div class="post-tags">
				<?php the_tags(); ?>
			</div>
		<?php } ?>


	</article><!-- #post-<?php the_ID(); ?> -->
</div>
