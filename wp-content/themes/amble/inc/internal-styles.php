<?php

/**
 * Dynamic Internal Styles
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

/* RESET CUSTOM STYLES CACHE
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_reset_inline_style_cache')) :
  function amble_reset_inline_style_cache()
  {
    delete_transient('amble_inline_style');
  }
endif;
add_action('customize_save_after', 'amble_reset_inline_style_cache');


/* INTERNAL STYLE
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_internal_styles')) :
  function amble_internal_styles()
  {
    if (is_customize_preview())
      return amble_get_inline_style();

    $amble_internal_styles = get_transient('amble_inline_style');

    if ($amble_internal_styles === false) {
      $amble_internal_styles = amble_get_inline_style();
      set_transient('amble_inline_style', esc_attr($amble_internal_styles));
    }

    return wp_kses_post($amble_internal_styles);
  }
endif;


/* PRESET COLOUR STYLES
 @since 2.0.0
   ====================================================   */
if (!function_exists('amble_preset_css')) :
  function amble_preset_css()
  {

    $amble_presets = get_theme_mod('amble_presets');
    if ($amble_presets && $amble_presets !== 'preset1') {
      echo '<style type="text/css" media="all">
		:root {', amble_colour_presets(), '	}
		</style>';
    }
  }
endif;
add_action('wp_head', 'amble_preset_css', 12);


