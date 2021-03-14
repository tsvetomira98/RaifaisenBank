<table class="form-table bizbir-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="header_layout"><?php _e( 'Header Layout Options', 'bizbir' ); ?></label></th>
			<td>
				<select name="header_layout">
					<option value="global" <?php !empty( $value['header-layout'] ) ? selected( $value['header-layout'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'bizbir'); ?></option>
					<option value="bizbir-left-logo" <?php !empty( $value['header-layout'] ) ? selected( $value['header-layout'], 'bizbir-left-logo' ) : false; ?>><?php esc_html_e('Left Logo Right Menu', 'bizbir'); ?></option>
					<option value="bizbir-right-logo" <?php !empty( $value['header-layout'] ) ? selected( $value['header-layout'], 'bizbir-right-logo' ) : false; ?>><?php esc_html_e('Right Logo Left Menu', 'bizbir'); ?></option>
					<option value="bizbir-center-logo" <?php !empty( $value['header-layout'] ) ? selected( $value['header-layout'], 'bizbir-center-logo' ) : false; ?>><?php esc_html_e('Center', 'bizbir'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default top header from customizer for this specific page.', 'bizbir' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>