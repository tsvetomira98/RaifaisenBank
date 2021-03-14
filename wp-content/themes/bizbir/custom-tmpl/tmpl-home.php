<?php /* Template Name: Homepage */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" >

		<?php
		bizbir_homepage_before_main_content();

		bizbir_homepage_main_content();

		bizbir_homepage_after_main_content();

		?>

	</main> <!-- #main -->
</div> <!-- #primary -->

<?php 

get_footer();