<?php
/**
 * Template part for the pre footer logo lists.
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$edufront_newsletter_enable = edufront_get_newsletter_form( 0, false );

?>

<div id="logo-section" class="<?php echo $edufront_newsletter_enable ? esc_attr( 'logo-with-newsletter' ) : null; ?>">


	<?php
	if ( edufront_get_newsletter_form( 0, false ) ) {
		$newsletter_heading     = edufront_get_theme_mod( 'newsletter_heading' );
		$newsletter_description = edufront_get_theme_mod( 'newsletter_description' );
		?>
		<!-- newsletter -->
		<div id="newsletter-section">
			<div class="container">
				<div class="wrapper">
					<div class="left-content">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/newsletter-icon.png">
					</div>
					<div class="right-content">
						<div class="right-content-wrapper">
							<?php if ( $newsletter_heading || $newsletter_description ) { ?>
								<div class="right-top">
									<?php if ( $newsletter_heading ) { ?>
										<h2 class="title"><?php echo esc_html( $newsletter_heading ); ?></h2>
									<?php } ?>
									<?php if ( $newsletter_description ) { ?>
										<p class="disclaimer"><?php echo esc_html( $newsletter_description ); ?></p>
									<?php } ?>
								</div><!-- top-content -->
								<?php } ?>
								<div class="right-bottom">
									<?php edufront_get_newsletter_form(); ?>
								</div><!-- right-content -->
						</div>
					</div>
				</div><!-- wrapper -->
			</div><!-- container -->
		</div><!-- newsletter-section -->
	<?php } ?>

</div>
