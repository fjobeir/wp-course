<?php

add_filter('wp_edit_nav_menu_walker', function($class, $menu_id) {
    $locations = get_nav_menu_locations();
    $location = array_search($menu_id, $locations);
    switch ($location) {
        case 'top-menu':
            $class = 'Wpc_Top_Menu_Edit_Walker';
            break;
        case 'main-menu':
            $class = 'Wpc_Main_Menu_Edit_Walker';
    }
	return $class;
}, 10, 2);
add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_db_id, $menu_item_args) {
	if (is_array($_POST['menu-item-icon'])) {
		update_post_meta($menu_item_db_id, '_menu_item_icon', sanitize_html_class($_POST['menu-item-icon'][$menu_item_db_id]));
    }
    if (is_array($_POST['menu-item-color'])) {
		update_post_meta($menu_item_db_id, '_menu_item_color', sanitize_html_class($_POST['menu-item-color'][$menu_item_db_id]));
	}
    if (is_array($_POST['menu-item-mega-menu'])) {
        $checked = ($_POST['menu-item-mega-menu'][$menu_item_db_id] == '1') ? '1' : 0;
		update_post_meta($menu_item_db_id, '_menu_item_mega-menu', $checked);
	}
}, 10, 3);
add_filter('wp_setup_nav_menu_item', function($item) {
	$item->icon = get_post_meta($item->ID, '_menu_item_icon', true);
	$item->color = get_post_meta($item->ID, '_menu_item_color', true);
	$item->mega_menu = get_post_meta($item->ID, '_menu_item_mega-menu', true);
	return $item;
});