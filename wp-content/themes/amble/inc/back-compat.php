<?php

/**
 * Back compatibility functionality
 * Prevents the theme from running on WordPress versions prior to 4.7.
 * Since this theme is not meant to be backward compatible beyond that and relies on many newer functions and markup changes introduced in 4.7. 
 * It should be noted that block-based elements are for WordPress 5.x and beyond.
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Display upgrade notice on theme switch.
 * @since 2.0.0
 * @return void
 */
function amble_switch_theme()
{
	add_action('admin_notices', 'amble_upgrade_notice');
}
add_action('after_switch_theme', 'amble_switch_theme');

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * the theme on WordPress versions prior to 4.7.
 *
 * @since 2.0.0
 * @global string $wp_version WordPress version.
 * @return void
 */
function amble_upgrade_notice()
{
	echo '<div class="error"><p>';
	printf(
		/* translators: %s: WordPress Version. */
		esc_html__('This theme requires WordPress 4.7 or newer. If you use blocks, you will need at least version 5.0. You are running version %s. Please upgrade.', 'amble'),
		esc_html($GLOBALS['wp_version'])
	);
	echo '</p></div>';
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 * @since 2.0.0
 * @global string $wp_version WordPress version.
 * @return void
 */
function amble_customize()
{
	wp_die(
		sprintf(
			/* translators: %s: WordPress Version. */
			esc_html__('This theme requires WordPress 4.7 or newer. If you use blocks, you will need at least version 5.0. You are running version %s. Please upgrade.', 'amble'),
			esc_html($GLOBALS['wp_version'])
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action('load-customize.php', 'amble_customize');

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since 2.0.0
 * @global string $wp_version WordPress version.
 * @return void
 */
function amble_preview()
{
	if (isset($_GET['preview'])) { // phpcs:ignore WordPress.Security.NonceVerification
		wp_die(
			sprintf(
				/* translators: %s: WordPress Version. */
				esc_html__('This theme requires WordPress 4.7 or newer. If you use blocks, you will need at least version 5.0. You are running version %s. Please upgrade.', 'amble'),
				esc_html($GLOBALS['wp_version'])
			)
		);
	}
}
add_action('template_redirect', 'amble_preview');
