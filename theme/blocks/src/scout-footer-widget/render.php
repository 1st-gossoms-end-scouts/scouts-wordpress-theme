<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?> id="scout-footer-widget-div">
    <?php if ($GLOBALS['pallete'][4] == "#FFFFFF") {
        $footer_logo_img_src = 'theme/assets/fleur-de-lis-marque-white.png';
    } else {
        $footer_logo_img_src = 'theme/assets/fleur-de-lis-marque-black.png';
    } ?>
    <img style="max-width: 5em;" src="<?php echo get_theme_file_uri($footer_logo_img_src) ?>" alt="Scout Logo">
    <div class="widget_scout_footer_column_div">
        <div class="widget_scout_footer_text_left footer-text">
            <?php echo strip_tags($attributes['leftContent'], '<br><strong><a>'); ?>
        </div>
        <div style="border-left: thick solid <?php echo $GLOBALS['pallete'][4] ?>"></div>
        <div class="widget_scout_footer_text_right footer-text">
            <?php echo strip_tags($attributes['rightContent'], '<br><strong><a>'); ?>
        </div>
    </div>
</div>