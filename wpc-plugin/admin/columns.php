<?php

if (!function_exists('wpc_manage_post_ad_columns')) {
    function wpc_manage_post_ad_columns($columns)
    {
        $columns['wpc_views_column'] = __('Views', 'wpcourse');
		if (current_theme_supports('post-thumbnails')) {
			$columns['wpc_thumbnail_column'] = __('Thumbnail', 'wpcourse');
		}
		if (array_key_exists('author', $columns)) {
			unset($columns['author']);
		}
        return $columns;
    }
    add_filter('manage_post_posts_columns', 'wpc_manage_post_ad_columns');
    add_filter('manage_wpc_ad_posts_columns', 'wpc_manage_post_ad_columns');
}

add_filter('manage_wpc_ad_posts_columns', function($columns) {
	$columns['wpc_ad_shortcode'] = __('Shortcode', 'wpcourse');
	return $columns;
});
add_filter('manage_wpc_ad_posts_custom_column', function($column, $post_id) {
	switch ($column) {
		case 'wpc_ad_shortcode':
			echo '[wpc_ad id="'.$post_id.'"]';
			break;
	}
}, 10, 2);

if (!function_exists('wpc_set_post_ad_column_content')) {
    function wpc_set_post_ad_column_content($column, $post_id) 
    {
        switch ($column) {
            case 'wpc_views_column':
                echo ((int)(get_post_meta($post_id, 'wpc_post_views', true)));
                break;
            case 'wpc_thumbnail_column':
                echo get_the_post_thumbnail($post_id, [100, 100]);
                break;
        }
    }
    add_filter('manage_post_posts_custom_column', 'wpc_set_post_ad_column_content', 10, 2);
    add_filter('manage_wpc_ad_posts_custom_column', 'wpc_set_post_ad_column_content', 10, 2);
}

if (!function_exists('wpc_set_post_ad_sortable_columns')) {
	function wpc_set_post_ad_sortable_columns($columns)
	{
		$columns['wpc_views_column'] = 'post_views';
		return $columns;
	}
	add_filter('manage_edit-post_sortable_columns', 'wpc_set_post_ad_sortable_columns');
	add_filter('manage_edit-wpc_ad_sortable_columns', 'wpc_set_post_ad_sortable_columns');
}

add_action('pre_get_posts', function($query) {
	if (is_admin()) {
		global $current_screen;
		if (is_object($current_screen) && ($current_screen->id == 'edit-post' || $current_screen->id == 'edit-wpc_ad')) {
			if ($query->get('orderby') == 'post_views') {
				// $query->set('meta_key', 'wpc_post_views');
				$query->set('orderby', 'meta_value_num');
				$query->set('meta_query', [
					'relation' => 'OR',
					[
						'key' => 'wpc_post_views',
						'compare' => 'NOT EXISTS'
					],
					[
						'key' => 'wpc_post_views',
						'compare' => 'EXISTS'
					]
				]);
			}
		}
	}
});