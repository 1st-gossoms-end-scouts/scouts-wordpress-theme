<?php
/*
 * b5st Action Hooks
 * =================
 * Designed to be used by a child theme, but they can also be used directly 
 * in your development of b5st. Example usage:
 *    -- See “Dimox Breadcrumbs Insertion” below.
 *    -- See “Mainbody Widgets 1 Insertion” below.
 */

// Navbar (in `header.php`)


function b5st_navbar_before()
{
    do_action('navbar_before');
}

function b5st_navbar_after()
{
    do_action('navbar_after');
}

function image_alt_by_url( $image_url ) {
    global $wpdb;

    if( empty( $image_url ) ) {
        return false;
    }

    $query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $image_url ) ) );
    $image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;

    return get_post_meta( $image_id, '_wp_attachment_image_alt', true );
}

function b5st_navbar_brand()
{
    if (!has_action('navbar_brand')) {
        if (get_theme_mod('scout_logo_image')) {
            ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><img style="vertical-align:middle;max-height:65px;" alt="<?php echo image_alt_by_url(esc_url(get_theme_mod('scout_logo_image')))?>" src="<?php echo esc_url(get_theme_mod('scout_logo_image'))?>"></a>
            <?php
        } else {
            ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            <?php
        }
    } else {
        do_action('navbar_brand');
    }
}

function b5st_navbar_search()
{
    if (!has_action('navbar_search')) {
        ?>
        <form class="ms-1 md-flex" role="search" method="get" id="searchform" style="margin-left: 0!important;"
              action="<?php echo esc_url(home_url('/')); ?>">
            <div class="input-group">
                <input class="form-control border-secondary" type="text" value="<?php echo get_search_query(); ?>"
                       placeholder="Search..." name="s" id="s">
                <button type="submit" id="searchsubmit" value="<?php esc_attr_x('Search', 'scouts-wordpress-theme', 'scouts-wordpress-theme') ?>"
                        class="btn btn-outline-secondary bg-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <?php
    } else {
        do_action('navbar_search');
    }
}

// Mainbody

function b5st_mainbody_before()
{
    do_action('mainbody_before');
}

function b5st_mainbody_after()
{
    do_action('mainbody_after');
}

function b5st_mainbody_start()
{
    do_action('mainbody_start');
}

function b5st_mainbody_end()
{
    do_action('mainbody_end');
}

/*
 * Dimox Breadcrumbs Insertion
 * ===========================
 * An example for how to insert something via an action hook -- 
 * but inserting it only on single posts, using `is_single()`.
 */

function b5st_dimox_single_post()
{
    if (is_single()) { ?>
        <?php if (function_exists('dimox_breadcrumbs')) { ?>
            <?php dimox_breadcrumbs(); ?>
        <?php } ?>
    <?php }
}

;

add_action('mainbody_before', 'b5st_dimox_single_post');

/*
 * Mainbody Widgets 1 Insertion
 * ============================
 * An example for how to insert something via an action hook -- 
 * this will appear on every page (if you have widgets in this area).
 */

function b5st_mainbody_widgets_1()
{
    if (is_active_sidebar('mainbody-widget-area-1')): ?>
        <section class="container my-5">
            <div class="row">
                <?php dynamic_sidebar('mainbody-widget-area-1'); ?>
            </div>
        </section>
    <?php endif;
}

;
add_action('mainbody_end', 'b5st_mainbody_widgets_1');

// Footer (in `footer.php`)

function b5st_footer_before()
{
    do_action('footer_before');
}

function b5st_footer_after()
{
    do_action('footer_after');
}

function b5st_bottomline()
{
    if (!has_action('bottomline')) {
        $site_info_text = get_theme_mod('scout_site_info_link_text', 'Powered by Scout Wordpress Theme');
        $site_info_id = get_theme_mod('scout_site_info_link', '');
        if ($site_info_id == '') {
            $site_info_url = 'https://wordpress-theme.1stgossomsendscouts.org.uk';
        } else {
            $site_info_url = get_page_link($site_info_id);
        }
        ?>
        <div class="container">
            <div class="row pt-3">
                <div class="col-sm">
                    <p class="text-center text-sm-start text-secondary">&copy; <?php echo date('Y'); ?> <a
                                href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                </div>
                <div class="col-sm">
                    <p class="text-center text-sm-end text-secondary"><a href="<?php echo $site_info_url ?>"><?php echo $site_info_text ?></a></p>
                </div>
            </div>
        </div>
        <?php
    } else {
        do_action('bottomline');
    }
}
