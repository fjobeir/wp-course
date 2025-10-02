<?php

if (!function_exists('wpc_get_term_color')) {
    function wpc_get_term_color($term_id)
    {
        $color = false;
        if (is_int($term_id) && term_exists($term_id)) {
            $term_color = get_term_meta($term_id, 'wpc_icon_color', true);
            if ($term_color) {
                $color = $term_color;
            }
        }
        if (!$color) {
            $color = get_theme_mod('default_color', 'aqua');
        }
        return $color;
    }
}

if (!function_exists('wpc_get_main_title')) {
    function wpc_get_main_title()
    {
        $main_title = '';
        if (is_archive()) {
            if (is_category() || is_tag() || is_tax()) {
                $term = get_queried_object();
                $term_meta = get_term_meta($term->term_id);
                if (!empty($term_meta['wpc_icon_code'][0])) {
                    $main_title .= '<i class="fa '.esc_attr($term_meta['wpc_icon_code'][0] . ' bg-' . wpc_get_term_color($term->term_id)).'"></i>';
                }
            }
            $main_title .= get_the_archive_title();
            if (is_category() || is_tag() || is_tax()) {
                if (!empty($term->description)) {
                    $main_title .= '<small class="hidden-xs-down hidden-sm-down">'.$term->description.'</small>';
                }
            }
        } elseif (is_singular()) {
            $main_title = get_the_title();
        } elseif (is_404()) {
            $main_title = __('Not Found', 'wpc');
        } elseif (is_search()) {
            $main_title = __('Search Page', 'wpc');
        } elseif (is_home()) {
            $main_title = __('Blog', 'wpc');
        }
        return !empty($main_title) ? '<h2>' . $main_title . '</h2>' : '';
    }
}

if (!function_exists('wpc_generate_breadcrumb')) {
    function wpc_generate_breadcrumb()
    {
        $links = [];
        $links[] = '<a href="' . home_url() . '">'.__('Home', 'wpc').'</a>';
        if (is_archive()) {
            $links[] = get_the_archive_title();
        } elseif (is_404()) {
            $links[] = __('Not Found', 'wpc');
        } elseif (is_search()) {
            $links[] = __('Search Page', 'wpc');
        } elseif (is_singular()) {
            $post_type_archive = get_post_type_archive_link(get_post_type());
            if ($post_type_archive) {
                $post_type_object = get_post_type_object(get_post_type());
                $links[] = '<a href="'.esc_url($post_type_archive).'">'.$post_type_object->labels->name.'</a>';
            }
            $links[] = get_the_title();
        } elseif (is_home()) {
            $links[] = __('Blog', 'wpc');
        }
        $count = count($links);
        for($i = 0; $i < $count; $i++) {
            $is_active = ($i == ($count - 1)) ? ' active' : '';
            $links[$i] = '<li class="breadcrumb-item' . esc_attr($is_active) . '">' . $links[$i] . '</li>';
        }
        return $links;
    }
}

if (!function_exists('wpc_print_first_block_instance')) {
    function wpc_print_first_block_instance($blockName)
    {
        $post_blocks = parse_blocks(get_the_content());
        foreach ($post_blocks as $block) {
            if ($block['blockName'] === $blockName) {
                echo apply_filters('the_content', render_block($block));
                break;
            }
        }
    }
}