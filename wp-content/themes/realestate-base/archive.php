<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Realestate_Base
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ); ?>

			<?php endwhile; ?>

		<?php
		/**
		 * Hook - realestate_base_action_posts_navigation.
		 *
		 * @hooked: realestate_base_custom_posts_navigation - 10
		 */
		do_action( 'realestate_base_action_posts_navigation' );?>


		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - realestate_base_action_sidebar.
	 *
	 * @hooked: realestate_base_add_sidebar - 10
	 */
	do_action( 'realestate_base_action_sidebar' );
?>
<?php get_footer(); ?>
