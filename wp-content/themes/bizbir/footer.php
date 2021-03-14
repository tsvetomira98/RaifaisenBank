<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2019. All Rights reserved.
 */

?>

		</div> <!-- .inner-wrapper -->
		
	</div><!-- #container -->

	<?php bizbir_after_main_container(); ?>
	
</div><!-- #content -->

<div class="footer-container">

	<?php bizbir_before_footer(); ?>

	<?php bizbir_footer(); ?>

	<?php bizbir_after_footer(); ?>
	
</div> <!-- footer-container  -->

</div><!-- #page -->

<?php bizbir_body_bottom(); ?>

<?php wp_footer(); ?>

</body>
</html>
