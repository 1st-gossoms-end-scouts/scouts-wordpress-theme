<?php
if (has_post_thumbnail()) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    $align_featured_image = get_post(get_the_ID())->align_featured_image;
    $logo_exists = metadata_exists('post', get_the_ID(), 'logo_image');

}
if ($logo_exists) {
    $logo_image_url = wp_get_attachment_image_src(get_post(get_the_ID())->logo_image, 'full')[0];
}
?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article role="article" id="post_<?php the_ID() ?>" <?php post_class("mb-5") ?>>
        <header class="py-5 mb-5 masthead"
                style="background-image: url(<?php echo $featured_image ?>);  background-position: <?php echo $align_featured_image ?>">
            <div class="container h-100">
                <?php if ($logo_exists) { ?>
                    <div class="row h-100 mt-5">
                        <div class="col-sm-6">
                            <img style="max-width:50vw; max-height:50vh;" src="<?php echo $logo_image_url ?>"
                                 alt="">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row h-100 mt-5">
                        <div class="col-sm-6">
                            <div class="bg-white display-4 p-4"><h1 class="text-purple"><?php the_title() ?></h1></div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </header>
        <!--    <header class="container py-5 text-center">-->
        <!--      -->
        <!--    </header>-->
        <section class="wrap-md pb-5 entry-content">
            <?php the_content() ?>
            <?php wp_link_pages(); ?>
        </section>
    </article>
<?php
endwhile;
else :
    get_template_part('loops/404');
endif;
?>
