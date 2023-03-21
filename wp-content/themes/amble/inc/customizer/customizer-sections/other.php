<?php

/**
 * Customizer Other options
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function amble_customize_register_other($wp_customize)
{

	$wp_customize->add_section('amble_other_settings', array(
		'title'      => esc_html__('Other Options', 'amble'),
		'priority'   => 38,
		'capability' => 'edit_theme_options',
	));

	// Hide  modal search
	$wp_customize->add_setting('amble_hide_search_modal', array(
		'default'           => false,
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control($wp_customize, 'amble_hide_search_modal', array(
		'label'    => esc_html__('Hide the Popup Search', 'amble'),
		'description' => esc_html__('Show or hide the search icon and the popup modal search overlay.', 'amble'),
		'section'  => 'amble_other_settings',
	)));

	// Hide widget title border
	$wp_customize->add_setting('amble_hide_widget_border', array(
		'default'           => false,
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control($wp_customize, 'amble_hide_widget_border', array(
		'label'    => esc_html__('Hide the Widget Title Border', 'amble'),
		'description' => esc_html__('Show or hide the border under widget titles.', 'amble'),
		'section'  => 'amble_other_settings',
	)));



	// Hide back to top link
	$wp_customize->add_setting('amble_hide_backtotop', array(
		'default'           => false,
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control($wp_customize, 'amble_hide_backtotop', array(
		'label'    => esc_html__('Hide the Back to Top Link', 'amble'),
		'description' => esc_html__('Show or hide the footer Back To Top navigation link.', 'amble'),
		'section'  => 'amble_other_settings',
	)));

	// Hide banner captions
	$wp_customize->add_setting('amble_hide_banner_caption', array(
		'default'           => false,
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control($wp_customize, 'amble_hide_banner_caption', array(
		'label'    => esc_html__('Hide Banner Captions', 'amble'),
		'description' => esc_html__('Show or hide the banner sidebar image captions when using the image widget.', 'amble'),
		'section'  => 'amble_other_settings',
	)));

	// Hide edit link
	$wp_customize->add_setting('amble_hide_edit', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'amble_sanitize_checkbox',
	));

	$wp_customize->add_control(new Amble_Toggle_Control($wp_customize, 'amble_hide_edit', array(
		'label'    => esc_html__('Hide Edit Link', 'amble'),
		'description' => esc_html__('Show or hide the edit link from posts and pages. This will not show in the Customizer.', 'amble'),
		'section'  => 'amble_other_settings',
	)));
}
add_action('customize_register', 'amble_customize_register_other');
