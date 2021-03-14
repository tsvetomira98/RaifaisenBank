<?php 
if( ! is_active_sidebar( 'footer-one' ) && ! is_active_sidebar( 'footer-two' ) && ! is_active_sidebar( 'footer-three' ) && ! is_active_sidebar( 'footer-four' )  ){
	return;
} 
?>

<div id="footer-widgets">
	<div class="container">
		<div class="inner-wrapper">
			<?php 

			bizbir_before_footer_widgets();

			bizbir_get_footer_widgets(); 

			bizbir_after_footer_widgets();

			?>
		</div><!-- .inner-wrapper -->
	</div>  <!-- .container -->
</div> <!-- #footer-widgets -->