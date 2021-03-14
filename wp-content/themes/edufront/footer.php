<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edufront
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$footer_widgets = array(
	'footer-widgets-1',
	'footer-widgets-2',
	'footer-widgets-3',
	'footer-widgets-4',
);

$payment_options = array(
	'visa',
	'paypal',
	'jcb',
	'ico_mastercard',
);


$display_payment_options = false;
$enable_footer_widgets   = edufront_get_theme_mod( 'enable_footer_widgets' );
$display_social_links    = edufront_get_theme_mod( 'display_social_links' );
$copyright_text          = edufront_get_theme_mod( 'copyright_text' );

$edufront_newsletter_enable = edufront_get_newsletter_form( 0, false );

if ( is_array( $payment_options ) && ! empty( $payment_options ) ) {
	foreach ( $payment_options as $payment_option ) {
		$payment_key = "payment_option_{$payment_option}";
		if ( edufront_get_theme_mod( $payment_key ) ) {
			$display_payment_options = true;
		}
	}
}

?>
<!-- -----------------------scroll up btn -------------------------- -->
<div id="btn-scrollup">
	<a title="<?php esc_attr_e( 'Go to top', 'edufront' ); ?>" class="scrollup" href="#"></a>
</div>


<?php get_template_part( 'template-parts/content', 'pre-footer' ); ?>


<!-- ------------------------------------------------------------------>
<footer id="footer" class="site-footer <?php echo $edufront_newsletter_enable ? esc_attr( 'footer-with-newsletter' ) : null; ?>">

	<?php if ( $enable_footer_widgets ) { ?>
		<div class="container">
			<div class="footer-widgets-inner">
				<div class="inner-wrapper">
					<?php
					if ( is_array( $footer_widgets ) && ! empty( $footer_widgets ) ) {
						foreach ( $footer_widgets as $footer_widget ) {
							if ( is_active_sidebar( $footer_widget ) ) {
								?>
								<aside class="wp-widget">
									<?php dynamic_sidebar( $footer_widget ); ?>
								</aside>
								<?php
							}
						}
					}
					?>
				</div><!-- inner-wrapper -->
			</div><!-- .footer-widgets-inner -->
		</div><!-- .container -->
	<?php } ?>


	<?php if ( $display_payment_options || $display_social_links ) { ?>
		<div class="payment-info-n-social-icon">
			<div class="wrapper">
				<div class="container">
					<div class="inner-content">


						<?php
						if ( $display_payment_options && is_array( $payment_options ) && ! empty( $payment_options ) ) {
							?>
							<div class="payment-content">
								<h4><?php esc_html_e( 'Payment Options', 'edufront' ); ?></h4>
								<div class="payment-option">
									<?php
									foreach ( $payment_options as $payment_option ) {
										$payment_key = "payment_option_{$payment_option}";
										if ( ! edufront_get_theme_mod( $payment_key ) ) {
											continue;
										}

										$payment_icon_url = get_template_directory_uri() . "/assets/images/{$payment_option}.png";
										?>
										<a>
											<img src="<?php echo esc_url( $payment_icon_url ); ?>">
										</a>
										<?php
									}
									?>
								</div><!-- .payment-option -->
							</div><!-- .payment-content -->
							<?php

						}
						?>


						<?php if ( $display_social_links && edufront_social_link_lists( false ) ) { ?>
							<div class="social-icon-content">
								<div class="social-navigation-wrapper">
									<div class="site-social">
										<h4><?php esc_html_e( 'Follow Us', 'edufront' ); ?></h4>
										<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'edufront' ); ?>">
											<div class="menu-social-container">
												<ul id="menu-social" class="menu">

													<?php edufront_social_link_lists(); ?>

												</ul><!-- #menu-social -->
											</div><!-- .menu-social-container -->
										</nav><!-- .social-navigation -->
									</div><!-- .site-social -->
								</div><!-- .social-navigation-wrapper -->
							</div><!-- .social-icon-content -->
						<?php } ?>


					</div><!-- .inner-content -->
				</div><!-- .container -->

			</div><!-- .wrapper -->
		</div><!-- .payment-info-n-social-icon -->
	<?php } ?>

	<div class="footer-bottom">

		<div class="container">
			<div class="wrapper <?php echo has_nav_menu( 'footer-menu' ) ? '' : 'align-center'; ?>">

				<?php if ( $copyright_text ) { ?>
					<div id="colophon" class="site-credit">
						<div class="site-info">
							<?php echo wp_kses_post( $copyright_text ); ?>
						</div><!-- .site-info -->
					</div><!-- #colophon -->
				<?php } ?>

				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer-menu',
						'menu_id'         => '',
						'container_class' => 'right-content',
						'menu_class'      => 'listing',
						'fallback_cb'     => false,
					)
				);
				?>

			</div><!-- wrapper -->
		</div><!-- container -->

	</div><!-- .footer-bottom -->


</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
