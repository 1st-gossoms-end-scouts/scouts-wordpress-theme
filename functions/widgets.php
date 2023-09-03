<?php
/**
 * Widgets
 */


function b5st_widgets_init() {

  /**
   * Versatile widget areas using Bootstrap grid columns
   * ===================================================
   *
   * Flexbox `col-sm` gives the correct the column width:
   *
   * — If only 1 widget, then this will have full width ...
   * — If 2 widgets, then these will each have half width ...
   * — If 3 widgets, then these will each have third width ...
   * — If 4 widgets, then these will each have quarter width ...
   *
   * ... above the Bootstrap `sm` breakpoint.
   */

  /**
   * Main
   */

   register_sidebar( array(
    'name'            => __( 'Mainbody Widget Area', 'scouts-wordpress-theme' ),
    'id'              => 'mainbody-widget-area-1',
    'description'     => __( 'Use 1, 2, 3 or 4 widgets.', 'scouts-wordpress-theme' ),
    'before_widget'   => '<div id="%1$s" class="%2$s col-md">',
    'after_widget'    => '</div>',
    'before_title'    => '<h2 class="h4">',
    'after_title'     => '</h2>',
  ) );

  /**
   * Footer
   */

  register_sidebar( array(
    'name'            => __( 'Footer Widget Area', 'scouts-wordpress-theme' ),
    'id'              => 'footer-widget-area',
    'description'     => __( 'Use 1, 2, 3 or 4 widgets.', 'scouts-wordpress-theme' ),
    'before_widget'   => '<div id="%1$s" class="%2$s col-md">',
    'after_widget'    => '</div>',
    'before_title'    => '<h2 class="h4">',
    'after_title'     => '</h2>',
  ) );
}

add_action( 'widgets_init', 'b5st_widgets_init' );



function set_widgets() {
    // Get all the associated widgets;
    $sidebar_widgets = get_option ( 'sidebars_widgets' );

    // Check this specific sidebar
    if ( isset( $sidebar_widgets [ 'mainbody-widget-area-1' ] ) ) {
        unset ( $sidebar_widgets [ 'mainbody-widget-area-1' ] );
        // Update the option
        update_option ( 'sidebars_widgets', $sidebar_widgets );
    }

    if ( isset( $sidebar_widgets [ 'footer-widget-area' ] ) ) {
        $widget_instances = get_option( 'widget_block', array() );
        $numeric_keys = array_filter( array_keys( $widget_instances ), 'is_int' );
        $next_key = $numeric_keys ? max( $numeric_keys ) + 1 : 2;
        // Add this widget to the sidebar
        $sidebar_widgets [ 'footer-widget-area' ] = array( 'block-' . $next_key );
        // Add the new widget instance
        $widget_instances[ $next_key ] = array('content' => '<!-- wp:scouts-wordpress-theme/scout-footer-widget /-->');
        // Update the option
        update_option( 'widget_block', $widget_instances);
        update_option ( 'sidebars_widgets', $sidebar_widgets );
    }
}


add_action( 'after_switch_theme', 'set_widgets' );
