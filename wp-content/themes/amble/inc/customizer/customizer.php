<?php

/**
 * Theme Customizer main file
 * @package amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


/* CUSTOMIZER MODIFICATIONS
 Customizer additions and adjustments.
@since 2.0.0
==================================================== */
function amble_customize_register($wp_customize)
{

	// Modify Transport
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('background_color')->transport = 'postMessage';
	$wp_customize->get_setting('background_image')->transport = 'postMessage';

	// Modify Controls
	$wp_customize->get_control('background_color')->section = 'background_image';
	$wp_customize->get_control('blogdescription')->label = esc_html__('Site Description', 'amble');
	$wp_customize->get_control('blogdescription')->description = esc_html__('Short description of what your website is about.', 'amble');
	$wp_customize->get_control('blogdescription')->priority = 10;
	$wp_customize->get_control('blogname')->priority = 0;

	// Modify Sections
	$wp_customize->get_section('colors')->panel = 'colors';
	$wp_customize->get_section('colors')->priority = 15;
	$wp_customize->get_section('colors')->title = esc_html__('Content Area', 'amble');
}
add_action('customize_register', 'amble_customize_register');


/* CUSTOMIZER INCLUDES
 Customizer additions
@since 2.0.0
==================================================== */

// Get the theme customizer sections
$amble_panels = array('site', 'layout', 'blog', 'post', 'color', 'other', 'labels', 'upgrade');
foreach ($amble_panels as $panel) {
	require get_template_directory() . '/inc/customizer/customizer-sections/' . esc_attr($panel) . '.php';
}

// Add customizer stylesheet to the admin
function amble_customizer_styles()
{
	wp_enqueue_style('admin-style', get_stylesheet_directory_uri() . '/assets/css/customizer.css');
}
add_action('admin_enqueue_scripts', 'amble_customizer_styles');


// Theme Customizer preview reload changes asynchronously.
function amble_customizer_preview_js()
{
	wp_enqueue_script('amble-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array('customize-preview'), null, true);
}
add_action('customize_preview_init', 'amble_customizer_preview_js');


/* CUSTOMIZER PRESET CHOICES
Set our colour preset options in the dropdown field
@since 2.0.0
==================================================== */
if (!function_exists('amble_colour_preset_options')) :
	function amble_colour_preset_options()
	{
		return apply_filters('amble_colour_preset_options', array(
			'preset1' => get_template_directory_uri() . '/assets/images/preset1.png',
			'preset2' => get_template_directory_uri() . '/assets/images/preset2.png',
			'preset3'  => get_template_directory_uri() . '/assets/images/preset3.png',
			'preset4'  => get_template_directory_uri() . '/assets/images/preset4.png',
			'preset5'  => get_template_directory_uri() . '/assets/images/preset5.png',
			'preset6'  => get_template_directory_uri() . '/assets/images/preset6.png',
			'preset7'  => get_template_directory_uri() . '/assets/images/preset7.png',
			'preset8'  => get_template_directory_uri() . '/assets/images/preset8.png',
			'preset9'  => get_template_directory_uri() . '/assets/images/preset9.png',
			'preset10'  => get_template_directory_uri() . '/assets/images/preset10.png',
			'preset11'  => get_template_directory_uri() . '/assets/images/preset11.png',
			'preset12'  => get_template_directory_uri() . '/assets/images/preset12.png',
		));
	}
endif;

/* CUSTOMIZER HEADER CHOICES
Set our header layout options in the dropdown field
@since 2.0.0
==================================================== */
if (!function_exists('amble_header_style_choices')) :
	function amble_header_style_choices()
	{
		return apply_filters('amble_header_style_choices', array(
			'header1'  => esc_html__('Header 1', 'amble'),
		));
	}
endif;


/* CUSTOMIZER BLOG CHOICES
Set our blog layout options in the dropdown field
@since 2.0.0
==================================================== */
if (!function_exists('amble_blog_style_choices')) :
	function amble_blog_style_choices()
	{
		return apply_filters('amble_blog_style_choices', array(
			'classic-right' => esc_html__('Classic Right Sidebar', 'amble'),
			'classic-left' => esc_html__('Classic Left Sidebar', 'amble'),
			'center' => esc_html__('Centered No Sidebars', 'amble'),
		));
	}
endif;

/* CUSTOMIZER POST CHOICES
Set our post layout options in the dropdown field
@since 2.0.0
==================================================== */
if (!function_exists('amble_post_style_choices')) :
	function amble_post_style_choices()
	{
		return apply_filters('amble_post_style_choices', array(
			'classic-right' => esc_html__('Classic Right Sidebar', 'amble'),
			'classic-left' => esc_html__('Classic Left Sidebar', 'amble'),
			'center' => esc_html__('Centered No Sidebars', 'amble'),
		));
	}
endif;


/* CUSTOMIZER FOOTER CHOICES
Set our footer layout options in the dropdown field
@since 2.0.0
==================================================== */
if (!function_exists('amble_footer_style_choices')) :
	function amble_footer_style_choices()
	{
		return apply_filters('amble_footer_style_choices', array(
			'footer1' => esc_html__('Footer 1', 'amble'),
		));
	}
endif;

/* CUSTOMIZER SANITIZATION
 Sanitization of customizer functions
@since 2.0.0
==================================================== */

// Text area
if (!function_exists('amble_textarea_sanitize')) :
	function amble_textarea_sanitize($value)
	{
		if ($value) {
			$value = wp_unslash(
				wp_kses($value, array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array()
					),
					'b'      => array(),
					'strong' => array(),
					'em'     => array(),
					'i'      => array(),
					'img' => array(
						'src' => array(),
						'alt' => array(),
						'title' => array()
					),
					'span' => array(),
					'br' => array(),
					'p'  => array()
				))
			);
		}

		return $value; // phpcs:ignore WordPress.Security.EscapeOutput
	}
