<?php 
$categories = get_the_terms(null, 'category');
if (is_array($categories)) {
    foreach($categories as $category) {
        echo '<span class="color-'.esc_attr(wpc_get_term_color($category->term_id)).'">
        <a href="'.esc_url(get_term_link($category)).'" title="'.esc_attr($category->name).'">'.$category->name.'</a>
        </span>';
    }
}
?>