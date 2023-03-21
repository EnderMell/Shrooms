<?php

/**
 * Amble functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// This theme requires WordPress 4.7 or later.
if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

// Define Constants
if (!defined('AMBLE_VERSION')) {
	// Replace the version number of the theme on each release.
	define('AMBLE_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function amble_setup()
{
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Amble, use a find and replace to change 'amble' to the name of your theme in all the template files.
	*/
	load_theme_textdomain('amble', get_template_directory() . '/languages');

	// Additional support
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support('responsive-embeds');
	add_theme_support('custom-line-height');
	add_theme_support('experimental-link-color');
	add_theme_support('custom-spacing');
	add_theme_support('custom-units');
	add_theme_support('post-thumbnails');
	add_post_type_support('page', 'excerpt');
	add_theme_support('wp-block-styles');
	add_theme_support('align-wide');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary', 'amble'),
			'footer' => esc_html__('Footer', 'amble'),
			'social' => esc_html__('Social', 'amble'),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
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
			'amble_custom_background_args',
			array(
				'default-color' => '465156',
				'default-image' => '',
			)
		)
	);

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add editor styles to the block editor.
	add_theme_support('editor-styles');
	$editor_styles = apply_filters(
		'amble_editor_styles',
		array(
			'assets/css/editor-style.css',
		)
	);
	add_editor_style($editor_styles);

	// Block Editor color palette.
	$primary = esc_attr(get_theme_mod('amble_custom_primary_colour', '#bba579'));
	$secondary    = esc_attr(get_theme_mod('amble_custom_secondary_colour', '#c6975e'));
	$tertiary    = esc_attr(get_theme_mod('amble_custom_tertiary_colour', '#2b789b'));
	$black      = '#000';
	$white     = '#fff';

	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__('Black', 'amble'),
				'slug'  => 'black',
				'color' => $black,
			),

			array(
				'name'  => esc_html__('White', 'amble'),
				'slug'  => 'white',
				'color' => $white,
			),

			// Custom primary, secondary, and tertiary colours
			array(
				'name'  => esc_html__('Primary', 'amble'),
				'slug'  => 'primary',
				'color' => $primary,
			),
			array(
				'name'  => esc_html__('Secondary', 'amble'),
				'slug'  => 'secondary',
				'color' => $secondary,
			),
			array(
				'name'  => esc_html__('Tertiary', 'amble'),
				'slug'  => 'tertiary',
				'color' => $tertiary,
			),
		)
	);

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__('Extra small', 'amble'),
				'shortName' => esc_html_x('XS', 'Font size', 'amble'),
				'size'      => 14,
				'slug'      => 'extra-small',
			),
			array(
				'name'      => esc_html__('Small', 'amble'),
				'shortName' => esc_html_x('S', 'Font size', 'amble'),
				'size'      => 16,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__('Medium', 'amble'),
				'shortName' => esc_html_x('M', 'Font size', 'amble'),
				'size'      => 18,
				'slug'      => 'medium',
			),
			array(
				'name'      => esc_html__('Large', 'amble'),
				'shortName' => esc_html_x('L', 'Font size', 'amble'),
				'size'      => 20,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__('Extra large', 'amble'),
				'shortName' => esc_html_x('XL', 'Font size', 'amble'),
				'size'      => 22,
				'slug'      => 'extra-large',
			),
			array(
				'name'      => esc_html__('Huge', 'amble'),
				'shortName' => esc_html_x('XXL', 'Font size', 'amble'),
				'size'      => 26,
				'slug'      => 'huge',
			),
			array(
				'name'      => esc_html__('Gigantic', 'amble'),
				'shortName' => esc_html_x('XXXL', 'Font size', 'amble'),
				'size'      => 32,
				'slug'      => 'gigantic',
			),
		)
	);
}
add_action('after_setup_theme', 'amble_setup');


/* SET CONTENT WIDTH
@since 2.0.0
   ==================================================== */
$GLOBALS['content_width'] = 1140;

if (!function_exists('amble_content_width')) :
	function amble_content_width()
	{
		$content_width = $GLOBALS['content_width'];
		// Check if the page has a sidebar.
		if (is_active_sidebar('left-sidebar') || is_active_sidebar('right-sidebar') || is_active_sidebar('blog-sidebar')) {
			$content_width = 775;
		}
		$GLOBALS['content_width'] = apply_filters('amble_content_width', $content_width);
	}
endif;
add_action('template_redirect', 'amble_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function amble_scripts()
{
	wp_enqueue_style('amble-style', get_stylesheet_uri(), array(), AMBLE_VERSION);

	// Add customizer css.
	wp_add_inline_style('amble-style', amble_internal_styles());

	// Load our theme scripts
	wp_enqueue_script('amble-navigation', get_template_directory_uri() . '/assets/js/theme-scripts.js', array(), AMBLE_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'amble_scripts');


/* ADDITIONAL FUNCTIONS & CLASSES
@since Amble 1.0.0
   ==================================================== */
// Function files
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/internal-styles.php';
require get_template_directory() . '/inc/sidebars.php';

// Classes
require get_template_directory() . '/inc/classes/class-amble-comment-walker.php';
require get_template_directory() . '/inc/classes/class-amble-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Customizer
require get_template_directory() . '/inc/customizer/custom-controls/custom-control.php';
require get_template_directory() . '/inc/customizer/customizer.php';

// Load theme structure
require get_template_directory() . '/template-parts/layout/header-layout.php';
require get_template_directory() . '/template-parts/layout/blog-layout.php';
require get_template_directory() . '/template-parts/layout/post-layout.php';
require get_template_directory() . '/template-parts/layout/footer-layout.php';

/* LOAD JETPACK COMPATIBILITY FILE
   ==================================================== */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
