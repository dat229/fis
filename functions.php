<?php

/**
 * fis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fis
 */
$random_ver = rand(1, 1000000000);
if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', $random_ver);
}

if (!function_exists('fis_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fis_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fis, use a find and replace
		 * to change 'fis' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('fis', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
                'menu-1' => esc_html__('Menu Chính', 'FIS'),
                'menu-2-1' => esc_html__('Menu phụ 1', 'FIS'),
                'menu-2-2' => esc_html__('Menu phụ 2', 'FIS'),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'fis_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fis_content_width()
{
	$GLOBALS['content_width'] = apply_filters('fis_content_width', 640);
}
add_action('after_setup_theme', 'fis_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fis_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'fis'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'fis'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'fis_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function fis_scripts()
{
	wp_enqueue_style('fis-style', get_stylesheet_uri(), array(), _S_VERSION);
	if (is_404()) {
		wp_enqueue_style('fis-404', get_template_directory_uri() . '/css/404.min.css', array(), _S_VERSION);
	}
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	if (class_exists('WPCF7')) {
		wp_enqueue_style('fis-alert', get_template_directory_uri() . '/assets/alert/css/cf7simplepopup-core.css', array(), _S_VERSION);
	}
	wp_enqueue_style('fis-bootstrap', get_template_directory_uri() . '/assets/fe-library/bootstrap.min.css', array(), _S_VERSION);
	wp_enqueue_style('fis-flickity', get_template_directory_uri() . '/assets/fe-library/flickity.min.css', array(), _S_VERSION);
	wp_enqueue_style('fis-aos', get_template_directory_uri() . '/assets/fe-library/aos.css', array(), _S_VERSION);
	wp_enqueue_style('fis-fancybox', get_template_directory_uri() . '/assets/fe-library/jquery.fancybox.min.css', array(), _S_VERSION);
	wp_enqueue_style('fis-twenty', get_template_directory_uri() . '/assets/fe-library/twentytwenty.css', array(), _S_VERSION);
	wp_enqueue_style('fis-style_main', get_template_directory_uri() . '/assets/scss/style.css', array(), _S_VERSION);
	wp_enqueue_script('fis-jquery', get_template_directory_uri() . '/assets/fe-library/jquery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_bootstrap', get_template_directory_uri() . '/assets/fe-library/bootstrap.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_aos', get_template_directory_uri() . '/assets/fe-library/aos.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_flickity', get_template_directory_uri() . '/assets/fe-library/flickity.pkgd.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_fancybox', get_template_directory_uri() . '/assets/fe-library/jquery.fancybox.min.js', array(), _S_VERSION, true);

	wp_enqueue_script('fis-jquery_move', get_template_directory_uri() . '/assets/fe-library/move.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_twentytwenty', get_template_directory_uri() . '/assets/fe-library/twentytwenty.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_index', get_template_directory_uri() . '/assets/js/index.js', array(), _S_VERSION, true);
	wp_enqueue_script('fis-jquery_index_ajax', get_template_directory_uri() . '/assets/js/ajax.js', array(), _S_VERSION, true);
	wp_localize_script('fis-jquery_index_ajax', 'ajax', array('ajax_url' => admin_url('admin-ajax.php')));
	if (class_exists('WPCF7')) {
		wp_enqueue_script('fis-jquery_alert', get_template_directory_uri() . '/assets/alert/js/cf7simplepopup-core.js', array(), _S_VERSION, true);
		wp_enqueue_script('fis-jquery_alert_main', get_template_directory_uri() . '/assets/alert/js/sweetalert2.all.min.js', array(), _S_VERSION, true);
	}
}
add_action('wp_enqueue_scripts', 'fis_scripts');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer Wordpress.
 */
require get_template_directory() . '/inc/customizer-wp.php';

/**
 * Customizer Widget.
 */
require get_template_directory() . '/inc/customizer-widget.php';

/**
 * Customizer Menu.
 */
require get_template_directory() . '/inc/customizer-menu.php';

/**
 * Customizer CF7.
 */
if (class_exists('WPCF7')) {
	require get_template_directory() . '/inc/customizer-cf7.php';
}

/**
 * Customizer Shortcode.
 */
require get_template_directory() . '/inc/customizer-shortcode.php';

/**
 * Customizer Ajax.
 */
require get_template_directory() . '/inc/customizer-ajax.php';


/**
 * Disable Custom Theme
 */
// define('DISALLOW_FILE_EDIT', true);
// add_filter('acf/settings/show_admin', '__return_false');