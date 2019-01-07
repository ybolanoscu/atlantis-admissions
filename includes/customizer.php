<?php
/**
 * Atlantis: Customizer
 *
 * @package WordPress
 * @subpackage Atlantis
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function atlantis_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'atlantis_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'atlantis_customize_partial_blogdescription',
    ));

    /**
     * Custom colors.
     */
    $wp_customize->add_setting('link_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '#2BA6CB', //Default setting/value to save
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color_control', array(
        'label' => __('Link Color', 'atlantis'), //Admin-visible name of the control
        'settings' => 'link_color', //Which setting to load and manipulate (serialized is okay)
        'section' => 'colors',
        'priority' => 6,
    )));
    $wp_customize->add_setting('title_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '#2BA6CB', //Default setting/value to save
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'title_color_control', array(
        'label' => __('Title Color', 'atlantis'), //Admin-visible name of the control
        'settings' => 'title_color', //Which setting to load and manipulate (serialized is okay)
        'section' => 'colors',
        'priority' => 6,
    )));

    /**
     * Theme options.
     */
    $wp_customize->add_panel('atlantis_options_panel', array(
        'priority' => 143,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Template Options', 'atlantis'),
        'description' => '',
    ));


    $atlantis_settings = atlantis_get_theme_options();
    /**
     * Filter number of front page sections in Atlantis.
     *
     * @since Atlantis 1.0
     *
     * @param int $num_sections Number of front page sections.
     */
    $num_sections = apply_filters('atlantis_front_page_sections', $atlantis_settings['frontend_page_sections']);

    // Create a setting and control for each of the sections available in the theme.
    for ($i = 1; $i < (1 + $num_sections); $i++) {
        $wp_customize->add_section('atlantis_theme_options' . $i, array(
            'title' => sprintf(__('Section %d Content', 'atlantis'), $i),
            'priority' => $i + 1,
            'panel' => 'atlantis_options_panel',
        ));

        $image_name = 'section_' . $i . '_image';
        switch ($i) {
            case 1:
                $wp_customize->add_setting($image_name,
                    array(
                        'default' => '',
                        'capability' => 'edit_theme_options',
                        'transport' => 'refresh',
                    )
                );
                $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, $image_name, array(
                    'label' => __('Main Image', 'atlantis'),
                    'capability' => 'edit_theme_options',
                    'section' => 'atlantis_theme_options' . $i,
                    'priority' => 2,
                    'settings' => $image_name,
                    'width' => 1800,
                    'height' => 550,
                )));
                $wp_customize->add_setting('atlantis_theme_options[atlantis_bg_section_h1]', array(
                    'default' => $atlantis_settings['atlantis_bg_section_h1'],
                    'sanitize_callback' => 'esc_html',
                    'type' => 'option',
                ));
                $wp_customize->add_control('atlantis_theme_options[atlantis_bg_section_h1]', array(
                    'capability' => 'edit_theme_options',
                    'priority' => 3,
                    'label' => esc_html__('First Line', 'atlantis'),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'text',
                ));
                $wp_customize->add_setting('atlantis_theme_options[atlantis_bg_section_slogan]', array(
                    'default' => $atlantis_settings['atlantis_bg_section_slogan'],
                    'sanitize_callback' => 'esc_html',
                    'type' => 'option',
                ));
                $wp_customize->add_control('atlantis_theme_options[atlantis_bg_section_slogan]', array(
                    'capability' => 'edit_theme_options',
                    'priority' => 4,
                    'label' => esc_html__('Second Line', 'atlantis'),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'text',
                ));
                break;
            case 2:
                $wp_customize->add_setting($image_name,
                    array(
                        'default' => '',
                        'capability' => 'edit_theme_options',
                        'transport' => 'refresh',
                    )
                );
                $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, $image_name, array(
                    'label' => __('Main Image', 'atlantis'),
                    'capability' => 'edit_theme_options',
                    'section' => 'atlantis_theme_options' . $i,
                    'priority' => 2,
                    'settings' => $image_name,
                    'width' => 600,
                    'height' => 550,
                )));
                $wp_customize->add_setting('panel_' . $i, array(
                    'default' => false,
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh',
                ));
                $wp_customize->add_control('panel_' . $i, array(
                    'label' => sprintf(__('Front Page Section %d Content', 'atlantis'), $i),
                    'description' => (1 !== $i ? '' : __('Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'atlantis')),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'dropdown-pages',
                    'allow_addition' => true,
                    'active_callback' => 'atlantis_is_static_front_page',
                ));

                $wp_customize->selective_refresh->add_partial('panel_' . $i, array(
                    'selector' => '#panel' . $i,
                    'render_callback' => 'atlantis_front_page_section',
                    'container_inclusive' => true,
                ));
                break;
            case 4:
                $wp_customize->add_setting($image_name,
                    array(
                        'default' => '',
                        'capability' => 'edit_theme_options',
                        'transport' => 'refresh',
                    )
                );
                $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, $image_name, array(
                    'label' => __('Main Image', 'atlantis'),
                    'capability' => 'edit_theme_options',
                    'section' => 'atlantis_theme_options' . $i,
                    'priority' => 2,
                    'settings' => $image_name,
                    'width' => 650,
                    'height' => 550,
                )));
                $wp_customize->add_setting('panel_' . $i, array(
                    'default' => false,
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh',
                ));
                $wp_customize->add_control('panel_' . $i, array(
                    'label' => sprintf(__('Front Page Section %d Content', 'atlantis'), $i),
                    'description' => (1 !== $i ? '' : __('Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'atlantis')),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'dropdown-pages',
                    'allow_addition' => true,
                    'active_callback' => 'atlantis_is_static_front_page',
                ));

                $wp_customize->selective_refresh->add_partial('panel_' . $i, array(
                    'selector' => '#panel' . $i,
                    'render_callback' => 'atlantis_front_page_section',
                    'container_inclusive' => true,
                ));
                $wp_customize->add_setting('atlantis_theme_options[atlantis_section_4_button]', array(
                    'default' => $atlantis_settings['atlantis_section_4_button'],
                    'sanitize_callback' => 'esc_html',
                    'type' => 'option',
                ));
                $wp_customize->add_control('atlantis_theme_options[atlantis_section_4_button]', array(
                    'capability' => 'edit_theme_options',
                    'priority' => 4,
                    'label' => esc_html__('Button Text', 'atlantis'),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'text',
                ));
                break;
            case 6:
                $wp_customize->add_setting('panel_' . $i, array(
                    'default' => false,
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh',
                ));
                $wp_customize->add_control('panel_' . $i, array(
                    'label' => sprintf(__('Front Page Section %d Content', 'atlantis'), $i),
                    'description' => (1 !== $i ? '' : __('Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'atlantis')),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'dropdown-pages',
                    'allow_addition' => true,
                    'active_callback' => 'atlantis_is_static_front_page',
                ));

                $wp_customize->selective_refresh->add_partial('panel_' . $i, array(
                    'selector' => '#panel' . $i,
                    'render_callback' => 'atlantis_front_page_section',
                    'container_inclusive' => true,
                ));
                $wp_customize->add_setting('atlantis_theme_options[atlantis_section_5_map]', array(
                    'default' => $atlantis_settings['atlantis_section_5_map'],
                    'sanitize_callback' => 'esc_html',
                    'type' => 'option',
                ));
                $wp_customize->add_control('atlantis_theme_options[atlantis_section_5_map]', array(
                    'capability' => 'edit_theme_options',
                    'priority' => 4,
                    'label' => esc_html__('Google Maps Data', 'atlantis'),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'text',
                ));
                break;
            default:
                $wp_customize->add_setting('panel_' . $i, array(
                    'default' => false,
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh',
                ));
                $wp_customize->add_control('panel_' . $i, array(
                    'label' => sprintf(__('Front Page Section %d Content', 'atlantis'), $i),
                    'description' => (1 !== $i ? '' : __('Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'atlantis')),
                    'section' => 'atlantis_theme_options' . $i,
                    'type' => 'dropdown-pages',
                    'allow_addition' => true,
                    'active_callback' => 'atlantis_is_static_front_page',
                ));

                $wp_customize->selective_refresh->add_partial('panel_' . $i, array(
                    'selector' => '#panel' . $i,
                    'render_callback' => 'atlantis_front_page_section',
                    'container_inclusive' => true,
                ));
                break;
        }
    }

    $wp_customize->add_section('atlantis_custom_header', array(
        'title' => esc_html__('General Options', 'atlantis'),
        'priority' => 1,
        'panel' => 'atlantis_options_panel'
    ));
    $image_name = 'top_logo';
    $wp_customize->add_setting($image_name,
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, $image_name, array(
        'label' => __('Top Logo', 'atlantis'),
        'capability' => 'edit_theme_options',
        'section' => 'atlantis_custom_header',
        'priority' => 38,
        'settings' => $image_name,
        'width' => 230,
        'height' => 70,
    )));
    $image_name = 'footer_logo';
    $wp_customize->add_setting($image_name,
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, $image_name, array(
        'label' => __('Footer Logo', 'atlantis'),
        'capability' => 'edit_theme_options',
        'section' => 'atlantis_custom_header',
        'priority' => 39,
        'settings' => $image_name,
        'width' => 230,
        'height' => 70,
    )));
    $wp_customize->add_setting('atlantis_theme_options[atlantis_top_slogan_icon]', array(
        'default' => $atlantis_settings['atlantis_top_slogan_icon'],
        'sanitize_callback' => 'esc_html',
        'type' => 'option',
    ));
    $wp_customize->add_control('atlantis_theme_options[atlantis_top_slogan_icon]', array(
        'capability' => 'edit_theme_options',
        'priority' => 40,
        'label' => esc_html__('Top slogan css class icon', 'atlantis'),
        'section' => 'atlantis_custom_header',
        'type' => 'text',
    ));
    $wp_customize->add_setting('atlantis_theme_options[atlantis_top_slogan]', array(
        'default' => $atlantis_settings['atlantis_top_slogan'],
        'sanitize_callback' => 'esc_html',
        'type' => 'option',
    ));
    $wp_customize->add_control('atlantis_theme_options[atlantis_top_slogan]', array(
        'capability' => 'edit_theme_options',
        'priority' => 41,
        'label' => esc_html__('Top slogan', 'atlantis'),
        'section' => 'atlantis_custom_header',
        'type' => 'text',
    ));
    $wp_customize->add_setting('atlantis_theme_options[atlantis_top_second_slogan_icon]', array(
        'default' => $atlantis_settings['atlantis_top_second_slogan_icon'],
        'sanitize_callback' => 'esc_html',
        'type' => 'option',
    ));
    $wp_customize->add_control('atlantis_theme_options[atlantis_top_second_slogan_icon]', array(
        'capability' => 'edit_theme_options',
        'priority' => 43,
        'label' => esc_html__('Top Second Slogan css class icon', 'atlantis'),
        'section' => 'atlantis_custom_header',
        'type' => 'text',
    ));
    $wp_customize->add_setting('atlantis_theme_options[atlantis_top_second_slogan]', array(
        'default' => $atlantis_settings['atlantis_top_second_slogan'],
        'sanitize_callback' => 'esc_html',
        'type' => 'option',
    ));
    $wp_customize->add_control('atlantis_theme_options[atlantis_top_second_slogan]', array(
        'capability' => 'edit_theme_options',
        'priority' => 44,
        'label' => esc_html__('Top Second slogan', 'atlantis'),
        'section' => 'atlantis_custom_header',
        'type' => 'text',
    ));
    $wp_customize->add_setting('atlantis_theme_options[atlantis_bottom_slogan]', array(
        'default' => $atlantis_settings['atlantis_bottom_slogan'],
        'sanitize_callback' => 'esc_html',
        'type' => 'option',
    ));
    $wp_customize->add_control('atlantis_theme_options[atlantis_bottom_slogan]', array(
        'capability' => 'edit_theme_options',
        'priority' => 45,
        'label' => esc_html__('Bottom slogan', 'atlantis'),
        'section' => 'atlantis_custom_header',
        'type' => 'text',
    ));
}

add_action('customize_register', 'atlantis_customize_register');

/**
 * Sanitize the page layout options.
 *
 * @param string $input Page layout.
 *
 * @return string
 */
function atlantis_sanitize_page_layout($input)
{
    $valid = array(
        'one-column' => __('One Column', 'atlantis'),
        'two-column' => __('Two Column', 'atlantis'),
    );

    if (array_key_exists($input, $valid)) {
        return $input;
    }

    return '';
}

/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 *
 * @return string
 */
function atlantis_sanitize_colorscheme($input)
{
    $valid = array('light', 'dark', 'custom');

    if (in_array($input, $valid, true)) {
        return $input;
    }

    return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Atlantis 1.0
 * @see atlantis_customize_register()
 *
 * @return void
 */
function atlantis_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Atlantis 1.0
 * @see atlantis_customize_register()
 *
 * @return void
 */
function atlantis_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function atlantis_is_static_front_page()
{
//	return ( is_front_page() );
//	return ( is_front_page() && ! is_home() );
    return true;
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function atlantis_is_view_with_layout_option()
{
    // This option is available on all pages. It's also available on archives when there isn't a sidebar.
    return (is_page() || (is_archive() && !is_active_sidebar('sidebar-1')));
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function atlantis_customize_preview_js()
{
    wp_enqueue_script('atlantis-customize-preview', get_theme_file_uri('/js/customize-preview.js'), array('customize-preview'), '1.0', true);
}

add_action('customize_preview_init', 'atlantis_customize_preview_js');

function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true)
{
    $return = '';
    $mod = get_theme_mod($mod_name);
    if (!empty($mod)) {
        $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix . $mod . $postfix
        );
        if ($echo) {
            echo $return;
        }
    }
    return $return;
}

function header_output()
{
    ?>
    <!--Customizer CSS-->
    <style type="text/css">
        .customize-partial-edit-shortcut-button {
            left: 1px !important;
        }

        <?php generate_css('.site-title a', 'color', 'title_color'). '!important'; ?>
        <?php generate_css('.site-description', 'color', 'title_color'); ?>
        <?php generate_css('body', 'background-color', 'background_color', '#'); ?>
        <?php generate_css('a', 'color', 'link_color'); ?>
    </style>
    <!--/Customizer CSS-->
    <?php
}

add_action('wp_head', 'header_output');

