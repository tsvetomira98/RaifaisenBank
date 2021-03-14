<table class="form-table bizbir-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="page_sidebar"><?php _e( 'Sidebar Positon ?', 'bizbir' ); ?></label></th>
			<td>
				<select name="page_sidebar" class="page_sidebar">
					<option value="default" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'default' ) : false; ?>><?php esc_html_e('Set to Global', 'bizbir'); ?></option>
					<option value="none" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'none' ) : false; ?>><?php esc_html_e('No sidebar', 'bizbir'); ?></option>
					<option value="right" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'right' ) : false; ?>><?php esc_html_e('Right', 'bizbir'); ?></option>
					<option value="left" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'left' ) : false; ?>><?php esc_html_e('Left', 'bizbir'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default sidebar position from customizer for this specific page. Targets buttons and background color elements on this specific page.', 'bizbir' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>