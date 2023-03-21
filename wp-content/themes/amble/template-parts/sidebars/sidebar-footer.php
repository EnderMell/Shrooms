<?php

/**
 * The template for displaying the footer sidebar
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!is_active_sidebar('footer'))
	return;
// If we get this far, we have widgets. Let do this.
?>


<aside class="footer-sidebar widget-area">
	<div class="inside-padding">
		<?php dynamic_sidebar('footer'); ?>
	</div>
</aside>