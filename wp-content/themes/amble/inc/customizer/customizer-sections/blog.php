<?php

/**
 * Blog Customizer Settings
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('amble_customize_register_blog')) :
	function amble_customize_register_blog($wp_customize)
	{

		/** Blog Options */
		$wp_customize->add_section(
			'amble_blog_options',
			array(
				'title'    => esc_html__('Blog Options', 'amble'),
				'priority' => 22,
			)
		);

		/** Center blog image position */
		$wp_customize->add_setting(
			'amble_center_image_bottom',
			array(
				'default'  => false,
				'sanitize_callback' => 'amble_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new Amble_Toggle_Control(
				$wp_customize,
				'amble_center_image_bottom',
				array(
					'section'     => 'amble_blog_options',
					'priority' => 2,
					'label'	      => esc_html__('Center Blog Image Position', 'amble'),
					'description' => esc_html__('Enable to move the featured image of the Center blog style below the post header.', 'amble'),
				)
			)
		);
		
		
		// Heading - blog excerpts
		$wp_customize->add_control(new Amble_Note_Control(
			$wp_customize,
			'amble_blog_excerpts_note',
			array(
				'label' => esc_html__('Blog Excerpts', 'amble'),
				'section' => 'amble_blog_options',
				'priority' => 2,
				'settings' => array(),
			)
		));

		/** Blog Excerpt */
		$wp_customize->add_setting(
			'amble_blog_excerpt',
			array(
				'default'  => true,
				'sanitize_callback' => 'amble_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new Amble_Toggle_Control(
				$wp_customize,
				'amble_blog_excerpt',
				array(
					'section'     => 'amble_blog_options',
					'priority' => 2,
					'label'	      => esc_html__('Enable Blog Excerpts', 'amble'),
					'description' => esc_html__('Enable to show excerpts or disable to show full post content.', 'amble'),
				)
			)
		);

		/** Excerpt Length */
		$wp_customize->add_setting(
			'amble_excerpt_length',
			array(
				'default' => 35,
				'sanitize_callback' => 'amble_sanitize_number_absint',
			)
		);

		$wp_customize->add_control(
			new Amble_Slider_Control(
				$wp_customize,
				'amble_excerpt_length',
				array(
					'section' => 'amble_blog_options',
					'priority' => 3,
					'label' => esc_html__('Excerpt Length', 'amble'),
					'description' => esc_html__('Automatically generated excerpt length (in words).', 'amble'),
					'choices' => array(
						'min' => 10,
						'max' => 100,
						'step' => 5,
					)
				)
			)
		);


		// Add Partial for Blog Layout and Excerpt Length.
		$wp_customize->selective_refresh->add_partial('amble_blog_content_partial', array(
			'selector' => '.site-main',
			'settings' => array(
				'amble_blog_layout',
				'amble_blog_excerpt',
				'amble_excerpt_length',
			),
			'render_callback'  => 'amble_customize_partial_blog_content',
			'fallback_refresh' => false,
		));
	}
endif;

add_action('customize_register', 'amble_customize_register_blog');
