<?php
function myguten_register_meta()
{
    wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Nunito+Sans:400,700,900', false, null);
    wp_enqueue_style( 'google-fonts');
    wp_enqueue_script( 'guten', get_template_directory_uri() . '/theme/js/gutenberg.js', [ 'wp-element', 'wp-hooks' , 'wp-compose', 'wp-data', 'wp-components', 'wp-block-editor'] );
    register_meta('post', 'align_featured_image', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'logo_image', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
    ));
}

add_action('init', 'myguten_register_meta');
