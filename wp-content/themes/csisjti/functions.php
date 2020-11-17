<?php
/**
 * CSIS Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function csisjti_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'fff',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 680;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Don't compress uploaded images
	add_filter('jpeg_quality', function($arg){ return 100; });

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'csisjti-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/**
 * Register navigation menus uses wp_nav_menu in two places.
 */
function csisjti_menus() {

	$locations = array(
		'primary'  => __( 'Primary', 'csisjti' ),
		'footer_browse' =>__( 'Footer: Browse', 'csisjti' ),
		'footer_initiative' =>__( 'Footer: Initiative', 'csisjti' )
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'csisjti_menus' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CSIS Mag, use a find and replace
	 * to change 'csisjti' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'csisjti' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	/* Disable custom font sizes, colors, gradients in Blocks */
	add_theme_support( 'editor-font-sizes', array() );
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-gradients' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new CSISJTI_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'csisjti_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/inc/svg-icons.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-csisjti-script-loader.php';

// Custom Blocks.
require get_template_directory() . '/inc/custom-blocks.php';

// Shortcodes.
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Register and Enqueue Styles.
 */
function csisjti_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'csisjti-fonts', 'https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&family=Barlow:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap', array(), $theme_version );

	wp_enqueue_style( 'csisjti-style', get_stylesheet_directory_uri() . '/style.min.css', array(), $theme_version );

	if ( is_front_page() ) {
		wp_enqueue_style( 'csisjti-style-home', get_stylesheet_directory_uri() . '/assets/css/pages/home.min.css', array(), $theme_version );
	}

	if ( is_home() || is_archive() ) {
		wp_enqueue_style( 'csisjti-style-archive', get_stylesheet_directory_uri() . '/assets/css/pages/archive.min.css', array(), $theme_version );
	}

	if ( is_post_type_archive( 'resource-library' ) ) {
		wp_enqueue_style( 'csisjti-style-resource-library', get_stylesheet_directory_uri() . '/assets/css/pages/resource-library.min.css', array(), $theme_version );
	}

	if ( is_singular() ) {
		wp_enqueue_style( 'csisjti-style-single', get_stylesheet_directory_uri() . '/assets/css/pages/single.min.css', array(), $theme_version );
	}

	if ( 'post' === get_post_type() ) {
		wp_enqueue_style( 'csisjti-style-post', get_stylesheet_directory_uri() . '/assets/css/pages/post.min.css', array(), $theme_version );
	}

	// Add print CSS.
	wp_enqueue_style( 'csisjti-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'csisjti_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function csisjti_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() ) {
		wp_enqueue_script( 'csisjti-iframeResizer', 'https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.2.10/iframeResizer.min.js', array(), $theme_version, true );

		wp_add_inline_script( 'csisjti-iframeResizer', 'const iframes = iFrameResize({ log: false }, ".js-resize")' );

		// wp_script_add_data( 'csisjti-iframeResizer', 'async', true );
	}

	wp_enqueue_script( 'csisjti-js-vendor', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), $theme_version, true );
	wp_script_add_data( 'csisjti-js-vendor', 'async', true );

	wp_enqueue_script( 'csisjti-js-skip-link', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), $theme_version, true );
	wp_script_add_data( 'csisjti-js-skip-link', 'async', true );

	wp_enqueue_script( 'csisjti-js-bundle', get_template_directory_uri() . '/assets/js/bundle.min.js', array(), $theme_version, true );
	wp_script_add_data( 'csisjti-js-bundle', 'defer', true );

	if ( is_post_type_archive( 'resource-library' ) ) {
		wp_enqueue_script( 'csisjti-js-resource-library', get_template_directory_uri() . '/assets/js/resource-library.min.js', array(), $theme_version, true );
		wp_script_add_data( 'csisjti-js-resource-library', 'defer', true );

		wp_enqueue_script( 'popper', 'https://unpkg.com/@popperjs/core@2', array(), '2.0.0', true );
		wp_enqueue_script( 'tippy', 'https://unpkg.com/tippy.js@6', array(), '6.0.0', true );

		$tippyInit = "
			tippy('[data-tippy-content]', {
				appendTo: 'parent',
				hideOnClick: true,
			})
		";

		wp_add_inline_script( 'tippy', $tippyInit, 'after' );


	}

}

add_action( 'wp_enqueue_scripts', 'csisjti_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function csisjti_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'csisjti_skip_link_focus_fix' );


if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function csisjti_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'csisjti' ) . '</a>';
}

add_action( 'wp_body_open', 'csisjti_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function csisjti_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$footer_shared_args = array(
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
	);

	// Footer #1: Description.
	register_sidebar(
		array_merge(
			$footer_shared_args,
			array(
				'name'        => __( 'Footer #1', 'csisjti' ),
				'id'          => 'footer-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'csisjti' ),
			)
		)
	);

	// Footer #2: Menu
	register_sidebar(
		array_merge(
			$footer_shared_args,
			array(
				'name'        => __( 'Footer #2', 'csisjti' ),
				'id'          => 'footer-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'csisjti' ),
			)
		)
	);

	// Social Share
	register_sidebar(
		array_merge(
			$footer_shared_args,
			array(
				'name'        => __( 'Social Share', 'csisjti' ),
				'id'          => 'social-share',
				'description' => __( 'Social Share Widget', 'csisjti' ),
				'before_widget' => '',
				'after_widget' => ''
			)
		)
	);

	// About JTI on Homepage.
	register_sidebar(
		array(
			'name'        => __( 'About JTI', 'csisjti' ),
			'id'          => 'about-jti',
			'description' => __( 'Widgets in this area will be displayed in the "about JTI" section on the homepage.', 'csisjti' ),
		)
	);

	// Explore Resources form on homepage.
	register_sidebar(
		array(
			'name'        => __( 'Explore Resource Library', 'csisjti' ),
			'id'          => 'explore-resource-library',
			'description' => __( 'This widget will be displayed on the homepage & contain the abbreviated search for the resource library.', 'csisjti' ),
			'before_widget' => '',
			'after_widget' => ''
		)
	);

}

add_action( 'widgets_init', 'csisjti_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
// function csisjti_block_editor_styles() {

// 	$css_dependencies = array();

// 	// Enqueue the editor styles.
// 	wp_enqueue_style( 'csisjti-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
// 	wp_style_add_data( 'csisjti-block-editor-styles', 'rtl', 'replace' );

// 	// Add inline style from the Customizer.
// 	wp_add_inline_style( 'csisjti-block-editor-styles', csisjti_get_customizer_css( 'block-editor' ) );

// 	// Enqueue the editor script.
// 	wp_enqueue_script( 'csisjti-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
// }

// add_action( 'enqueue_block_editor_assets', 'csisjti_block_editor_styles', 1, 1 );
