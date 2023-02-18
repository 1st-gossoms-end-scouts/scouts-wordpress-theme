<?php
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
class WP_Customize_Dropdown_Control extends WP_Customize_Control
{
    public $allow_addition = true;
    protected function render_content()
    {
        $input_id = '_customize-input-' . $this->id;
        $description_id = '_customize-description-' . $this->id;
        $describedby_attr = (!empty($this->description)) ? ' aria-describedby="' . esc_attr($description_id) . '" ' : '';
        ?>
        <?php if (!empty($this->label)) : ?>
        <label for="<?php echo esc_attr($input_id); ?>"
               class="customize-control-title"><?php echo esc_html($this->label); ?></label>
        <?php endif; ?>
        <?php if (!empty($this->description)) : ?>
        <span id="<?php echo esc_attr($description_id); ?>"
              class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>

        <?php
        $dropdown_name = '_customize-dropdown-pages-' . $this->id;
        $show_option_none = '';
        $option_none_value = $this->value('default');
        $dropdown = wp_dropdown_pages(
            array(
                'name' => $dropdown_name,
                'echo' => 0,
                'show_option_none' => $show_option_none,
                'option_none_value' => $option_none_value,
                'selected' => $this->value(),
            )
        );
        if (empty($dropdown)) {
            $dropdown = sprintf('<select id="%1$s" name="%1$s">', esc_attr($dropdown_name));
            $dropdown .= sprintf('<option value="%1$s">%2$s</option>', esc_attr($option_none_value), esc_html($show_option_none));
            $dropdown .= '</select>';
        }

        // Hackily add in the data link parameter.
        $dropdown = str_replace('<select', '<select ' . $this->get_link() . ' id="' . esc_attr($input_id) . '" ' . $describedby_attr, $dropdown);

        // Even more hacikly add auto-draft page stubs.
        // @todo Eventually this should be removed in favor of the pages being injected into the underlying get_pages() call. See <https://github.com/xwp/wp-customize-posts/pull/250>.
        $nav_menus_created_posts_setting = $this->manager->get_setting('nav_menus_created_posts');
        if ($nav_menus_created_posts_setting && current_user_can('publish_pages')) {
            $auto_draft_page_options = '';
            foreach ($nav_menus_created_posts_setting->value() as $auto_draft_page_id) {
                $post = get_post($auto_draft_page_id);
                if ($post && 'page' === $post->post_type) {
                    $auto_draft_page_options .= sprintf('<option value="%1$s">%2$s</option>', esc_attr($post->ID), esc_html($post->post_title));
                }
            }
            if ($auto_draft_page_options) {
                $dropdown = str_replace('</select>', $auto_draft_page_options . '</select>', $dropdown);
            }
        }

        echo $dropdown;
        ?>
        <?php if ($this->allow_addition && current_user_can('publish_pages') && current_user_can('edit_theme_options')) : // Currently tied to menus functionality. ?>
        <button type="button" class="button-link add-new-toggle">
            <?php
            /* translators: %s: Add New Page label. */
            printf(__('+ %s', 'scouts-wordpress-theme'), get_post_type_object('page')->labels->add_new_item);
            ?>
        </button>
        <div class="new-content-item">
            <label for="create-input-<?php echo esc_attr($this->id); ?>"><span
                        class="screen-reader-text"><?php _e('New page title', 'scouts-wordpress-theme'); ?></span></label>
            <input type="text" id="create-input-<?php echo esc_attr($this->id); ?>" class="create-item-input"
                   placeholder="<?php esc_attr_e('New page title&hellip;', 'scouts-wordpress-theme'); ?>">
            <button type="button" class="button add-content"><?php _e('Add', 'scouts-wordpress-theme'); ?></button>
        </div>
    <?php endif;
    }
}