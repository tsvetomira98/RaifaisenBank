<table class="form-table bizbir-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="footer_widget_section"><?php _e( 'Display Footer Widget Area ?', 'bizbir' ); ?></label></th>
			<td>
				<select name="enable_footer_widget_section">
					<option value="global" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'bizbir'); ?></option>
					<option value="enable" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'enable' ) : false; ?>><?php esc_html_e('Enable Footer Widget Area', 'bizbir'); ?></option>
					<option value="disable" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'disable' ) : false; ?>><?php esc_html_e('Disable Footer Widget Area', 'bizbir'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default footer widget area from customizer for this specific page.', 'bizbir' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>