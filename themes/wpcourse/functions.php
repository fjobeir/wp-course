<?php

if (!isset($content_width)) {
    $content_width = 600;
}

$base = get_template_directory_uri() . '/';

if (!function_exists('wpc_load_assets')) {
    function wpc_load_assets()
    {
        global $base;
        wp_enqueue_style('wpc_bootstrap', $base . 'assets/css/bootstrap.css', [], null);
        wp_enqueue_style('wpc_fontawesome', $base . 'assets/css/font-awesome.min.css', ['wpc_bootstrap'], null);
        wp_enqueue_style('wpc_style', $base . 'assets/style.css', [], null);
        wp_enqueue_style('wpc_responsive', $base . 'assets/css/responsive.css', [], null);
        wp_enqueue_style('wpc_colors', $base . 'assets/css/colors.css', [], null);
        wp_enqueue_style('wpc_theme_style', $base . 'style.css', [], wp_get_theme('wpcourse')->get('Version'));
        wp_enqueue_script('wpc_jquery', $base . 'assets/js/jquery.min.js', [], null, true);
        wp_enqueue_script('wpc_tether', $base . 'assets/js/tether.min.js', [], null, true);
        wp_enqueue_script('wpc_bootstrap', $base . 'assets/js/bootstrap.min.js', [], null, true);
        wp_enqueue_script('wpc_masonry', $base . 'assets/js/masonry.js', [], null, true);
        wp_enqueue_script('wpc_custom', $base . 'assets/js/custom.js', [], null, true);
        wp_localize_script('wpc_custom', 'wpc_vars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
        if (is_single()) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'wpc_load_assets');
}
if (!function_exists('wpc_setup')) {
    function wpc_setup()
    {
        add_theme_support('post-thumbnails');
        register_nav_menus([
            'top-menu' => __('Top Menu', 'wpc'),
            'main-menu' => __('Main Menu', 'wpc'),
        ]);
        add_theme_support('custom-logo', [
            'width' => 300,
            'height' => 100,
        ]);
        add_theme_support('customize-selective-refresh-widgets');
        add_image_size('horizontal', 800, 460, true);
        add_image_size('534x468', 534, 468, true);
        add_image_size('533x261', 533, 261, true);
        add_image_size('400x299', 400, 299, true);
        add_image_size('1024x550', 1024, 550, true);
        add_image_size('345x512', 345, 512, true);
        add_image_size('square', 450, 450, true);
        add_theme_support('html5', [
            'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'
        ]);
        add_theme_support('post-formats', [
            'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
        ]);
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        // remove_theme_support('widgets-block-editor');
    }
    add_action('after_setup_theme', 'wpc_setup');
}

add_filter('get_the_archive_title', function($title, $original_title, $prefix) {
    return $original_title;
}, 10, 3);

add_action('wp_head', function() {
    if (is_singular()) {
        $post_meta = get_post_meta(get_the_ID());
        if (isset($post_meta['wpc_meta_keywords'])) {
            echo '<meta name="keywords" content="'.esc_attr($post_meta['wpc_meta_keywords'][0]).'">';
        }
        if (isset($post_meta['wpc_meta_description'])) {
            echo '<meta name="description" content="'.esc_attr($post_meta['wpc_meta_description'][0]).'">';
        }
    }
});



require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/walkers/walkers.php';
require get_template_directory() . '/inc/customize.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/comments.php';
require get_template_directory() . '/inc/ajax-actions.php';