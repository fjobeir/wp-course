<?php
$post_id = get_the_ID();
$post_link = get_permalink();
$post_title = get_the_title();
$post_categories = get_the_terms($post_id, 'wpc_ad_group');
?>
<div class="blog-list clearfix">
    <div class="blog-box row">
        <div class="col-md-4">
            <div class="post-media">
                <a href="<?php echo esc_url($post_link); ?>" title="<?php echo esc_attr($post_title); ?>">
                    <?php the_post_thumbnail('square', ['class' => 'img-fluid']); ?>
                    <div class="hovereffect"></div>
                </a>
            </div><!-- end media -->
        </div><!-- end col -->

        <div class="blog-meta big-meta col-md-8">
            <h4><a href="<?php echo esc_url($post_link); ?>" title=""><?php echo $post_title; ?></a></h4>
            <p><?php the_excerpt(); ?></p>
            <?php 
            if (is_array($post_categories)) {
                echo '<small>';
                foreach ($post_categories as $category) {
                    $categories_links[] = '<a href="'.get_term_link($category).'">'.$category->name.'</a>';
                }
                echo implode(', ', $categories_links);
                echo '</small>';
            }
            ?>
            <small><a href="<?php echo esc_url($post_link); ?>" title=""><?php echo get_the_date('d M, Y'); ?></a></small>
            <small><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="">
                <?php echo __('By', 'wpc') . ' ' . get_the_author_meta('display_name'); ?>
            </a></small>
        </div><!-- end meta -->
    </div><!-- end blog-box -->
</div>
<hr class="invis">