<?php

/**
 * The main sidebar template file
 * The left and right sidebars are determined by the template being used
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Check if Sidebar has widgets.
if (
	!is_active_sidebar('left-sidebar')
	&& !is_active_sidebar('right-sidebar')
	&& !is_active_sidebar('blog-sidebar')
)
	return;


// Use the sidebar that relates to the page type being viewed
if (is_page_template(array('templates/template-left.php'))) {
	echo '<aside class="widget-area left-sidebar">';
	dynamic_sidebar('left-sidebar');
	echo '</aside>';
} elseif (is_home() || is_archive() || is_single()) {
	echo '<aside class="widget-area blog-sidebar">';
	dynamic_sidebar('blog-sidebar');
	echo '</aside>';
} elseif (basename(get_page_template()) === 'page.php') {
	echo '<aside class="widget-area right-sidebar">';
	dynamic_sidebar('right-sidebar');
	echo '</aside>';
} else { // Skip to the blog sidebar for everything else.
	echo '<aside class="widget-area blog-sidebar">';
	dynamic_sidebar('blog-sidebar');
	echo '</aside>';
}
