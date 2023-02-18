<?php

use BlockEditorColors\CustomColorsService;
use BlockEditorColors\DefaultColorsService;

function scout_customize_register($wp_customize)
{

    $wp_customize->add_section('scout_color_scheme', array(
        'title' => __('Color Scheme', 'scouts-wordpress-theme'),
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->add_setting('color_scheme_select', array(
        'default' => 'scout-white',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('color_select_box', array(
        'settings' => 'color_scheme_select',
        'label' => 'Select Site Color Scheme:',
        'section' => 'scout_color_scheme',
        'type' => 'select',
        'choices' => array(
            'scout-white' => 'White/Purple',
            'scout-purple' => 'Purple/Teal',
            'scout-red' => 'Red/Pink',
            'scout-green' => 'Green/Navy',
            'scout-blue' => 'Blue/Yellow',
            'scout-orange' => 'Orange/Forest Green',
        ),
    ));


    $wp_customize->add_setting('scout_logo_image', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'scout_logo_image', array(
        'label' => __('Site Logo', 'scouts-wordpress-theme'),
        'section' => 'title_tagline',
        'settings' => 'scout_logo_image',
        'description' => '<p>This is the logo used in the navbar.</p><p>If no image is present the site name is displayed.</p><p>We recommend using the logo generator at <a href="https://scoutsbrand.org.uk" target="_blank">scoutsbrand.org.uk</a>, with the linear option.</p',
        'priority' => 10,
    )));
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->add_section('static_front_page', array(
        'title' => __('Homepage Settings', 'scouts-wordpress-theme'),
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->remove_control( 'show_on_front' );
    $wp_customize->remove_control( 'page_on_front' );
    $wp_customize->add_control(new WP_Customize_Dropdown_Control($wp_customize, 'page_on_front', array(
        'type' => 'dropdown-pages',
        'label' => 'Homepage',
        'section' => 'static_front_page',
        'settings' => 'page_on_front',
        'priority' => 1,
        'default' => "2"
    )));

}

update_option( 'show_on_front', 'page' );
// Hacky override to avoid showing the blog posts page ever
if (get_option('page_on_front') == '0') {
    update_option( 'page_on_front', '2' );
}
add_action('customize_register', 'scout_customize_register');

function get_scout_color_palette($color_str) {
    switch ($color_str){
        case "scout-white":
            $primary = "#FFFFFF"; //white
            $secondary = "#7413dc"; //purple
            $tertiary = "#088486"; //teal
            $text_primary = "#000000"; //black
            $text_secondary = "#FFFFFF"; //white
            $hero_text = "#7413dc"; //purple
            break;
        case "scout-purple":
            $primary = "#7413dc"; //purple
            $secondary = "#088486"; //teal
            $tertiary = "#088486"; //teal
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#FFFFFF"; //white
            $hero_text = "#7413dc"; //purple
            break;
        case "scout-red":
            $primary = "#ed3f23"; //red
            $secondary = "#ffb4e5"; //pink
            $tertiary = "#ffb4e5"; //pink
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#000000"; //black
            $hero_text = "#ed3f23"; //red
            break;
        case "scout-green":
            $primary = "#25b755"; //green
            $secondary = "#003982"; //navy
            $tertiary = "#003982"; //navy
            $text_primary = "#000000"; //white
            $text_secondary = "#FFFFFF"; //white
            $hero_text = "#25b755"; //green
            break;
        case "scout-blue":
            $primary = "#006ddf"; //blue
            $secondary = "#ffe627"; //yellow
            $tertiary = "#ffe627"; //yellow
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#000000"; //black
            $hero_text = "#006ddf"; //blue
            break;
        case "scout-orange":
            $primary = "#ff912a"; //orange
            $secondary = "#205b41"; //forest green
            $tertiary = "#205b41"; //forest green
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#FFFFFF"; //white
            $hero_text = "#ff912a"; //orange
            break;
    }
    return array($primary, $secondary, $tertiary, $text_primary, $text_secondary, $hero_text);
}

function customize_css() {
    $color_str = get_option( 'color_scheme_select', 'scout-white' );
    $pallete = get_scout_color_palette($color_str);
    $custom_color_service = CustomColorsService::getInstance();
    $custom_color_service -> delete_all_colors();
    $custom_color_service -> add_color_prog("Primary", "scout-primary", $pallete[0]);
    $custom_color_service -> add_color_prog("Secondary", "scout-secondary", $pallete[1]);
    $custom_color_service -> add_color_prog("Tertiary", "scout-tertiary", $pallete[2]);
    $custom_color_service -> add_color_prog("Text Primary", "scout-text-primary", $pallete[3]);
    $custom_color_service -> add_color_prog("Text Secondary", "scout-text-secondary", $pallete[4]);

    ?>
    <style>
        /* PRIMARY COLOUR OVERWRITES */

        button {
            background-color: <?= $pallete[0] ?> !important;
        }
        .bg-primary {
            background-color: <?= $pallete[0] ?> !important;
        }

        /* SECONDARY COLOUR OVERWRITES */
        .bg-secondary {
            background-color: <?= $pallete[1] ?> !important;
        }
        .dropdown-menu {
            --bs-dropdown-link-active-bg: <?= $pallete[1] ?>;
        }

        /* TEXT COLOUR OVERWRITES */
        /* Primary */
        .navbar{
            --bs-navbar-color: <?= $pallete[3] ?>!important;
            --bs-navbar-brand-color: <?= $pallete[3] ?>!important;
        }
        .text-primary {
            color:  <?= $pallete[3] ?> !important;
        }

        /* Secondary */
        :root{
            --bs-primary-rgb: <?= $pallete[4] ?> !important;
        }
        .wp-element-button{
            --bs-btn-color: <?= $pallete[4] ?>;
        }
        .bi-search {
            color:<?= $pallete[4] ?> !important;
        }
        #footer {
            color: <?= $pallete[4] ?>!important;
            --bs-link-color: <?= $pallete[4] ?>!important;
        }
        .text-secondary {
            color:  <?= $pallete[4] ?> !important;
            --bs-link-color: <?= $pallete[4] ?>!important;
        }
        .dropdown-menu {
            --bs-dropdown-link-active-color: <?= $pallete[4] ?>;
        }
        /* OTHER */
        .hero-title {
            color:  <?= $pallete[5] ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'customize_css');

function site_block_editor_styles() {
    wp_enqueue_style( 'site-block-editor-styles', get_theme_file_uri( '/theme/css/b5st.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'site_block_editor_styles' );

//function setup_scout_custom_colors() {
//    $custom_color_service = CustomColorsService::getInstance();
//    $custom_color_service -> delete_all_colors();
//    $custom_color_service -> add_color_prog("Primary", "scout-primary", "#FFFFFF");
//    $custom_color_service -> add_color_prog("Secondary", "scout-secondary", "#7413dc");
//    $custom_color_service -> add_color_prog("Tertiary", "scout-tertiary", "#088486");
//    $custom_color_service -> add_color_prog("Text Primary", "scout-text-primary", "##000000");
//    $custom_color_service -> add_color_prog("Text Secondary", "scout-text-secondary", "##FFFFFF");
//}
//
//function scout_theme_setup_options(){
//    update_option( 'widget_block', '');
//    setup_scout_custom_colors();
//}
//add_action('after_switch_theme', 'scout_theme_setup_options');