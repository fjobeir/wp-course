<?php

if (!function_exists('wpc_add_code_color_fields')) {
    function wpc_add_code_color_fields($taxonomy)
    {
        ?>
        <div class="form-field">
            <label for="wpc_icon_code"><?php _e('Icon Code', 'wpcourse'); ?></label>
            <input type="text" name="wpc_icon_code" id="wpc_icon_code" class="iconpicker">
        </div>
        <div class="form-field">
            <label for="wpc_icon_color"><?php _e('Icon Color', 'wpcourse'); ?></label>
            <select name="wpc_icon_color" id="wpc_icon_color">
            <?php
            $colors = ['aqua', 'green', 'grey', 'pink', 'red', 'yellow'];
            foreach ($colors as $color) {
                echo '<option value="'.esc_attr($color).'">'.__(ucfirst($color), 'wpcourse').'</option>';
            }
            ?>
            </select>
        </div>
        <?php
    }
    add_action('category_add_form_fields', 'wpc_add_code_color_fields');
    add_action('post_tag_add_form_fields', 'wpc_add_code_color_fields');
    add_action('wpc_ad_group_add_form_fields', 'wpc_add_code_color_fields');
}

if (!function_exists('wpc_edit_code_color_fields')) {
    function wpc_edit_code_color_fields($term)
    {
        $term_meta = get_term_meta($term->term_id);
        ?>
        <tr class="form-field">
            <th><label for="wpc_icon_code"><?php _e('Icon Code', 'wpcourse'); ?></label></th>
            <td><input value="<?php echo esc_attr($term_meta['wpc_icon_code'][0]); ?>" class="iconpicker" type="text" name="wpc_icon_code" id="wpc_icon_code"></td>
        </tr>
        <tr class="form-field">
            <th><label for="wpc_icon_color"><?php _e('Icon Color', 'wpcourse'); ?></label></th>
            <td>
                <select name="wpc_icon_color" id="wpc_icon_color">
                <?php
                $colors = ['aqua', 'green', 'grey', 'pink', 'red', 'yellow'];
                foreach ($colors as $color) {
                    echo '<option value="'.esc_attr($color).'" '.selected($color, $term_meta['wpc_icon_color'][0], false).'>'.__(ucfirst($color), 'wpcourse').'</option>';
                }
                ?>
                </select>
            </td>
        </tr>
        <?php
    }
    add_action('category_edit_form_fields', 'wpc_edit_code_color_fields');
    add_action('post_tag_edit_form_fields', 'wpc_edit_code_color_fields');
    add_action('wpc_ad_group_edit_form_fields', 'wpc_edit_code_color_fields');
}


if (!function_exists('wpc_set_code_color_value')) {
    function wpc_set_code_color_value($term_id)
    {
        if (isset($_POST['wpc_icon_code'])) {
            update_term_meta($term_id, 'wpc_icon_code', $_POST['wpc_icon_code']);
        }
        if (isset($_POST['wpc_icon_color'])) {
            update_term_meta($term_id, 'wpc_icon_color', $_POST['wpc_icon_color']);
        }
    }
    add_action('created_category', 'wpc_set_code_color_value');
    add_action('created_post_tag', 'wpc_set_code_color_value');
    add_action('created_wpc_ad_group', 'wpc_set_code_color_value');
    add_action('edited_category', 'wpc_set_code_color_value');
    add_action('edited_post_tag', 'wpc_set_code_color_value');
    add_action('edited_wpc_ad_group', 'wpc_set_code_color_value');
}