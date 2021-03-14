<?php
/**
 * Template for Front page
 *
 * Template name: Edufront Frontpage
 *
 * @package edufront
 */

if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
} else {
	get_header(); ?>

	<div id="home-sections">
		<?php
		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			?>
			<div class="container">
				<div class="section-wrapper">
				<?php
				while ( have_posts() ) {
					the_post();
					the_content();
				}
				?>
				</div>
			</div>
			<?php
		} else {
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		}
		?>
	</div><!-- #home-sections -->

	<?php
	get_footer();

}
