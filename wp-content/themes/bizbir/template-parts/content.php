<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bizbir
 * @since 1.0.0
 * @author Copyright 2019 CodeManas. All Rights Reserved.
 */

$archive_column = Bizbir_Theme_Options::get_option( 'field-blog-archive-column' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); ?>>
	
		<div class="entry-content-wrapper box-shadow-block">

	        <?php bizbir_main_content(); ?>

		</div><!-- .entry-content-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->
