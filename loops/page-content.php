<?php
if (has_post_thumbnail()) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    $align_featured_image = get_post(get_the_ID())->align_featured_image;
    $logo_exists = metadata_exists('post', get_the_ID(), 'logo_image');
} else {
    $logo_exists = false;
}
$logo_image = get_post(get_the_ID()) -> logo_image;
if ($logo_image) {
    $logo_image_url = wp_get_attachment_image_src($logo_image, 'full')[0];
}
?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article role="article" id="post_<?php the_ID() ?>" <?php post_class("mb-5") ?>>
        <?php if (has_post_thumbnail(get_the_ID())) { ?>
            <header class="py-3 mb-5 masthead"
                    style="background-image: url(<?php echo $featured_image ?>);  background-position: <?php echo $align_featured_image ?>">
            <div class="container h-100">
                    <?php if ($logo_image_url) { ?>
                        <div class="row h-100">
                            <div class="col-sm-6" style="display: flex; align-items: center; height: 90%">
                                <img style="max-width:50vw; max-height:40vh;" src="<?php echo $logo_image_url ?>"
                                     alt="">
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row h-100 mt-5" style="margin-top: 6rem!important;">
                            <div class="col-sm-6">
                                <div class="bg-white display-4 p-4"><h1 class="text-primary hero-title"><?php the_title() ?></h1></div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <header class="container wrap-md entry-content">
                        <h1 class="my-5">
                            <?php the_title() ?>
                        </h1>
                    </header>
                <?php } ?>
            </div>
        </header>
        <section class="container wrap-md pb-5 entry-content">
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
