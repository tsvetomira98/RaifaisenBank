<?php
if ( ! function_exists( 'bizbir_show_comments' ) ) {
	/**
	 * Show main Comments section
	 */
	function bizbir_show_comments() {
		?>
        <h4 class="comments-title-section">
				<span>
				<?php
				$code_manas_comment_count = get_comments_number();
				if ( '1' === $code_manas_comment_count ) {
					printf( /* translators: 1: title. */
						esc_html__( '1 comment', 'bizbir' ), '<span>' . get_the_title() . '</span>' );
				} else {
					printf( esc_html( _nx( '%1$s comment', '%1$s comments', $code_manas_comment_count, 'comments title', 'bizbir' ) ), number_format_i18n( $code_manas_comment_count ), '<span>' . get_the_title() . '</span>' );
				}
				?>
				</span>
        </h4>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'max_depth'   => 4,
				'short_ping'  => true,
				'avatar_size' => '100',
			) );
			?>
        </ol>
		<?php
	}
}