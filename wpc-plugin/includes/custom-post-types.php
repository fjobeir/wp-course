<?php

if (!function_exists('wpc_register_post_types')) {
    function wpc_register_post_types()
    {
        register_post_type('wpc_ad', [
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'comments', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'post-formats'],
            'rewrite' => [
                'slug' => __('ad', 'wpcourse'),
            ],
            'capability_type' => ['ad', 'ads'],
            'map_meta_cap' => true,
            'labels' => [
                'name' => __('Ads', 'wpcourse'),
                'singular_name' => __('Ad', 'wpcourse'),
                'menu_name'             => __( 'Ads', 'wpcourse' ),
                'name_admin_bar'        => __( 'Ad', 'wpcourse' ),
                'archives'              => __( 'Ad Archives', 'wpcourse' ),
                'attributes'            => __( 'Ad Attributes', 'wpcourse' ),
                'parent_item_colon'     => __( 'Parent Ad:', 'wpcourse' ),
                'all_items'             => __( 'All Ads', 'wpcourse' ),
                'add_new_item'          => __( 'Add New Ad', 'wpcourse' ),
                'add_new'               => __( 'Add New', 'wpcourse' ),
                'new_item'              => __( 'New Ad', 'wpcourse' ),
                'edit_item'             => __( 'Edit Ad', 'wpcourse' ),
                'update_item'           => __( 'Update Ad', 'wpcourse' ),
                'view_item'             => __( 'View Ad', 'wpcourse' ),
                'view_items'            => __( 'View Ads', 'wpcourse' ),
                'search_items'          => __( 'Search Ads', 'wpcourse' ),
                'not_found'             => __( 'No ads found', 'wpcourse' ),
                'not_found_in_trash'    => __( 'No ads found in Trash', 'wpcourse' ),
                'featured_image'        => __( 'Featured Image', 'wpcourse' ),
                'set_featured_image'    => __( 'Set featured image', 'wpcourse' ),
                'remove_featured_image' => __( 'Remove featured image', 'wpcourse' ),
                'use_featured_image'    => __( 'Use as featured image', 'wpcourse' ),
                'insert_into_item'      => __( 'Insert into ad', 'wpcourse' ),
                'uploaded_to_this_item' => __( 'Uploaded to this ad', 'wpcourse' ),
                'items_list'            => __( 'Ads list', 'wpcourse' ),
                'items_list_navigation' => __( 'Ads list navigation', 'wpcourse' ),
                'filter_items_list'     => __( 'Filter ads list', 'wpcourse' ),
            ]
        ]);
    }
    add_action('init', 'wpc_register_post_types');
}