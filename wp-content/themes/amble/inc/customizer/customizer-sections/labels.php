<?php

/**
 * Customizer Label Options
 * Register the label options section, settings and controls for Theme Customizer
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Label Options
if (!function_exists('amble_customize_register_label_options')) :
	function amble_customize_register_label_options($wp_customize)
	{

		// Add Sections for label options.
		$wp_customize->add_section('amble_label_options', array(
			'title'    => esc_html__('Label Options', 'amble'),
			'priority' => 27,
		));

		/** Prefix Archive Page */
		$wp_customize->add_setting(
			'amble_hide_prefix_archive',
			array(
				'default'           => false,
				'transport' => 'postMessage',
				'sanitize_callback' => 'amble_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			new Amble_Toggle_Control(
				$wp_customize,
				'amble_hide_prefix_archive',
				array(
					'section'     => 'amble_label_options',
					'priority' => 1,
					'label'	      => esc_html__('Hide Prefix in Archive Pages', 'amble'),
					'description' => esc_html__('Enable to hide the archive prefix labels from archive titles.', 'amble'),
				)
			)
		);

		// Back to Top text
		$wp_customize->add_setting(
			'amble_back_to_top_text',
			array(
				'default'           => esc_html__('Back to Top', 'amble'),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage'
			)
		);

		$wp_customize->add_control(
			'amble_back_to_top_text',
			array(
				'type'    => 'text',
				'section' => 'amble_label_options',
				'label'   => esc_html__('Back To Top Text', 'amble'),
			)
		);

		// Footer Copyright
		$wp_customize->add_setting('amble_copyright', array(
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('amble_copyright', array(
			'type'    => 'text',
			'label'   => esc_html__('Copyright Name', 'amble'),
			'description' => esc_html__('Enter your name, website name, or company name [ no html ].', 'amble'),
			'priority' => 8,
			'section' => 'amble_label_options',
		));
	}
endif;

add_action('customize_register', 'amble_customize_register_label_options', 12);
