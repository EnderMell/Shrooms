<?php

/**
 * Customizer Color Setting
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

function amble_customize_register_colour($wp_customize)
{

  // Colour Options Panel
  $wp_customize->add_panel('colors', array(
    'priority' => 40,
    'title'    => esc_html__('Colours', 'amble'),
  ));

  // SECTION - PRESET COLOURS 
  $wp_customize->add_section('amble_preset_colours', array(
    'title' => esc_html__('Preset Colours', 'amble'),
    'priority' => 10,
    'panel' => 'colors'
  ));

  // SECTION - CONTENT COLOURS 
  $wp_customize->add_section('amble_content_colours', array(
    'title' => esc_html__('Content Colors', 'amble'),
    'priority' => 15,
    'panel' => 'colors'
  ));

  // SECTION - NAV COLOURS
  $wp_customize->add_section('amble_nav_colours', array(
    'title' => esc_html__('Navigation Colors', 'amble'),
    'priority' => 20,
    'panel' => 'colors'
  ));

  /* PRESET SETTINGS
@since 2.0.0
==================================================== */
  // Presets
  $wp_customize->add_setting(
    'amble_presets',
    array(
      'default' => 'preset1',
      'sanitize_callback' => 'amble_sanitize_select',
    )
  );

  $wp_customize->add_control(
    new Amble_Radio_Image_Control(
      $wp_customize,
      'amble_presets',
      array(
        'label' => esc_html__('Preset Groups', 'amble'),
        'description' => esc_html__('Choose a preset colour palette for your theme. This will load a variety of accent colours for select elements in your page.', 'amble'),
        'section' => 'amble_preset_colours',
        'type' => 'radio-image',
        'choices' => amble_colour_preset_options()
      )
    )
  );


  /** Enable Custom Accent Colours */
  $wp_customize->add_setting(
    'amble_custom_accent_colours',
    array(
      'default'           => false,
      'sanitize_callback' => 'amble_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    new Amble_Toggle_Control(
      $wp_customize,
      'amble_custom_accent_colours',
      array(
        'section'     => 'amble_preset_colours',
        'label'        => esc_html__('Custom Accent Colours', 'amble'),
        'description' => esc_html__('Enable to change the theme accent colours to be your own.', 'amble'),
      )
    )
  );


  // Custom Primary Colour
  $wp_customize->add_setting('amble_custom_primary_colour', array(
    'default'           => '#bba579',
    'transport' => 'postMessage',
    'sanitize_callback' => 'amble_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'amble_custom_primary_colour',
    array(
      'label'       => esc_html__('Primary Colour', 'amble'),
      'description' => esc_html__('Sets a custom primary accent colour for your theme.', 'amble'),
      'section'     => 'amble_preset_colours',
      'active_callback' => 'amble_custom_accent_colours_show',
    )
  ));

  // Custom Secondary Colour
  $wp_customize->add_setting('amble_custom_secondary_colour', array(
    'default'           => '#c6975e',
    'transport' => 'postMessage',
    'sanitize_callback' => 'amble_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'amble_custom_secondary_colour',
    array(
      'label'       => esc_html__('Secondary Colour', 'amble'),
      'description' => esc_html__('Sets a custom secondary accent colour for your theme.', 'amble'),
      'section'     => 'amble_preset_colours',
      'active_callback' => 'amble_custom_accent_colours_show',
    )
  ));

  // Custom Tertiary Colour
  $wp_customize->add_setting('amble_custom_tertiary_colour', array(
    'default'           => '#2b789b',
    'transport' => 'postMessage',
    'sanitize_callback' => 'amble_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'amble_custom_tertiary_colour',
    array(
      'label'       => esc_html__('Tertiary Colour', 'amble'),
      'description' => esc_html__('Sets a custom tertiary (third) accent colour for your theme.', 'amble'),
      'section'     => 'amble_preset_colours',
      'active_callback' => 'amble_custom_accent_colours_show',
    )
  ));

  /* CONTENT COLOUR SETTINGS
==================================================== */
  $wp_customize->add_setting('amble_content_bg_colour', array(
    'default'           => '#ffffff',
    'transport' => 'postMessage',
    'sanitize_callback' => 'amble_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'amble_content_bg_colour',
    array(
      'label'       => esc_html__('Content Area Background', 'amble'),
      'description' => esc_html__('Unless a preset changes the colour, you can customize your content area background colour.', 'amble'),
      'section'     => 'colors',
    )
  ));

  // Body text colour
  $wp_customize->add_setting(
    'amble_content_area_text_colour',
    array(
      'default' => '#646464',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_content_area_text_colour',
      array(
        'label' => esc_html__('Body Text Colour', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_content_area_text_colour',
      )
    )
  );

  // Headings colour
  $wp_customize->add_setting(
    'amble_headings_colour',
    array(
      'default' => '#292929',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_headings_colour',
      array(
        'label' => esc_html__('Headings Colour', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_headings_colour',
      )
    )
  );


  // Content links
  $wp_customize->add_setting(
    'amble_content_links',
    array(
      'default' => '#2b789b',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_content_links',
      array(
        'label' => esc_html__('Content Links', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_content_links',
      )
    )
  );

  // Search icon bg
  $wp_customize->add_setting(
    'amble_search_icon_bg',
    array(
      'default' => '#adb5bd',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_search_icon_bg',
      array(
        'label' => esc_html__('Search Icon Background ', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_search_icon_bg',
      )
    )
  );

  // Banner caption bg background
  $wp_customize->add_setting(
    'amble_image_bg_caption',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_image_bg_caption',
      array(
        'label' => esc_html__('Image Caption Background Colour', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_image_bg_caption',
      )
    )
  );

  // Image overlay caption text
  $wp_customize->add_setting(
    'amble_caption_text_color',
    array(
      'default' => '#292929',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_caption_text_color',
      array(
        'label' => esc_html__('Caption Overlay Text Colour', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_caption_text_color',
      )
    )
  );


  // Bottom Sidebar background
  $wp_customize->add_setting(
    'amble_bottom_sidebar_bg',
    array(
      'default' => '#e9ecef',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_bottom_sidebar_bg',
      array(
        'label' => esc_html__('Bottom Sidebar Background', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_bottom_sidebar_bg',
      )
    )
  );

  // Bottom sidebar text
  $wp_customize->add_setting(
    'amble_bottom_sidebar_text',
    array(
      'default' => '#333333',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_bottom_sidebar_text',
      array(
        'label' => esc_html__('Bottom Sidebar Text', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_bottom_sidebar_text',
      )
    )
  );

  // Bottom widget title line
  $wp_customize->add_setting(
    'amble_bottom_widget_title_line',
    array(
      'default' => '#ced4da',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_bottom_widget_title_line',
      array(
        'label' => esc_html__('Bottom Widget Title Lines', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_bottom_widget_title_line',
      )
    )
  );


  // Footer bg
  $wp_customize->add_setting(
    'amble_footer_bg',
    array(
      'default' => '#212529',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_footer_bg',
      array(
        'label' => esc_html__('Footer Area Background ', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_footer_bg',
      )
    )
  );

  // Footer text
  $wp_customize->add_setting(
    'amble_footer_text',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'amble_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'amble_footer_text',
      array(
        'label' => esc_html__('Footer Area Text', 'amble'),
        'section' => 'colors',
        'settings' => 'amble_footer_text',
      )
    )
  );

  /* NAVIGATION COLOUR SETTINGS
==================================================== */
  $wp_customize->add_setting('amble_nav_link_colour', array(
    'default'           => '#495057',
    'transport' => 'postMessage',
    'sanitize_callback' => 'amble_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'amble_nav_link_colour',
    array(
      'label'       => esc_html__('Primary Nav Link Colour', 'amble'),
      'description' => esc_html__('This sets the colour for your primary menu links.', 'amble'),
      'section'     => 'amble_nav_colours',
    )
  ));
}
add_action('customize_register', 'amble_customize_register_colour');


/* CALLBACKS
==================================================== */
// Show custom accent colour selectors callback
function amble_custom_accent_colours_show($control)
{
  if ($control->manager->get_setting('amble_custom_accent_colours')->value() == 'true') {
    return true;
  } else {
    return false;
  }
}
