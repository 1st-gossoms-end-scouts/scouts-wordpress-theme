<?php
function scout_customize_register($wp_customize)
{

    $wp_customize->add_section('scout_color_scheme', array(
        'title' => __('Color Scheme', 'scout'),
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->add_setting('color_scheme_select', array(
        'default' => 'scout-white',
        'capability' => 'edit_theme_options',
        'type' => 'option',

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


    $wp_customize->add_setting('logo_image', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_image', array(
        'label' => __('Site Logo', 'scout'),
        'section' => 'title_tagline',
        'settings' => 'logo_image',
        'description' => '<p>This is the logo used in the navbar.</p><p>If no image is present the site name is displayed.</p><p>We recommend using the logo generator at <a href="https://scoutsbrand.org.uk" target="_blank">scoutsbrand.org.uk</a>, with the linear option.</p',
        'priority' => 10,
    )));
}

add_action('customize_register', 'scout_customize_register');

function get_scout_color_palette($color_str) {
    switch ($color_str){
        case "scout-white":
            $primary = "#FFFFFF"; //white
            $secondary = "#7413dc"; //purple
            $text_primary = "#000000"; //black
            $text_secondary = "#FFFFFF"; //white
            break;
        case "scout-purple":
            $primary = "#7413dc"; //purple
            $secondary = "#088486"; //teal
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#FFFFFF"; //white
            break;
        case "scout-red":
            $primary = "#ed3f23"; //red
            $secondary = "#ffb4e5"; //pink
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#000000"; //black
            break;
        case "scout-green":
            $primary = "#25b755"; //green
            $secondary = "#003982"; //navy
            $text_primary = "#000000"; //white
            $text_secondary = "#FFFFFF"; //white
            break;
        case "scout-blue":
            $primary = "#006ddf"; //blue
            $secondary = "#ffe627"; //yellow
            $text_primary = "#FFFFFF"; //white
            $text_secondary = "#000000"; //black
            break;
        case "scout-orange":
            $primary = "#ff912a"; //orange
            $secondary = "#205b41"; //forest green
            $text_primary = "#000000"; //black
            $text_secondary = "#FFFFFF"; //white
            break;
    }
    return array($primary, $secondary, $text_primary, $text_secondary);
}

function customize_css() {
    $color_str = get_option( 'color_scheme_select', 'scout-white' );
    $pallete = get_scout_color_palette($color_str);
    ?>
    <style>
        /* PRIMARY COLOUR OVERWRITES */
        .navbar{
            --bs-navbar-color: <?= $pallete[2] ?>!important;
        }
        button {
            background-color: <?= $pallete[0] ?> !important;
            color:  <?= $pallete[2] ?> !important;
        }

        /* SECONDARY COLOUR OVERWRITES */
        .bg-secondary {
            background-color: <?= $pallete[1] ?> !important;
        }
        .bi-search {
            color:<?= $pallete[3] ?> !important;
        }
        #footer {
            color: <?= $pallete[3] ?>!important;
            --bs-link-color: <?= $pallete[3] ?>!important;
        }
        .bg-primary {
            background-color: <?= $pallete[0] ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'customize_css');