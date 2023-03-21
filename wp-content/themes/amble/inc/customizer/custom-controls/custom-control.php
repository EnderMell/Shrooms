<?php

/**
 * Get Customizer functions
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register Custom Controls
if (!function_exists('amble_register_custom_controls')) :

    function amble_register_custom_controls($wp_customize)
    {

        // Load our custom control.
        require_once get_template_directory() . '/inc/customizer/custom-controls/note/class-note-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/radioimg/class-radio-image-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/select/class-select-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/slider/class-slider-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/toggle/class-toggle-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/typography/class-fonts.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/typography/class-typography-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-repeater-setting.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-control-repeater.php';

        // Register the control type.
        $wp_customize->register_control_type('Amble_Radio_Image_Control');
        $wp_customize->register_control_type('Amble_Select_Control');
        $wp_customize->register_control_type('Amble_Slider_Control');
        $wp_customize->register_control_type('Amble_Toggle_Control');
        $wp_customize->register_control_type('Amble_Typography_Control');

        // Panels

        // Modify default WordPress sections and controls
        $wp_customize->get_control('blogdescription')->label = esc_html__('Site Description', 'amble');
        $wp_customize->get_section('colors')->panel = 'colors';
        $wp_customize->get_section('colors')->priority = 12;
        $wp_customize->get_section('colors')->title = esc_html__('Main Body', 'amble');
        $wp_customize->get_control('site_icon')->priority = 68;
        $wp_customize->get_control('background_color')->section   = 'amble_preset_colours';
        $wp_customize->get_control('background_color')->priority = 40;
    }
endif;
add_action('customize_register', 'amble_register_custom_controls');
