<?php global $visits_count; ?>
<div class="blog-meta big-meta">
    <small><a href="<?php echo get_year_link(get_the_date('Y')) ?>" title=""><?php echo get_the_date('d M, Y') ?></a></small>
    <small><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title=""><?php _e('By', 'wpc'); ?> <?php echo get_the_author_meta('display_name'); ?></a></small>
    <small><a href="#" title=""><i class="fa fa-eye"></i> <?php echo $visits_count; ?></a></small>
</div><!-- end meta -->
        