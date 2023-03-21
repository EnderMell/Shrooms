<?php

/**
 * Theme blog layouts
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


/* BLOG LAYOUT
   ====================================================*/
if (!function_exists('amble_blog_layout')) :
	function amble_blog_layout()
	{

		$amble_blog_style = apply_filters('amble_blog_layout', get_theme_mod('amble_blog_style', 'center'));

		// Start
		if (have_posts()) :

			switch (esc_attr($amble_blog_style)) {

				case "classic-left":
				case "classic-right":
					echo '<main id="primary" class="content-area">';
					/* Start the Loop */
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/content');
					endwhile;
					amble_blog_nav();
					echo '</main>';
					get_sidebar();
					break;

				default:
					echo '<main id="primary" class="content-area">';
					/* Start the Loop */
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/content');
					endwhile;
					amble_blog_nav();
					echo '</main>';
			}

		else :
			get_template_part('template-parts/content', 'none');
		endif;
		// End		

	}
endif;
