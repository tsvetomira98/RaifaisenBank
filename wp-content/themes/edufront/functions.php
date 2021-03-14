<?php
/**
 * Edufront functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package edufront
 */

if ( ! defined( 'EDUFRONT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'EDUFRONT_VERSION', '1.0.0' );
}

if ( ! function_exists( 'edufront_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function edufront_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on edufront, use a find and replace
		 * to change 'edufront' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'edufront', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1'      => esc_html__( 'Primary', 'edufront' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'edufront' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'edufront_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'edufront_setup' );



if ( ! function_exists( 'edufront_filter_the_date' ) ) {

	/**
	 * Filters the date function for queries.
	 *
	 * @param string $the_date The formatted date string.
	 * @param string $format   PHP date format. Defaults to 'date_format' option
	 *                         if not specified.
	 * @param string $before   HTML output before the date.
	 * @param string $after    HTML output after the date.
	 */
	function edufront_filter_the_date( $the_date, $format, $before, $after ) {

		if ( is_single() ) {
			return $the_date;
		}

		$the_date = $before . get_the_date( $format ) . $after;
		return $the_date;

	}
	add_filter( 'the_date', 'edufront_filter_the_date', 12, 4 );
}



if ( ! function_exists( 'edufront_menu_fallback' ) ) {

	/**
	 * If no navigation menu is assigned, this function will be used for the fallback.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_nav_menu/ for available $args arguments.
	 * @param  mixed $args Menu arguments.
	 * @return string $output Return or echo the add menu link.
	 */
	function edufront_menu_fallback( $args ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$link  = $args['link_before'];
		$link .= '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="' . esc_attr__( 'Opens in new tab', 'edufront' ) . '" target="__blank">' . $args['before'] . esc_html__( 'Add a menu', 'edufront' ) . $args['after'] . '</a>';
		$link .= $args['link_after'];

		if ( false !== stripos( $args['items_wrap'], '<ul' ) || false !== stripos( $args['items_wrap'], '<ol' ) ) {
			$link = "<li class='menu-item'>{$link}</li>";
		}

		$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );

		if ( ! empty( $args['container'] ) ) {
			$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
		}

		if ( $args['echo'] ) {
			echo wp_kses_post( $output );
		}

		return $output;

	}
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edufront_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'edufront_content_width', 640 );
}
add_action( 'after_setup_theme', 'edufront_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function edufront_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'edufront' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'edufront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets One', 'edufront' ),
			'id'            => 'footer-widgets-1',
			'description'   => esc_html__( 'Add widgets here.', 'edufront' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Two', 'edufront' ),
			'id'            => 'footer-widgets-2',
			'description'   => esc_html__( 'Add widgets here.', 'edufront' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Three', 'edufront' ),
			'id'            => 'footer-widgets-3',
			'description'   => esc_html__( 'Add widgets here.', 'edufront' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Four', 'edufront' ),
			'id'            => 'footer-widgets-4',
			'description'   => esc_html__( 'Add widgets here.', 'edufront' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'edufront_widgets_init' );



/**
 * Convert hexdec color string to rgb(a) string.
 *
 * @link https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
 *
 * @param string $color Color in hex value | eg: #ffffff or #fff.
 * @param string $opacity Color opacity for RGBA value. If false provided, it will return RGB value.
 */
function edufront_colors_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	// Return default if no color provided.
	if ( empty( $color ) ) {
		return $default;
	}

	// Sanitize $color if "#" is provided.
	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	// Check if color has 6 or 3 characters and get values.
	if ( strlen( $color ) === 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) === 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	// Convert hexadec to rgb.
	$rgb = array_map( 'hexdec', $hex );

	// Check if opacity is set(rgba or rgb).
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = implode( ',', $rgb );
	}
	$output = '';
	$output = implode( ',', $rgb );

	// Return rgb(a) color string.
	return $output;
}


function edufront_css_variables() {

	$primary_color   = sanitize_hex_color( edufront_get_theme_mod( 'primary_color' ) );
	$secondary_color = sanitize_hex_color( edufront_get_theme_mod( 'secondary_color' ) );
	?>
	<style id="edufront-css-variables">
		:root {
			--edufront-primary-color: <?php echo esc_attr( $primary_color ); ?>;
			--edufront-primary-rbga: <?php echo esc_attr( edufront_colors_hex2rgba( $primary_color, 0.7 ) ); ?>;
			--edufront-secondary-rbga: <?php echo esc_attr( edufront_colors_hex2rgba( $secondary_color, 0.7 ) ); ?>;
			--edufront-secondary-color: <?php echo esc_attr( $secondary_color ); ?>;
		}
	</style>
	<?php
}

/**
 * Enqueue scripts and styles.
 */
function edufront_scripts() {
	edufront_css_variables();
	wp_enqueue_style( 'edufront-font', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), EDUFRONT_VERSION );
	wp_enqueue_style( 'edufront-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), EDUFRONT_VERSION );
	wp_enqueue_style( 'edufront-slick', get_template_directory_uri() . '/assets/slick/slick.css', array(), EDUFRONT_VERSION );
	wp_enqueue_style( 'edufront-slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), EDUFRONT_VERSION );
	wp_enqueue_style( 'edufront-magnific-popup', get_template_directory_uri() . '/third-party/magnific-popup/css/magnific-popup.min.css', array(), EDUFRONT_VERSION );
	wp_enqueue_style( 'edufront-style', get_stylesheet_uri(), array(), EDUFRONT_VERSION );
	wp_style_add_data( 'edufront-style', 'rtl', 'replace' );

	wp_enqueue_script( 'edufront-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), EDUFRONT_VERSION, true );
	wp_enqueue_script( 'edufront-magnific-popup', get_template_directory_uri() . '/third-party/magnific-popup/js/jquery.magnific-popup.min.js', array( 'jquery' ), EDUFRONT_VERSION, true );
	wp_enqueue_script( 'edufront-slick', get_template_directory_uri() . '/assets/slick/slick.js', array( 'jquery' ), EDUFRONT_VERSION, true );
	wp_enqueue_script( 'edufront-trap-focus-js', get_template_directory_uri() . '/assets/js/trap-focus.js', array( 'jquery' ), EDUFRONT_VERSION, true );
	wp_register_script( 'edufront-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), EDUFRONT_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'edufront-custom-js' );
}
add_action( 'wp_enqueue_scripts', 'edufront_scripts' );

/**
 * Filter the excerpt length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function edufront_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	return 20;
}
add_filter( 'excerpt_length', 'edufront_excerpt_length' );




function edufront_customizer_get_taxonomies() {
	if ( ! defined( 'LEARNDASH_VERSION' ) ) {
		return;
	}
	return array(
		'ld_course_category' => __( 'LearnDash Courses', 'edufront' ),
		'category'           => __( 'WP Category', 'edufront' ),
	);
}



if ( ! function_exists( 'edufront_customizer_get_terms' ) ) {

	/**
	 * This function returns the formated array of terms
	 * for the given taxonomy name, for the customizer dropdown.
	 *
	 * @param string $tax_name Taxonomy name. Default is "category".
	 * @param bool   $hide_empty Takes boolean value, pass true if you want to hide empty terms.
	 * @return array $items Formated array for the dropdown options for the customizer.
	 */
	function edufront_customizer_get_terms( $tax_name = 'category', $hide_empty = true ) {

		if ( empty( $tax_name ) ) {
			return;
		}

		$items = array();
		$terms = get_terms(
			array(
				'taxonomy'   => $tax_name,
				'hide_empty' => $hide_empty,
			)
		);

		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				$term_name = ! empty( $term->name ) ? $term->name : false;
				$term_id   = ! empty( $term->term_id ) ? $term->term_id : '';
				if ( $term_name ) {
					$items[ $term_id ] = $term_name;
				}
			}
		}

		return $items;
	}
}



if ( ! function_exists( 'edufront_get_newsletter_form' ) ) {

	/**
	 * Prints the newsletter form.
	 *
	 * @uses mc4wp_show_form() - MailChimp for WordPress plugin
	 * @link https://www.mc4wp.com/
	 *
	 * @param int  $form_id Form id of mc4wp.
	 * @param bool $echo Return or print the form html.
	 */
	function edufront_get_newsletter_form( $form_id = 0, $echo = true ) {

		if ( ! function_exists( 'mc4wp_show_form' ) ) {
			return;
		}

		ob_start();
		try {
			mc4wp_show_form( $form_id, array(), true );
		} catch ( Exception $e ) {
			echo '';
		}
		$form = ob_get_clean();

		if ( ' ' === $form ) {
			return;
		}

		if ( ! $echo ) {
			return $form;
		}

		echo $form; // phpcs:ignore

	}
}



function edufront_social_links() {
	return apply_filters(
		'edufront_social_links',
		array(
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
		)
	);
}


function edufront_social_link_lists( $echo = true ) {
	$social_links = edufront_social_links();

	ob_start();
	if ( is_array( $social_links ) && ! empty( $social_links ) ) {
		foreach ( $social_links as $social_link ) {
			$icon_class = "fab fa-{$social_link}";

			if ( 'linkedin' === $social_link ) {
				$icon_class = $icon_class . '-in';
			}

			if ( 'facebook' === $social_link ) {
				$icon_class = $icon_class . '-square';
			}

			$key  = "social_link_{$social_link}";
			$link = edufront_get_theme_mod( $key );

			if ( ! $link ) {
				continue;
			}
			?>
			<li class="menu-item" title="<?php echo esc_html( ucwords( $social_link ) ); ?>">
				<a href="<?php echo esc_url( $link ); ?>">
					<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
				</a>
			</li>
			<?php
		}
	}
	$html = ob_get_clean();

	if ( ! $html ) {
		return;
	}

	if ( ! $echo ) {
		return $html;
	}

	echo wp_kses_post( $html );
}



if ( ! function_exists( 'edufront_excerpt_more' ) ) {

	/**
	 * Returns the more notation as "..." rather than "[...]" for excerpts.
	 *
	 * @param string $more Excerpt more string.
	 */
	function edufront_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'edufront_excerpt_more' );
}



if ( ! function_exists( 'edufront_get_supported_sharer' ) ) {

	/**
	 * Returns the supported social sharer array.
	 */
	function edufront_get_supported_sharer() {
		return array(
			'facebook',
			'twitter',
			'whatsapp',
			'linkedin',
		);
	}
}




if ( ! function_exists( 'edufront_list_sharer_button' ) ) {

	/**
	 * Retrives the social sharer buttons list tags.
	 */
	function edufront_list_sharer_button( $args ) {

		if ( ! $args ) {
			return;
		}

		$url   = get_the_permalink();
		$title = get_the_title();

		$sharer_links = array(
			'facebook' => "//www.facebook.com/sharer/sharer.php?u={$url}&t={$title}",
			'twitter'  => "//twitter.com/share?url={$url}&text={$title}",
			'whatsapp' => "//api.whatsapp.com/send?text={$url}",
			'linkedin' => "//www.linkedin.com/sharing/share-offsite/?url={$url}",
		);

		ob_start();
		if ( is_array( $sharer_links ) && ! empty( $sharer_links ) ) {
			foreach ( $sharer_links as $social => $links ) {
				if ( ! in_array( $social, $args, true ) ) {
					continue;
				}
				$fa_class   = "fab fa-{$social}";
				$title_attr = __( 'Share on', 'edufront' ) . ' ' . ucfirst( $social );
				?>
				<li class="menu-item" title="<?php echo esc_attr( $title_attr ); ?>">
					<a href="<?php echo esc_url( $links ); ?>" target="_blank" rel="noopener noreferrer">
						<i class="<?php echo esc_attr( $fa_class ); ?>"></i>
					</a>
				</li>
				<?php
			}
		}
		$content = ob_get_clean();

		echo $content; // phpcs:ignore

	}
}





/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/elementor/class-edufront-load-elementor-widgets.php';

/**
 * TGMA plugins.
 */
require get_template_directory() . '/inc/tgm-plugin/tgmpa-hook.php';

/**
 * Metabox.
 */
require get_template_directory() . '/inc/register-metabox.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

