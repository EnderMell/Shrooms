<?php

/**
 * Template part for displaying page content in page.php
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Is the option to hide the edit link activated in the customizer.
$amble_hide_edit = get_theme_mod('amble_hide_edit', false);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<?php the_title('<h1 class="entry-title">', '</h1>');
		if (has_excerpt() && !is_archive() && !is_search() && !is_404()) {
			echo '<div class="page-excerpt">', the_excerpt() . '</div>';
		}
		?>
	</header><!-- .entry-header -->

	<?php //amble_post_thumbnail(); 
	?>

	<div class="entry-content">
		<?php
		the_content();

		// Multi-page navigation
		amble_multipage_pagination();

		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link() && false === $amble_hide_edit) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Edit <span class="screen-reader-text">%s</span>', 'amble'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->