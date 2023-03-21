<?php

/**
 * Register theme sidebars
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function amble_widgets_init()
{

	register_sidebar(array(
		'name' => esc_html__('Blog Sidebar', 'amble'),
		'id' => 'blog-sidebar',
		'description' => esc_html__('Sidebar for your blog and archives.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Page Right Sidebar', 'amble'),
		'id' => 'right-sidebar',
		'description' => esc_html__('Right sidebar for your pages.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Page Left Sidebar', 'amble'),
		'id' => 'left-sidebar',
		'description' => esc_html__('Left sidebar for your pages.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Blog Banner', 'amble'),
		'id' => 'blog-banner',
		'description' => esc_html__('Banner sidebar for the blog home page.', 'amble'),
		'before_widget' => '<div id="%1$s" class="banner widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Banner', 'amble'),
		'id' => 'banner',
		'description' => esc_html__('Banner sidebar for images and sliders.', 'amble'),
		'before_widget' => '<div id="%1$s" class="banner widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 1', 'amble'),
		'id'            => 'bottom1',
		'description'   => esc_html__('First sidebar of the bottom group located above the footer area.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 2', 'amble'),
		'id'            => 'bottom2',
		'description'   => esc_html__('Second sidebar of the bottom group located above the footer area.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 3', 'amble'),
		'id'            => 'bottom3',
		'description'   => esc_html__('Third  sidebar of the bottom group located above the footer area.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 4', 'amble'),
		'id'            => 'bottom4',
		'description'   => esc_html__('Fourth sidebar of the bottom group located above the footer area.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer', 'amble'),
		'id' => 'footer',
		'description' => esc_html__('Add a widget to your footer area.', 'amble'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action('widgets_init', 'amble_widgets_init');
