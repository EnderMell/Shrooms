<?php

/**
 * Theme Customizer - Site Identity tab
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function amble_customize_register_site($wp_customize)
{

	/** Add postMessage support for site title and description */
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('background_color')->transport = 'refresh';
	$wp_customize->get_setting('background_image')->transport = 'refresh';


	// Show site title
	$wp_customize->add_setting('amble_hide_site_title',	array(
		'default' => false,
		'transport'  => 'postMessage',
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control(
		$wp_customize,
		'amble_hide_site_title',
		array(
			'label'    => esc_html__('Hide the Site Title', 'amble'),
			'description' => esc_html__('Show or hide the site title.', 'amble'),
			'section'  => 'title_tagline',
		)
	));

	// Show site description
	$wp_customize->add_setting('amble_hide_tagline', array(
		'default' => false,
		'transport'  => 'postMessage',
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control(
		$wp_customize,
		'amble_hide_tagline',
		array(
			'label'    => esc_html__('Hide the Site Description', 'amble'),
			'description' => esc_html__('Show or hide the site tagline [description].', 'amble'),
			'section'  => 'title_tagline',
		)
	));

	// Site title colour
	$wp_customize->add_setting('amble_site_title_colour', array(
		'default'           => '#000000',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'amble_site_title_colour',
		array(
			'label'       => esc_html__('Site Title Colour', 'amble'),
			'description' => esc_html__('Sets the site title colour in the sidebar area.', 'amble'),
			'section'     => 'title_tagline',
		)
	));

	// Site tagline colour
	$wp_customize->add_setting('amble_tagline_colour', array(
		'default'           => '#6c757d',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'amble_tagline_colour',
		array(
			'label'       => esc_html__('Site Tagline Colour', 'amble'),
			'description' => esc_html__('Sets the site tagline [ description ] colour in the header area.', 'amble'),
			'section'     => 'title_tagline',
		)
	));

	// Site Logo size
	$wp_customize->add_setting('amble_logo_width', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control(
		new Amble_Slider_Control($wp_customize, 'amble_logo_width', array(
			'section'	  => 'title_tagline',
			'label'		  => esc_html__('Site Logo Size', 'amble'),
			'description' => esc_html__('Change the site logo size for your sidebar column.', 'amble'),
			'choices'	  => array(
				'min' 	=> 100,
				'max' 	=> 500,
				'step'	=> 25,
			)
		))
	);


	// Site Title Font Size for the custom header image
	$wp_customize->add_setting('site_title_font_size', array(
		'default'           => 3,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'amble_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Amble_Slider_Control($wp_customize, 'site_title_font_size', array(
			'section'	  => 'title_tagline',
			'label'		  => esc_html__('Site Title Font Size', 'amble'),
			'description' => esc_html__('Change the font size of your site title.', 'amble'),
			'priority'    => 65,
			'choices'	  => array(
				'min' 	=> 1,
				'max' 	=> 5,
				'step'	=> 0.25,
			)
		))
	);
}
add_action('customize_register', 'amble_customize_register_site');
