<?php

/**
 * The template for the bottom sidebar group
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// If no active sidebars - then load nothing
if (
	!is_active_sidebar('bottom1')
	&& !is_active_sidebar('bottom2')
	&& !is_active_sidebar('bottom3')
	&& !is_active_sidebar('bottom4')
)
	return;
?>

<aside class="bottom-sidebar">
	<div class="grid-container-inner">
		<div class="inside-padding">

			<?php if (is_active_sidebar('bottom1')) : ?>
				<div id="bottom1">
					<?php dynamic_sidebar('bottom1'); ?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('bottom2')) : ?>
				<div id="bottom2">
					<?php dynamic_sidebar('bottom2'); ?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('bottom3')) : ?>
				<div id="bottom3">
					<?php dynamic_sidebar('bottom3'); ?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('bottom4')) : ?>
				<div id="bottom4">
					<?php dynamic_sidebar('bottom4'); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</aside>