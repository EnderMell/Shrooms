<?php

/**
 * Theme full post layouts
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/* POST LAYOUT
   ====================================================*/
if (!function_exists('amble_post_layout')) :
	function amble_post_layout()
	{

		// Are the options activated in the customizer.		
		$amble_post_style = apply_filters('amble_post_style', get_theme_mod('amble_post_style', 'classic-right'));
		$amble_hide_post_navigation = get_theme_mod('amble_hide_post_navigation', false);

		// Start
		if (have_posts()) :

			switch (esc_attr($amble_post_style)) {

				case "center":
					echo '<main id="primary" class="content-area">';
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						// Get the post content
						get_template_part('template-parts/content', 'single');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;

						// Action hook for any content placed after post comments
						do_action('amble_after_post_comments');

						// Post navigation  
						if (false === $amble_hide_post_navigation) {
							amble_post_pagination();
						}

					endwhile;
					echo '</main>';
					break;

				case "classic-left":
				default:
					echo '<main id="primary" class="content-area">';
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						// Get the post content
						get_template_part('template-parts/content', 'single');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;

						// Action hook for any content placed after post comments
						do_action('amble_after_post_comments');

						// Post navigation  
						if (false === $amble_hide_post_navigation) {
							amble_post_pagination();
						}

					endwhile;

					echo '</main>';
					// Get the sidebar
					get_sidebar();
			}

		else :
			get_template_part('template-parts/content', 'none');
		endif;
		// End			

	}
endif;
