<?php
/* 
* Template Name: Short Width
* Template Post Type: page
* @package Amble
* @since 2.0.0
*/

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="primary" class="content-area">

	<?php
	// Start the loop.
	if (have_posts()) {
		while (have_posts()) : the_post();

			// Include the page content template.
			get_template_part('template-parts/content', 'page');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
	}
	?>

</main>

<?php
get_footer();
