<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Bizbir
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>

		<?php if ( has_post_thumbnail() ) {
			?>
			<div class="entry-thumb aligncenter">
				<?php bizbir_post_thumbnail(); ?>
			</div>
			<?php
		}
		?>
		
		<?php if( bizbir_features_plugin_is_active() && class_exists( 'ACF' ) && is_singular( 'cm-team' ) ) { ?>

			<div class="social-links circle">
				<ul>
					<?php if ( ! empty( get_field( 'team_social_link_1' ) ) ) { ?>
						<li><a href="<?php the_field( 'team_social_link_1' ); ?>" target="_blank"></a></li>
					<?php } ?>

					<?php if ( ! empty( get_field( 'team_social_link_2' ) ) ) { ?>
						<li><a href="<?php the_field( 'team_social_link_2' ); ?>" target="_blank"></a></li>
					<?php } ?>

					<?php if ( ! empty( get_field( 'team_social_link_3' ) ) ) { ?>
						<li><a href="<?php the_field( 'team_social_link_3' ); ?>" target="_blank"></a></li>
					<?php } ?>

					<?php if ( ! empty( get_field( 'team_social_link_4' ) ) ) { ?>
						<li><a href="<?php the_field( 'team_social_link_4' ); ?>" target="_blank"></a></li>
					<?php } ?>

				</ul>
			</div><!-- .social-links -->
		<?php } ?>

		<div class="entry-content-wrapper">
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
			</header><!-- .entry-header -->
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					bizbir_post_posted_on();
					bizbir_post_category_links();
					bizbir_post_posted_by();
					bizbir_post_leave_comment();
					?>
				</div>
			<?php endif; ?>
			<div class="entry-content">
				<?php
				if ( is_singular() ) :
					the_content();
					wp_link_pages();
				else :
					the_excerpt();
				endif;
				?>
			</div><!-- .entry-content -->
		</div>
</article><!-- #post-<?php the_ID(); ?> -->