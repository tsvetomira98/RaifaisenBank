<?php
/**
 * Change Theme Customizer
 *
 * @package Change
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function change_customize_register( $wp_customize ) {
	
function change_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
	$wp_customize->get_setting( 'blogname' )->photobook_lite         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->photobook_lite  = 'postMessage';
		
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#bc8a4b',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','change'),
			'description'	=> __('Select color from here.','change'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_setting('headerbg-color', array(
		'default' => '#000000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'headerbg-color',array(
			'description'	=> __('Select background color for header.','change'),
			'section' => 'colors',
			'settings' => 'headerbg-color'
		))
	);
	
	$wp_customize->add_setting('footer-color', array(
		'default' => '#000000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'footer-color',array(
			'description'	=> __('Select background color for footer.','change'),
			'section' => 'colors',
			'settings' => 'footer-color'
		))
	);

	// Header Button Start
	$wp_customize->add_section(
        'header_button_section',
        array(
            'title' => __('Header Button', 'change'),
            'priority' => null,
			'description'	=> __('Manage book online header button from here','change'),	
        )
    );
    $wp_customize->add_setting('header_button_text',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('header_button_text',array(
		'type'	=> 'text',
		'label'	=> __('Add button lable here','change'),
		'section'	=> 'header_button_section'
	));
	$wp_customize->add_setting('header_button_url',array(
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('header_button_url',array(
		'type'	=> 'url',
		'label'	=> __('Add button url here','change'),
		'section'	=> 'header_button_section'
	));
	$wp_customize->add_setting('hide_header_button',array(
		'default' => true,
		'sanitize_callback' => 'change_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'hide_header_button', array(
	   'settings' => 'hide_header_button',
	   'section'   => 'header_button_section',
	   'label'     => __('Check this to hide header button.','change'),
	   'type'      => 'checkbox'
     ));
    // Header Button End
	
	// Slider Section Start		
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' => __('Slider Settings', 'change'),
            'priority' => null,
			'description'	=> __('Recommended image size (1420x567). Slider will work only when you select the static front page.','change'),	
        )
    );
	
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','change'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','change'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','change'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('slide_text',array(
		'default'	=> __('Read More','change'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_text',array(
		'label'	=> __('Add slider link button text.','change'),
		'section'	=> 'slider_section',
		'setting'	=> 'slide_text',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('hide_slider',array(
		'default' => true,
		'sanitize_callback' => 'change_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'hide_slider', array(
	   'settings' => 'hide_slider',
	   'section'   => 'slider_section',
	   'label'     => __('Check this to hide slider.','change'),
	   'type'      => 'checkbox'
    ));
	
	// Slider Section End

	// First Section Start		
	$wp_customize->add_section(
        'homepage_service_section',
        array(
            'title' => __('Services Section', 'change'),
            'priority' => null,
			'description'	=> __('Select pages for homepage services. This section will be displayed only when you select the static front page.','change'),	
        )
    );

    $wp_customize->add_setting('ser-section-ttl',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ser-section-ttl',array(
		'type'	=> 'text',
		'label'	=> __('Add Section Title Here','change'),
		'section'	=> 'homepage_service_section'
	));	
	
	$wp_customize->add_setting('ser-setting1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for first Service box','change'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('ser-setting2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for second Service box','change'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('ser-setting3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for third Service box','change'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('hide_ser_section',array(
			'default' => true,
			'sanitize_callback' => 'change_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_ser_section', array(
		   'settings' => 'hide_ser_section',
    	   'section'   => 'homepage_service_section',
    	   'label'     => __('Check this to hide section.','change'),
    	   'type'      => 'checkbox'
     ));
	// First Section End
	
	// Homepage Section Start
	$wp_customize->add_section(
        'homepage_section',
        array(
            'title' => __('Welcome Section', 'change'),
            'priority' => null,
			'description'	=> __('Select pages for Welcome Section. This section will be displayed only when you select the static front page.','change'),	
        )
    );	
	
	$wp_customize->add_setting('page-setting1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for welcome section','change'),
			'section'	=> 'homepage_section'
	));	
	
	
	$wp_customize->add_setting('hide_section',array(
			'default' => true,
			'sanitize_callback' => 'change_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_section', array(
		   'settings' => 'hide_section',
    	   'section'   => 'homepage_section',
    	   'label'     => __('Check this to hide section.','change'),
    	   'type'      => 'checkbox'
     ));
	
}
add_action( 'customize_register', 'change_customize_register' );	

function change_css(){
		?>
        <style>
				a, 
				.tm_client strong,
				.postmeta a:hover,
				#sid
				ebar ul li a:hover,
				.blog-post h3.entry-title,
				a.blog-more:hover,
				#commentform input#submit,
				input.search-submit,
				.nivo-controlNav a.active,
				.blog-date .date,
				a.read-more,
				.section-box .sec-left a,
				.sitenav ul li a:hover,
				.section_head:before{
					color:<?php echo esc_attr(get_theme_mod('color_scheme','#bc8a4b')); ?>;
				}
				.section_head span:before, .section_head span:after{
					border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#bc8a4b')); ?>;
				}
				h3.widget-title,
				.nav-links .current,
				.nav-links a:hover,
				p.form-submit input[type="submit"],
				.home-content a,
				.one_half .wel-read,
				.social a:hover{
					background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#bc8a4b')); ?>;
				}
				#header,
				.sitenav ul li.menu-item-has-children:hover > ul,
				.sitenav ul li.menu-item-has-children:focus > ul,
				.sitenav ul li.menu-item-has-children.focus > ul{
					background-color:<?php echo esc_attr(get_theme_mod('headerbg-color','#000000')); ?>;
				}
				.copyright-wrapper{
					background-color:<?php echo esc_attr(get_theme_mod('footer-color','#000000')); ?>;
				}
				#slider .top-bar a.slide-button, .header-button .head-btn{
					background-color: <?php echo esc_attr(get_theme_mod('color_scheme','#bc8a4b')); ?>;
				}
				#slider .top-bar a.slide-button:hover, .header-button .head-btn:hover{
					background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#bc8a4b')); ?>;
					color: #ffffff;
				}
				
		</style>
	<?php }
add_action('wp_head','change_css');

function change_customize_preview_js() {
	wp_enqueue_script( 'change-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'change_customize_preview_js' );