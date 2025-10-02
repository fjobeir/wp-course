<?php 
$pagination_links = paginate_links([
    'prev_text' => __('Previous Page', 'wpc'),
    'next_text' => __('Next Page', 'wpc'),
    'type' => 'array',
]);
if (is_array($pagination_links)) {
    echo '<div class="row"><div class="col-md-12"><nav aria-label="Page navigation"><ul class="pagination justify-content-start">';
    foreach ($pagination_links as $link) {
        $link = str_replace('class="', 'class="page-link ', $link);
        echo '<li class="page-item">' . $link . '</li>';
    }
    echo '</ul></nav></div></div><!-- end row -->';
}
?>