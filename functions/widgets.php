<?php
/**
 * Widgets
 */

class Scout_Footer_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'scout_footer_widget', // Base ID
            'Scouts Info Footer', // Name
            array( 'description' => __( 'Footer widget to display information and contact details', 'scouts-wordpress-theme' ) ) // Args
        );
    }
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        ?> <img src="<?php echo get_theme_file_uri('theme/assets/fleur-de-lis-marque-white.png') ?>"> <?php
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        echo __( 'Hello, World!', 'scouts-wordpress-theme' );
        echo $after_widget;
    }
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = __( 'New title', 'scouts-wordpress-theme' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' , 'scouts-wordpress-theme'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance          = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // class Foo_Widget



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
    'before_widget'   => '<div class="%1$s %2$s col-md">',
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
    'before_widget'   => '<div class="%1$s %2$s col-md">',
    'after_widget'    => '</div>',
    'before_title'    => '<h2 class="h4">',
    'after_title'     => '</h2>',
  ) );

    register_widget( 'Scout_Footer_Widget' );

}
add_action( 'widgets_init', 'b5st_widgets_init' );

