<?php 
$post_id = get_the_ID();
$post_link = get_permalink($post_id);
$post_title = get_the_title();
$post_categories = get_the_terms($post_id, 'category');
?>
<div class="pitem item-w1 item-h1">
    <div class="blog-box">
        <div class="post-media">
            <a href="<?php echo $post_link; ?>" title="<?php echo $post_title; ?>">
                <?php the_post_thumbnail('horizontal'); ?>
                <div class="hovereffect">
                    <span></span>
                </div><!-- end hover -->
            </a>
        </div><!-- end media -->
        <div class="blog-meta">
            <?php
            if (is_array($post_categories)) {
                foreach ($post_categories as $category) {
                    echo '<span class="bg-'.wpc_get_term_color($category->term_id).'"><a href="'.get_term_link($category).'" title="">'.$category->name.'</a></span>';
                }
            }
            ?>
            
            <h4><a href="<?php echo $post_link; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h4>
            <small><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" title=""><?php _e('By', 'wpc'); ?>: <?php echo get_the_author_meta('display_name'); ?></a></small>
            <small><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')) ?>" title=""><?php echo get_the_date('d M, Y') ?></a></small>
        </div><!-- end meta -->
    </div><!-- end blog-box -->
</div><!-- end col -->