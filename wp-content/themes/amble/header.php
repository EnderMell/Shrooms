<?php

/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="site-content">
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


// Are the options activated in the customizer.		
$amble_hide_search_modal = get_theme_mod('amble_hide_search_modal', false);
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if (false === $amble_hide_search_modal) {
		get_template_part('template-parts/modal-search');
	}
	?>

	<?php if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>

	<a class="visually-hidden-focusable skip-link" href="#primary"><?php esc_html_e('Skip to Content', 'amble'); ?></a>

	<div id="page" class="site grid-container container boxed">
		<div class="grid-container-inner">

			<?php if (false === $amble_hide_search_modal) { ?>
				<button type="button" class="searchModal-btn" data-bs-toggle="modal" data-bs-target="#searchModal"><span class="visually-hidden"><?php esc_html_e('Search', 'amble'); ?></span><?php amble_theme_svg('search'); ?></button>
			<?php } ?>

			<?php // Amble header hook.
			do_action('amble_site_header');

			// Load the banner sidebar only on pages
			if (is_page()) {
				get_template_part('template-parts/sidebars/sidebar', 'banner');
			}

			// Load the home banner sidebar only for the blog home
			if ( is_home() || is_category()) {
				get_template_part('template-parts/sidebars/sidebar', 'blog-banner');
			}
			
			// Action hook for the blog home featured slider
			if (is_home()) {
				do_action('amble_featured_slider');
			}

			// Action hook for the blog home page heading area
			if (is_home()) {
				do_action('amble_blog_home_heading');
			}

			// Hook for page headers 
			do_action('amble_page_header');
			?>

			<div id="content" class="site-content">