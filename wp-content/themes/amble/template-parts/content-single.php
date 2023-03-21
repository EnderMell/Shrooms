<?php

/**
 * The template for displaying the full post content
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Are the options activated in the customizer.		
$amble_hide_author_bio = get_theme_mod('amble_hide_author_bio', false);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php amble_post_thumbnail(); ?>

	<header class="entry-header">

		<?php // Get the post title and meta
		amble_featured_category_badge();

		// Full post title
		the_title('<h1 class="entry-title">', '</h1>');
		?>
		<div class="entry-meta">
			<?php // Get post meta
			amble_posted_on();
			amble_posted_by();
			?>
		</div>
	</header>

	<div class="entry-content clearfix">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'amble'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		// Multi-page navigation
		amble_multipage_pagination();
		?>
	</div><!-- .entry-content -->

	<?php
	// Action hook for any content placed after entry-content
	do_action('amble_after_post_entry_content');

	// Action hook for any content placed after author bio
	do_action('amble_before_author_bio');

	// Author bio.   
	if (false === $amble_hide_author_bio) {
		amble_author_post_bio_info();
	}

	// Action hook for any content placed after author bio
	do_action('amble_after_author_bio');
	?>

</article>