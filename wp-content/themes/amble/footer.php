<?php

/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$amble_back_to_top_text = esc_attr(get_theme_mod('amble_back_to_top_text', esc_html__('Back To Top', 'amble')));
$amble_hide_backtotop = apply_filters('amble_hide_backtotop', get_theme_mod('amble_hide_backtotop', false));
?>

</div><!-- .site-content -->
</div><!-- .grid-container-inner -->

<?php // Action hook for any content placed before the bottom sidebar
do_action('amble_before_bottom_sidebar');

// Get the bottom sidebar group
get_template_part('template-parts/sidebars/sidebar', 'bottom');

// Action hook for any content placed after the bottom sidebar
do_action('amble_after_bottom_sidebar');

// Action hook for the footer layout
do_action('amble_footer');
?>

</div><!-- #page -->

<?php if (false === $amble_hide_backtotop) { ?>
	<div id="back-to-top-wrapper">
		<a title="<?php echo wp_kses_post($amble_back_to_top_text);  ?>" onclick='window.scrollTo({top: 0, behavior: "smooth"});' id="back-to-top"><span><?php echo wp_kses_post($amble_back_to_top_text); ?></span></a>
	</div>
<?php } ?>

<?php wp_footer(); ?>

</body>

</html>