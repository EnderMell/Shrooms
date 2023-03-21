<?php

/**
 * Upgrade Theme Info and offer
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Load the premium upgrade info when using the free version
function amble_customizer_amble_upgrade($wp_customize)
{

	$wp_customize->add_section('amble_upgrade', array(
		'title'       => esc_html__('Amble Pro Version Features', 'amble'),
		'priority'    => 5,
	));

	/** Important Links */
	$wp_customize->add_setting(
		'amble_upgrade_theme',
		array(
			'default' => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$amble_upgrade = '<div class="upgrade-pro">';
	$amble_upgrade .= '<p class="rp-discount">';
	$amble_upgrade .= esc_html__('Save $10 (Limited Time Offer!) if you decide to upgrade to the Pro (Plugin) version with this discount code on checkout: ', 'amble');
	$amble_upgrade .= '<span class="rp-discount-code">';
	$amble_upgrade .= 'AMBLE10';
	$amble_upgrade .= '</span></p>';
	$amble_upgrade .= '<p class="rp-pro-title">';
	$amble_upgrade .= esc_html__('Pro Features: ', 'amble');
	$amble_upgrade .= '</p><ul class="rp-pro-list">';
	$amble_upgrade .= '<li>' . esc_html('&bull; 3 Header Styles', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; 6 Blog Styles', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; 4 Post Styles', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; 3 Footer Styles', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Custom Blog Intro', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Customizable Text Labels', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Custom Excerpt Sizing', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Auto Create Featured Image Thumbnails', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Make All Images Black &amp; White', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Customized Mailchimp Signup', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Customized Contact 7 Form', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Related Posts w/Thumbnails', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Author Widget w/Thumbnail', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Comments Widget w/Thumbnails', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Show/Hide Blog &amp; Post Elements', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('&bull; Disable Gutenberg Theme Styles', 'amble') . '</li>';
	$amble_upgrade .= '<li>' . esc_html('...and much more!', 'amble') . '</li></ul>';
	$amble_upgrade .= esc_html__('Even though the FREE version of Amble offers a lot, you may want to opt-in for more features.', 'amble');
	$amble_upgrade .= '<p>';

	$amble_upgrade .= sprintf(__('%1$sView Details%2$s', 'amble'),  '<a class="rp-get-pro button" href="' . esc_url('https://www.roughpixels.com/themes/amble/') . '" target="_blank">', '</a>');
	$amble_upgrade .= '</p></div>';


	$wp_customize->add_control(
		new Amble_Note_Control(
			$wp_customize,
			'amble_upgrade_theme',
			array(
				'section'     => 'amble_upgrade',
				'label'	      => esc_html__('Pro Version', 'amble'),
				'description' => $amble_upgrade
			)
		)
	);
}

add_action('customize_register', 'amble_customizer_amble_upgrade', 10);
