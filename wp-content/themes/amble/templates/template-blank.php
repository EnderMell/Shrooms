<?php
/* 
* Template Name: Blank Template
* Template Post Type: page
* @package Amble
* @since 2.0.0
*/

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>

	<div id="page" class="site grid-container boxed">
		<div class="grid-container-inner">
			<div id="content" class="site-content">

				<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'amble'); ?></a>

				<main id="primary" class="content-area">
					<?php // Start the loop.
					if (have_posts()) {
						while (have_posts()) : the_post();

							// Include the page content template.
							the_content();

						// End the loop.
						endwhile;
					}
					?>
				</main><!-- #primary -->


			</div><!-- .site-content -->
		</div><!-- .grid-container-inner -->

		<footer id="colophon" class="site-footer">
			<div class="inside-padding">

				<?php // Footer Menu
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

	</div><!-- #page -->

	<?php wp_footer(); ?>

</body>

</html>