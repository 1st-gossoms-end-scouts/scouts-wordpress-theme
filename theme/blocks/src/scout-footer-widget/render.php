<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?> id="scout-footer-widget-div">
    <img style="max-width: 7em;" src="<?php echo get_theme_file_uri('theme/assets/fleur-de-lis-marque-white.png') ?>" alt="Scout Logo">
    <div class="widget_scout_footer_column_div">
        <div class="widget_scout_footer_text_left">
            <?php echo strip_tags($attributes['leftContent'], '<br><strong><a>'); ?>
        </div>
        <div class="widget_scout_vertical_line"></div>
        <div class="widget_scout_footer_text_right">
            <?php echo strip_tags($attributes['rightContent'], '<br><strong><a>'); ?>
        </div>
    </div>
</div>