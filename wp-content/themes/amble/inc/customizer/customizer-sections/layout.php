<?php

/**
 * Customizer Layout options
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('amble_customize_register_layout')) :
	function amble_customize_register_layout($wp_customize)
	{

		$wp_customize->add_section('amble_layout_settings', array(
			'title'      => esc_html__('Layout Options', 'amble'),
			'priority'   => 21,
			'capability' => 'edit_theme_options',
		));

		/** Boxed Layout */
		$wp_customize->add_setting(
			'amble_page_layout',
			array(
				'default'  => false,
				'sanitize_callback' => 'amble_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new Amble_Toggle_Control(
				$wp_customize,
				'amble_page_layout',
				array(
					'section'     => 'amble_layout_settings',
					'label'	      => esc_html__('Full Width Layout', 'amble'),
					'description' => esc_html__('Enable for a full width page layout instead of a boxed layout.', 'amble'),
				)
			)
		);

		// Header Layout
		$wp_customize->add_setting(
			'amble_header_layout',
			array(
				'default' => 'header1',
				'sanitize_callback' => 'amble_sanitize_select',
			)
		);

		$wp_customize->add_control(
			new Amble_Select_Control(
				$wp_customize,
				'amble_header_layout',
				array(

					'label'   => esc_html__('Header Style', 'amble'),
					'section' => 'amble_layout_settings',
					'choices' => amble_header_style_choices()
				)
			)
		);

		// Blog Layout
		$wp_customize->add_setting(
			'amble_blog_style',
			array(
				'default' => 'center',
				'sanitize_callback' => 'amble_sanitize_select',
			)
		);

		$wp_customize->add_control(
			new Amble_Select_Control(
				$wp_customize,
				'amble_blog_style',
				array(
					'label'   => esc_html__('Blog Style', 'amble'),
					'section' => 'amble_layout_settings',
					'choices' => amble_blog_style_choices()
				)
			)
		);


		// Post Layout
		$wp_customize->add_setting(
			'amble_post_style',
			array(
				'default' => 'classic-right',
				'sanitize_callback' => 'amble_sanitize_select',
			)
		);

		$wp_customize->add_control(
			new Amble_Select_Control(
				$wp_customize,
				'amble_post_style',
				array(
					'label'   => esc_html__('Post Style', 'amble'),
					'section' => 'amble_layout_settings',
					'choices' => amble_post_style_choices()
				)
			)
		);

		// Footer Layout
		$wp_customize->add_setting(
			'amble_footer_style',
			array(
				'default' => 'footer1',
				'sanitize_callback' => 'amble_sanitize_select',
			)
		);

		$wp_customize->add_control(
			new Amble_Select_Control(
				$wp_customize,
				'amble_footer_style',
				array(

					'label'   => esc_html__('Footer Style', 'amble'),
					'section' => 'amble_layout_settings',
					'choices' => amble_footer_style_choices()
				)
			)
		);

		// Add Partial for single Layout
		$wp_customize->selective_refresh->add_partial('amble_customize_partial_single_post', array(
			'selector'         => '.site-content',
			'settings'         => array(
				'amble_single_layout',
			),
			'render_callback'  => 'amble_customize_partial_single_content',
			'fallback_refresh' => false,
		));
	}

endif;
add_action('customize_register', 'amble_customize_register_layout');


// Render the blog content for the selective refresh partial.
function amble_customize_partial_blog_content()
{
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', get_post_format());
	}
}

// Render single posts partial
function amble_customize_partial_single_post()
{
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', 'single');
	}
}
