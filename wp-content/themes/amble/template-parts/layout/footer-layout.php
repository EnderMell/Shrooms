<?php

/**
 * Theme footer layouts
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/* FOOTER LAYOUT
   ====================================================*/
if (!function_exists('amble_footer_layout')) :
	function amble_footer_layout()
	{
?>

		<footer id="colophon" class="site-footer">
			<div class="inside-padding">

				<?php get_template_part('template-parts/sidebars/sidebar', 'footer'); ?>

				<?php // Social menu
				if (has_nav_menu('social')) {
					echo ' <nav aria-label="', esc_attr_e('Social Menu', 'amble'), '" id="social-menu-wrapper">';
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'menu_class'     => 'social-nav',
							'container'         => 'ul',
							'echo' => true,
							'link_before' => '<span class="social-label visually-hidden">',
							'link_after' => '</span>',
							'depth' => 1,
						)
					);
					echo '</nav>';
				}

				// Footer Menu
				if (has_nav_menu('footer')) {
					echo '<nav aria-label="', esc_attr_e('Footer menu', 'amble'), '" id="footer-nav-wrapper">';

					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-nav',
							'container'         => 'ul',
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					echo '</nav>';
				}
				?>

				<div class="copyright">
					<?php esc_html_e('Copyright &copy;', 'amble'); ?>
					<?php echo esc_html(date_i18n(__('Y', 'amble'))); ?>
					<span class="copyright-name"><?php echo esc_html(get_theme_mod('amble_copyright')); ?></span>.
					<?php esc_html_e('All rights reserved.', 'amble'); ?>
				</div>

			</div>
		</footer>

<?php
	}
endif;

add_action('amble_footer', 'amble_footer_layout');
?>