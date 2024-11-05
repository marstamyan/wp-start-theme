<?php 

/**
 * start_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package start_theme
 */

require_once get_template_directory() . '/inc/enqueue-scripts.php';
require_once get_template_directory() . '/inc/post-thumbnails.php';
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/register-post-type.php';
require_once get_template_directory() . '/inc/metaboxes.php';


require_once get_template_directory() . '/inc/pagination.php';
require_once get_template_directory() . '/classes/start-theme-menu.php';



$my_theme = wp_get_theme(); 

if ( ! defined( 'THEME_VERSION' ) ) {
    $theme_version = wp_get_theme()->get('Version');
	define( 'THEME_VERSION', $theme_version  );
}

if ( ! defined( 'THEME_NAME' ) ) {
	define( 'THEME_NAME', 'start_theme' );
}



function start_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on start_theme, use a find and replace
		* to change 'start_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( THEME_NAME, get_template_directory() . '/languages' );

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
			'header_menu' => esc_html__( 'Header menu', THEME_NAME ),
			'footer_menu' => esc_html__( 'Footer menu', THEME_NAME ),
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
			'start_themecustom_background_args',
			array(
				'default-color' => 'ebebeb',
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
			'unlink-homepage-logo' => false, 
		)
	);
}
add_action( 'after_setup_theme', 'start_theme_setup' );