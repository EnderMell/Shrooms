<?php

/**
 * Theme header layouts
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/* BLOG LAYOUT
   ====================================================*/
if (!function_exists('amble_header_layouts')) :
	function amble_header_layouts()
	{

		$amble_header_layout = apply_filters('amble_header_layout', get_theme_mod('amble_header_layout', 'header1'));
		// Start 
?>

		<header id="masthead" class="site-header <?php echo esc_attr($amble_header_layout); ?>">
			<div class="inside-header">

				<?php // Get our header elements
				amble_header_branding();
				amble_mainnav();
				?>

			</div>
		</header>

<?php // End
	}
endif;

add_action('amble_site_header', 'amble_header_layouts');
