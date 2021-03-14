<?php
/**
 * Header main layout template
 *
 * @since 1.0.0
 * @author CodeManas
 * @copyright 2019 CodeManas. All RIghts Reserved !
 */
?>

<header id="masthead" class="header-v1 site-header  <?php echo bizbir_sticky_main_nav(); ?> <?php echo bizbir_header_menu_layouts(); ?>" >

	<div class="box-header-wrapper">

		<div class="container">

			<?php bizbir_before_masthead_content(); ?>

			<?php bizbir_masthead_content(); ?>

			<?php bizbir_after_masthead_content(); ?>

		</div> <!-- .container -->

	</div>

</header>

