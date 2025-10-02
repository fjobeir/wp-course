<?php

if (!function_exists('wpc_add_metaboxes')) {
    function wpc_add_metaboxes()
    {
        add_meta_box(
            'wpc_ad_url_metabox',
            __('Ad URL', 'wpcourse'),
            'wpc_ad_url_html',
            'wpc_ad',
            'normal',
            'default'
        );
        add_meta_box(
            'wpc_meta_tags_content',
            __('Meta Tags', 'wpcourse'),
            'wpc_meta_tags_fields',
            ['post', 'page', 'wpc_ad']
        );
    }
    add_action('add_meta_boxes', 'wpc_add_metaboxes');
}

if (!function_exists('wpc_meta_tags_fields')) {
    function wpc_meta_tags_fields($post)
    {
        $post_meta = get_post_meta($post->ID);
        ?>
        <p>
            <label for=""><?php _e('Meta keywords', 'wpcourse') ?></label>
            <input type="text" name="wpc_meta_keywords" value="<?php echo esc_attr($post_meta['wpc_meta_keywords'][0]) ?>">
        </p>
        <p>
            <label for=""><?php _e('Meta description', 'wpcourse') ?></label>
            <input type="text" name="wpc_meta_description" value="<?php echo esc_attr($post_meta['wpc_meta_description'][0]) ?>">
        </p>
        <?php
    }
}

if (!function_exists('wpc_ad_url_html')) {
    function wpc_ad_url_html($post)
    {
        $ad_url = get_post_meta($post->ID, 'wpc_ad_url', true);
        ?>
        <p>
            <label for="wpc_ad_url"><?php _e('Type URL', 'wpcourse'); ?></label>
            <input type="text" name="wpc_ad_url" id="wpc_ad_url" value="<?php echo esc_url($ad_url); ?>">
        </p>
        <?php
    }
}

if (!function_exists('wpc_on_save_post')) {
    function wpc_on_save_post($post_id, $post, $update)
    {
        if (isset($_POST['wpc_ad_url'])) {
            update_post_meta($post_id, 'wpc_ad_url', esc_url_raw($_POST['wpc_ad_url']));
        }
        if (isset($_POST['wpc_meta_keywords'])) {
            update_post_meta($post_id, 'wpc_meta_keywords', ($_POST['wpc_meta_keywords']));
        }
        if (isset($_POST['wpc_meta_description'])) {
            update_post_meta($post_id, 'wpc_meta_description', ($_POST['wpc_meta_description']));
        }
    }
    add_action('save_post', 'wpc_on_save_post', 10, 3);
}
