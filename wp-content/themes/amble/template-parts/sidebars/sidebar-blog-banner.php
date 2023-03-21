<?php

/**
 * The template for displaying the blog banner sidebar
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!is_active_sidebar('blog-banner'))
	return;
// If we get this far, we have widgets. Let do this.
?>

<aside id="blog-banner-sidebar" class="widget-area">
	<?php dynamic_sidebar('blog-banner'); ?>
</aside>