<?php

add_action('admin_menu', function() {
    add_menu_page(
        __('WP Course Options', 'wpcourse'),
        __('Options', 'wpcourse'),
        'manage_options',
        'wpc_options',
        'wpc_social_media_options',
        'dashicons-admin-generic',
        78
    );
    add_submenu_page(
        'wpc_options',
        __('Social Media', 'wpcourse'),
        __('Social Media', 'wpcourse'),
        'manage_options',
        'wpc_options',
        'wpc_social_media_options',
        1
    );
    add_submenu_page(
        'wpc_options',
        __('Post Options', 'wpcourse'),
        __('Post Options', 'wpcourse'),
        'manage_options',
        'wpc_post_options',
        'wpc_post_options',
        2
    );
});

if (!function_exists('wpc_social_media_options')) {
    function wpc_social_media_options()
    {
        $networks = ['facebook', 'flickr', 'instagram', 'pinterest', 'twitter', 'youtube'];
        if (isset($_POST['_wpnonce'])) {
            if (!wp_verify_nonce($_POST['_wpnonce'], 'wpc_social_options') || !current_user_can('manage_options')) {
                wp_die();
            }
            $links = [];
            foreach ($networks as $network) {
                if (isset($_POST['wpc_' . $network . '_link'])) {
                    $links[$network] = esc_url_raw($_POST['wpc_' . $network . '_link']);
                }
            }
            update_option('wpc_social_options', $links, false);
        }
        ?>
        <div class="wrap">
            <h1><?php _e('Social Media Links', 'wpcourse'); ?></h1>
            <form action="" method="post">
                <table class="form-table">
                <?php 
                $links = get_option('wpc_social_options');
                foreach ($networks as $network) {
                    $link = isset($links[$network]) ? $links[$network] : '';
                    ?>
                    <tr>
                        <th><?php _e(ucfirst($network), 'wpcourse'); ?></th>
                        <td>
                            <input type="url" name="<?php echo esc_attr('wpc_' . $network . '_link') ?>" value="<?php echo esc_url($link); ?>">
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <p class="submit">
                    <input type="submit" value="<?php echo esc_attr(__('Save Social Links', 'wpcourse')) ?>" class="button button-primary">
                </p>
                <?php wp_nonce_field('wpc_social_options'); ?>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('wpc_post_options')) {
    function wpc_post_options()
    {
        $sections = [
            'breadcrumb' => [
                'file' => 'breadcrumb',
                'title' => __('Breadcrumb', 'wpcourse')
            ],
            'categories' => [
                'file' => 'categories',
                'title' => __('Post Categories', 'wpcourse')
            ],
            'title' => [
                'file' => 'title',
                'title' => __('Post Title', 'wpcourse')
            ],
            'post_meta' => [
                'file' => 'post_meta',
                'title' => __('Post Meta', 'wpcourse')
            ],
            'share_top' => [
                'file' => 'share',
                'title' => __('Share Top', 'wpcourse')
            ],
            'post_thumbnail' => [
                'file' => 'post_thumbnail',
                'title' => __('Post Thumbnail', 'wpcourse')
            ],
            'post_content' => [
                'file' => 'post_content',
                'title' => __('Post Content', 'wpcourse')
            ],
            'tags' => [
                'file' => 'tags',
                'title' => __('Post Tags', 'wpcourse')
            ],
            'share_bottom' => [
                'file' => 'share',
                'title' => __('Share Bottom', 'wpcourse')
            ],
            'next_previous' => [
                'file' => 'next_previous',
                'title' => __('Next & Previous Posts', 'wpcourse')
            ],
            'author' => [
                'file' => 'author',
                'title' => __('Post Author', 'wpcourse')
            ],
            'related_posts' => [
                'file' => 'related_posts',
                'title' => __('Related Posts', 'wpcourse')
            ],
        ];
        if (isset($_POST['_wpnonce'])) {
            if (!wp_verify_nonce($_POST['_wpnonce'], 'wpc_post_options') || !current_user_can('manage_options')) {
                wp_die();
            }
            $parts = [];
            foreach ($sections as $section => $data) {
                $parts[$section]['show'] = 0;
                if (isset($_POST['wpc_show_' . $section])) {
                    $parts[$section]['show'] = 1;
                    $parts[$section]['file'] = $sections[$section]['file'];
                }
            }
            update_option('wpc_post_options', $parts, false);
        }
        ?>
        <h1><?php _e('Post Options', 'wpcourse'); ?></h1>
        <form action="" method="post">
            <table class="form-table">
            <?php
            $parts = get_option('wpc_post_options');
            foreach ($sections as $section => $data) {
                ?>
                <tr>
                    <th><?php echo $data['title']; ?></th>
                    <td>
                        <input <?php if ($parts[$section]['show'] == 1) {echo 'checked';} ?> type="checkbox" name="wpc_show_<?php echo esc_attr($section); ?>">
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <p class="submit">
                <input type="submit" value="<?php echo esc_attr(__('Save post options', 'wpcourse')) ?>" class="button button-primary">
            </p>
            <?php wp_nonce_field('wpc_post_options'); ?>
        </form>
        <?php
    }
}