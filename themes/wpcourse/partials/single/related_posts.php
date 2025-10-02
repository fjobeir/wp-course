<?php
$post_tags = get_the_terms(null, 'post_tag');
if (is_array($post_tags)) {
    $related_posts = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 2,
        'post__not_in' => [get_the_ID()],
        'tag__in' => wp_list_pluck($post_tags, 'term_id')
    ]);
    if ($related_posts->have_posts()) {
        ?>
        <div class="custombox clearfix">
            <h4 class="small-title"><?php _e('You may also like', 'wpc'); ?></h4>
            <div class="row">
        <?php
        while($related_posts->have_posts()) {
            $related_posts->the_post();
            echo '<div class="col-lg-6">';
            get_template_part('partials/post-card', '2', ['image_size' => 'horizontal']);
            echo '</div>';
        }
        ?>
            </div><!-- end row -->
        </div><!-- end custom-box -->
        <hr class="invis1">
        <?php
        wp_reset_postdata();
    }
}
?>