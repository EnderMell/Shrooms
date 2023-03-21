<?php

/**
 * Post Settings
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('amble_customize_register_post')) :
	function amble_customize_register_post($wp_customize)
	{

		// Heading - Post show hide
		$wp_customize->add_control(new Amble_Note_Control(
			$wp_customize,
			'amble_post_showhide_note',
			array(
				'label' => esc_html__('Show or Hide Settings', 'amble'),
				'section' => 'amble_post_options',
				'priority' => 3,
				'settings' => array(),
			)
		));

		/** Post Options */
		$wp_customize->add_section(
			'amble_post_options',
			array(
				'title'    => esc_html__('Post Options', 'amble'),
				'priority' => 23,
			)
		);

		// Hide Author Bio
		$wp_customize->add_setting('amble_hide_author_bio', array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'amble_sanitize_checkbox'
		));

		$wp_customize->add_control(new Amble_Toggle_Control(
			$wp_customize,
			'amble_hide_author_bio',
			array(
				'section'     => 'amble_post_options',
				'priority' => 8,
				'label'	      => esc_html__('Hide Author Bio', 'amble'),
				'description' => esc_html__('Show or hide the post author biography.', 'amble'),
			)
		));

		// Hide Post Navigation
		$wp_customize->add_setting('amble_hide_post_navigation', array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'amble_sanitize_checkbox'
		));

		$wp_customize->add_control(new Amble_Toggle_Control(
			$wp_customize,
			'amble_hide_post_navigation',
			array(
				'section'     => 'amble_post_options',
				'priority' => 9,
				'label'	      => esc_html__('Hide the Post Navigation', 'amble'),
				'description' => esc_html__('Show or hide the post navigation - Previous and Next Post.', 'amble'),
			)
		));
	}
endif;

add_action('customize_register', 'amble_customize_register_post');
