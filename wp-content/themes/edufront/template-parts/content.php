<?php

/**
 * Template part for displaying posts
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


?>


<article <?php post_class( 'grid-item' ); ?> id="post-<?php the_ID(); ?>">
    <div class="wrapper">
        <div class="top-content">
            <header class="entry-header">
                <?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
            </header><!-- .entry-header -->
            <div class="comment-cat">
                <?php
					edufront_entry_comment_link();
					edufront_entry_category_lists();
				?>
            </div>
            <div class="img-container img-overlay-3">
                <?php
				edufront_post_thumbnail();
			?>
            </div><!-- img-container -->
            <div class="date-posted-by">
                <?php
				edufront_posted_by();
				edufront_posted_on();
			?>
            </div><!-- date-posted-by -->

            <div class="entry-content">
                <div class="excerpt">
                    <?php the_excerpt(); ?>
                </div>
                
            </div><!-- .entry-content -->
		</div><!-- top-content -->
		<div class="bottom-content">
			<a class="btn-Secondary btn-prop own-prop"
                    href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'edufront' ); ?></a>
                <!-- readmore -->
		</div>
    </div><!-- wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->