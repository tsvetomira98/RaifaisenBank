<?php
/**
 * Author info for single posts
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

if ( ! function_exists( 'bizbir_author_info' ) ) {
	/**
	 * Paginate the posts
	 */
	function bizbir_author_info() {
		$author_info_enable = Bizbir_Theme_Options::get_option( 'field-single-author-info-enable' );
		if ( ! $author_info_enable ) {
			return;
		}
		?>

		<div class="authorbox ">
			<div class="author-avatar">
				<?php echo get_avatar(  get_the_author_meta( 'ID' ) ); ?>
			</div>
			<div class="author-info">
				<h4 class="author-header">
					<?php _e( 'Published by', 'bizbir' ); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php echo esc_html( get_the_author() ); ?>
					</a>   
				</h4>
				<div class="author-content">
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div> <!-- .author-info -->
		</div> <!-- .authorbox -->

		<?php
	}
}