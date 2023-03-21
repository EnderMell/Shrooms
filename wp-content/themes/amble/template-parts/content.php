<?php

/**
 * Template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Check whether the site title is activated in the customizer.
$amble_blog_excerpt = get_theme_mod('amble_blog_excerpt', true);
$amble_center_image_bottom = get_theme_mod('amble_center_image_bottom', false);
$amble_blog_style = apply_filters('amble_blog_layout', get_theme_mod('amble_blog_style', 'center'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ('center' === $amble_blog_style && false === $amble_center_image_bottom) {
		amble_post_thumbnail();
	}
	?>

	<header class="entry-header">
		<?php // Get the post title and meta
		amble_featured_category_badge();
		the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');	?>
		<div class="entry-meta">
			<?php
			amble_posted_on();
			amble_posted_by();
			?>
		</div>
	</header>

	<?php if ('center' === $amble_blog_style && true === $amble_center_image_bottom) {
		amble_post_thumbnail();
	}
	?>

	<div class="entry-content">
		<?php
		if (true === $amble_blog_excerpt) {
			the_excerpt();
			amble_read_more_link();
		} else {
			the_content();
		}
		// Multi-page navigation
		amble_multipage_pagination();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer"></footer>

</article>