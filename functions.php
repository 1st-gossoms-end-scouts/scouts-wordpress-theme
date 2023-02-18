<?php
/*
 * All the functions are in the PHP files in the `functions/` folder.
 */

if ( ! defined('ABSPATH') ) {
  exit;
}
require get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/enqueues.php';
require get_template_directory() . '/functions/action-hooks.php';
require get_template_directory() . '/functions/navbar.php';
require get_template_directory() . '/functions/dimox-breadcrumbs.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/search-widget.php';
require get_template_directory() . '/functions/index-pagination.php';
require get_template_directory() . '/functions/split-post-pagination.php';
require get_template_directory() . '/functions/gutenberg.php';
require get_template_directory() . '/functions/theme-options.php';
require get_template_directory() . '/functions/disable-blog.php';
require get_template_directory() . '/functions/class-wp-customize-dropdown-control.php';
require get_template_directory() . '/plugins/block-editor-colors/plugin.php';


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}