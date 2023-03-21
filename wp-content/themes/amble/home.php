<?php

/**
 * The blog home template file
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();
?>

	<?php // Action hook for any content placed before posts
	do_action('amble_before_posts');

	// Get our blog layout
	amble_blog_layout();

	// Action hook for any content placed after posts
	do_action('amble_after_posts');
	?>

<?php
get_footer();
