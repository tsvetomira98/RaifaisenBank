<?php
/**
 * Template part for the author descriptions.
 */
?>
<div class="author-description"> <!-- this section should be between pagination and comment -->
	<div class="wrapper">
		<div class="inner-content">
			<div class="user-description">
				<div class="user-img">
					<img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'user_email' ) ) ); ?>">
				</div>

				<?php if ( get_the_author_meta( 'display_name' ) ) { ?>
				<div class="author">
					<p><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
				</div>
				<?php } ?>

			</div><!-- user-description -->

			<?php if ( get_the_author_meta( 'description' ) ) { ?>
				<div class="excerpt">
					<p><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
				</div><!-- excerpt -->
			<?php } ?>
		</div><!-- inner-content -->
	</div><!-- wrapper -->
</div><!-- author-description -->
