<?php

//add_action( 'admin_menu', 'remove_admin_menus' );
//add_action( 'wp_before_admin_bar_render', 'remove_toolbar_menus' );
//add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
//add_filter( 'admin_url', 'add_new_post_url', 10, 3 );

//function remove_admin_menus() {
//    remove_menu_page( 'edit.php' );
//}
//
//function remove_toolbar_menus() {
//    global $wp_admin_bar;
//    $wp_admin_bar->remove_menu( 'new-post' );
//}
//
//function remove_dashboard_widgets() {
//    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
//    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
//}

//function add_new_post_url( $url, $path, $blog_id ) {
//    if ( str_ends_with($path, "post-new.php" ) ) {
//        $url = $url."?post_type=page";
//    }
//    return $url;
//}

add_action( 'admin_bar_menu', 'customize_my_wp_admin_bar', 80 );
function customize_my_wp_admin_bar( $wp_admin_bar ) {

    //Get a reference to the new-content node to modify.
    $new_content_node = $wp_admin_bar->get_node('new-content');

    // Parent Properties for new-content node:
    //$new_content_node->id     // 'new-content'
    //$new_content_node->title  // '<span class="ab-icon"></span><span class="ab-label">New</span>'
    //$new_content_node->parent // false
    //$new_content_node->href   // 'http://www.somedomain.com/wp-admin/post-new.php'
    //$new_content_node->group  // false
    //$new_content_node->meta['title']   // 'Add New'

    //Change href
    $new_content_node->href = $new_content_node->href.'?post_type=page';

    //Update Node.
    $wp_admin_bar->add_node($new_content_node);

    //Remove post to re add at bottom
    $wp_admin_bar->remove_menu('new-post');
    $args = array(
        'id'     => 'new-post',
        'title'  => 'Blog Post',
        'parent' => 'new-content',
        'href'  => admin_url( 'post-new.php' ),
        'meta'  => array( 'class' => 'ab-item' )
    );
    $wp_admin_bar->add_node( $args );

    // Properties for new-post node:
    //$new_content_node->id     // 'new-post'
    //$new_content_node->title  // 'Post'
    //$new_content_node->parent // 'new-content'
    //$new_content_node->href   // 'http://www.somedomain.com/wp-admin/post-new.php'
    //$new_content_node->group  // false
    //$new_content_node->meta   // array()


    // Adding a new custom menu item that did not previously exist.
//    $wp_admin_bar->add_menu( array(
//            'id'    => 'new-custom-menu',
//            'title' => 'Custom Menu',
//            'parent'=> 'new-content',
//            'href'  => '#custom-menu-link',)
//    );

}