endif;

// Sanitization callback for checkbox  
if (!function_exists('amble_sanitize_checkbox')) :
	function amble_sanitize_checkbox($checked)
	{
		return ((isset($checked) && true == $checked) ? true : false);
	}
endif;


// Sanitization callback for radio  
if (!function_exists('amble_sanitize_radio')) :
	function amble_sanitize_radio($input, $setting)
	{
		$input = sanitize_key($input);
		$choices = $setting->manager->get_control($setting->id)->choices;
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
endif;

// Sanitization callback for select  
if (!function_exists('amble_sanitize_select')) :
	function amble_sanitize_select($value)
	{
		if (is_array($value)) {
			foreach ($value as $key => $subvalue) {
				$value[$key] = esc_attr($subvalue);
			}
			return $value;
		}
		return esc_attr($value);
	}
endif;

// Sanitization callback for decimal numbers  
if (!function_exists('amble_sanitize_number_decimal')) :
	function amble_sanitize_number_decimal($number, $setting)
	{
		// Ensure $number is an absolute integer (whole number, zero or decimal).
		filter_var($number, FILTER_FLAG_ALLOW_FRACTION);
		// If the input is an absolute integer, return it; otherwise, return the default
		return ($number ? $number : $setting->default);
	}
endif;

// Sanitization callback for absolute numbers  
if (!function_exists('amble_sanitize_number_absint')) :
	function amble_sanitize_number_absint($number, $setting)
	{
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint($number);
		// If the input is an absolute integer, return it; otherwise, return the default
		return ($number ? $number : $setting->default);
	}
endif;

// Sanitization callback for HEX colours  
if (!function_exists('amble_sanitize_hex_colour')) :
	function amble_sanitize_hex_colour($color)
	{
		if ('' === $color)
			return '';
		// 3 or 6 hex digits, or the empty string.
		if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
			return $color;
	}
endif;