/* CUSTOMIZER INTERNAL STYLES
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_get_inline_style')) :
  function amble_get_inline_style()
  {
    $css = '';

    // Site title colour
    $amble_site_title_colour = get_theme_mod('amble_site_title_colour');

    if ($amble_site_title_colour && $amble_site_title_colour !== '#000000') {
      $css .= '
        .site-title a,
		.site-title a:visited {
          color: ' . esc_attr($amble_site_title_colour) . ';
        }';
    }

    // Site tagline colour
    $amble_tagline_colour = get_theme_mod('amble_tagline_colour');

    if ($amble_tagline_colour && $amble_tagline_colour !== '#6c757d') {
      $css .= '
        .site-description {
          color: ' . esc_attr($amble_tagline_colour) . ';
        }';
    }

    // Logo width
    $amble_logo_width = get_theme_mod('amble_logo_width');

    if ($amble_logo_width && has_custom_logo() && $amble_logo_width !== '250') {
      $css .= '
        .custom-logo {
          max-width:' . floatval(esc_attr($amble_logo_width)) . 'px;
        }';
    }

    // Site title font size
    $site_title_font_size = get_theme_mod('site_title_font_size');

    if ($site_title_font_size && $site_title_font_size !== '3') {
      $css .= '
        .site-title {
          font-size: ' . floatval(esc_attr($site_title_font_size)) . 'rem;
        }';
    }

    // Page Layout
    $amble_page_layout = get_theme_mod('amble_page_layout');

    if ($amble_page_layout && $amble_page_layout !== false) {
      $css .= '
      .grid-container {
		max-width: 100%;
		margin-top: 0;
	}';
    }

    // Widget Title border
    $amble_hide_widget_border = get_theme_mod('amble_hide_widget_border');

    if ($amble_hide_widget_border && $amble_hide_widget_border !== false) {
      $css .= '
      .blog-sidebar .widget-title::after,
	.left-sidebar .widget-title::after,
	.right-sidebar .widget-title::after,
	.bottom-sidebar .widget-title::after {
		content: none;
	}
	.widget-title {
		margin-bottom: 0;
	';
    }

    // Primary colour
    $amble_custom_primary_colour = get_theme_mod('amble_custom_primary_colour');

    if ($amble_custom_primary_colour && $amble_custom_primary_colour !== '#bba579') {
      $css .= '
	  :root {
		  --amble-primary: ' . esc_attr($amble_custom_primary_colour) . ' !important;
        }';
    }

    // Secondary colour
    $amble_custom_secondary_colour = get_theme_mod('amble_custom_secondary_colour');

    if ($amble_custom_secondary_colour && $amble_custom_secondary_colour !== '#c6975e') {
      $css .= '
	  :root {
		  --amble-secondary:' . esc_attr($amble_custom_secondary_colour) . ' !important;
        }';
    }

    // Tertiary colour
    $amble_custom_tertiary_colour = get_theme_mod('amble_custom_tertiary_colour');

    if ($amble_custom_tertiary_colour && $amble_custom_tertiary_colour !== '#2b789b') {
      $css .= '
	  :root {
		  --amble-tertiary:' . esc_attr($amble_custom_tertiary_colour) . ' !important;
        }';
    }

    // Content area colors
    $amble_content_bg_colour = get_theme_mod('amble_content_bg_colour');

    if ($amble_content_bg_colour && $amble_content_bg_colour !== '#ffffff') {
      $css .= '
        :root {
         --amble-content-bg: ' . esc_attr($amble_content_bg_colour) . ';
        }';
    }

    // Body text colour
    $amble_content_area_text_colour = get_theme_mod('amble_content_area_text_colour');

    if ($amble_content_area_text_colour && $amble_content_area_text_colour !== '#646464') {
      $css .= '
        body {
          color: ' . esc_attr($amble_content_area_text_colour) . ';
        }';
    }

    // Secondary text colour
    $amble_secondary_text_colour = get_theme_mod('amble_secondary_text_colour');

    if ($amble_secondary_text_colour && $amble_secondary_text_colour !== '#7c7c7c') {
      $css .= '
        .tags-list a, 
		.tagcloud a, 
		.post-cats a, 
		.post-meta, 
		.post-date, 
		.comment-meta,
		.post-navigation a > .nav-meta, 
		.wp-caption-text, 
		.entry-caption,
		.entry-meta,
		.entry-meta a,
		.entry-meta a:visited,
		.form-text {
          color: ' . esc_attr($amble_secondary_text_colour) . ';
        }';
    }

    // Primary menu link colour
    $amble_nav_link_colour = get_theme_mod('amble_nav_link_colour');

    if ($amble_nav_link_colour && $amble_nav_link_colour !== '#495057') {
      $css .= '
	  :root {
		  --amble-navbar-link:' . esc_attr($amble_nav_link_colour) . ';
        }';
    }

    // Mobile menu  line separators
    $amble_mobile_line_separators = get_theme_mod('amble_mobile_line_separators');

    if ($amble_mobile_line_separators && $amble_mobile_line_separators !== '#ededed') {
      $css .= '
        @media (max-width: 991px) {
			#mainmenu li,
			#mainmenu .sub-menu {
			  border-color: ' . hex2rgba(esc_attr($amble_mobile_line_separators), 0.08, true) . '
			}
						
			#mainmenu a>span::before {
				background-color: ' . hex2rgba(esc_attr($amble_mobile_line_separators), 0.15, true) . '
			}
			
		}';
    }

    // Headings colour
    $amble_headings_colour = get_theme_mod('amble_headings_colour');

    if ($amble_headings_colour && $amble_headings_colour !== '#292929') {
      $css .= '
        h2.entry-title, .entry-title a, .page-title, h1, h2, h3, h4, h5, h6 {
          color: ' . esc_attr($amble_headings_colour) . ';
        }
        h1 a:focus,  h2 a:focus,  h3 a:focus,  h4 a:focus,  h5 a:focus,  h6 a:focus, h1 a:hover,  h2 a:hover,  h3 a:hover,  h4 a:hover,  h5 a:hover, h6 a:hover {
          color: ' . hex2rgba(esc_attr($amble_headings_colour), 0.7, true) . '
        }';
    }


    // Content links
    $amble_content_links = get_theme_mod('amble_content_links');

    if ($amble_content_links && $amble_content_links !== '#2b789b') {
      $css .= '
      a, a:visited {
            color: ' . esc_attr($amble_content_links) . ';
      }';
    }

    // Image caption overlay background
    $amble_image_bg_caption = get_theme_mod('amble_image_bg_caption');

    if ($amble_image_bg_caption && $amble_image_bg_caption !== '#ffffff') {
      $css .= '
        .widget_media_image figcaption, #banner-sidebar figcaption, .featured-media .wp-caption-text {
          background-color: ' . hex2rgba(esc_attr($amble_image_bg_caption), 0.8, true) . ' !important;
        }';
    }

    // Image caption overlay text
    $amble_caption_text_color = get_theme_mod('amble_caption_text_color');

    if ($amble_caption_text_color && $amble_caption_text_color !== '#292929') {
      $css .= '
        #banner-sidebar .wp-caption-text, .featured-media .wp-caption-text {
          color: ' . esc_attr($amble_caption_text_color) . ';
        }';
    }


    // Bottom sidebar bg
    $amble_bottom_sidebar_bg = get_theme_mod('amble_bottom_sidebar_bg');

    if ($amble_bottom_sidebar_bg && $amble_bottom_sidebar_bg !== '#e9ecef') {
      $css .= '
        .bottom-sidebar {
          background: ' . esc_attr($amble_bottom_sidebar_bg) . ';
        }';
    }

    // Bottom sidebar text
    $amble_bottom_sidebar_text = get_theme_mod('amble_bottom_sidebar_text');

    if ($amble_bottom_sidebar_text && $amble_bottom_sidebar_text !== '#333333') {
      $css .= '
        .bottom-sidebar, 
		.bottom-sidebar .widget-title, 
		.bottom-sidebar a {
          color: ' . hex2rgba(esc_attr($amble_bottom_sidebar_text), 1, true) . ';
        }';
    }

    // Bottom widget title line
    $amble_bottom_widget_title_line = get_theme_mod('amble_bottom_widget_title_line');

    if ($amble_bottom_widget_title_line && $amble_bottom_widget_title_line !== '#ced4da') {
      $css .= '
        .bottom-sidebar .widget-title {
          color: ' . hex2rgba(esc_attr($amble_bottom_widget_title_line), 1, true) . ';
        }';
    }


    // Search icon background
    $amble_search_icon_bg = get_theme_mod('amble_search_icon_bg');

    if ($amble_search_icon_bg && $amble_search_icon_bg !== '#adb5bd') {
      $css .= '
        .searchModal-btn {
          background: ' . esc_attr($amble_search_icon_bg) . ';
        }';
    }



    // Footer area background
    $amble_footer_bg = get_theme_mod('amble_footer_bg');

    if ($amble_footer_bg && $amble_footer_bg !== '#212529') {
      $css .= '
        .site-footer,
		#back-to-top-wrapper {
          background: ' . esc_attr($amble_footer_bg) . ';
        }';
    }

    // Footer text colour
    $amble_footer_text = get_theme_mod('amble_footer_text');

    if ($amble_footer_text && $amble_footer_text !== '#ffffff') {
      $css .= '
        .site-footer, 
		.site-footer a, 
		.site-footer a:visited {
         color: ' . hex2rgba(esc_attr($amble_footer_text), 0.8, true) . ';
        }';
    }

    // Hide banner captions
    $amble_hide_banner_captions = get_theme_mod('amble_hide_banner_captions');

    if ($amble_hide_banner_captions && $amble_hide_banner_captions !== false) {
      $css .= "
        #banner-sidebar .wp-caption-text {
          display: none;
        }";
    }

    $custom_css = get_theme_mod('amble_custom_css');

    if ($custom_css) {
      $css .= wp_filter_nohtml_kses($custom_css);
    }

    return $css; // phpcs:ignore WordPress.Security.EscapeOutput
  }
endif;
