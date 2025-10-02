<?php

if (!function_exists('wpc_child_enqueue_scripts')) {
    function wpc_child_enqueue_scripts()
    {
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/assets/css/child.css');
        wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/assets/js/child.js');
    }
    add_action('wp_enqueue_scripts', 'wpc_child_enqueue_scripts', 11);
}
