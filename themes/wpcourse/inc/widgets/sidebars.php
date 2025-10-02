<?php

if (!function_exists('wpc_register_sidebars')) {
    function wpc_register_sidebars() {
        register_sidebar([
            'id' => 'blog-sidebar',
            'name' => __('Blog Sidebar', 'wpc'),
            'description' => __('This sidebar appears in single posts and blog page', 'wpc'),
            'class' => 'blog-sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ]);
        register_sidebars(3, [
            'id' => 'footer-area',
            'name' => 'Footer Area (%d)',
            'description' => __('This sidebar is contained in a footer column', 'wpc'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ]);
    }
    add_action('widgets_init', 'wpc_register_sidebars');
}