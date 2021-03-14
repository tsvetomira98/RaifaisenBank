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

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( is_front_page() ) {
	return;
}
$thumb_url = get_the_post_thumbnail_url( null, 'full' );
if ( is_singular() ) {
	$thumbnail_url = $thumb_url ? $thumb_url : get_header_image();
} else {
	$thumbnail_url = has_header_image() ? get_header_image() : $thumb_url;
}

?>
<div id="custom-header">
	<div class="container">
		<div class="custom-header-content has-background-image" style="background-image:url('<?php echo esc_url( $thumbnail_url ); ?>');">
			<div class="inner-wrapper">
				<h1><?php wp_title( ' ' ); ?></h1>

				<!-- breadcrumb -->
				<?php edufront_breadcrumb(); ?>
			</div><!-- .inner-wrapper -->
		</div><!-- .custom-header-content -->
	</div><!-- .container -->
</div><!-- #custom-header -->
