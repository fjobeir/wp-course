<?php
$post_link = get_permalink();
$categories = get_the_category();
?>
<div <?php post_class('blog-box'); ?>>
    <div class="post-media">
        <a href="<?php echo esc_url($post_link); ?>" title="">
            <img src="<?php echo get_the_post_thumbnail_url(null, 'horizontal') ?>" alt="" class="img-fluid">
            <div class="hovereffect">
                <span></span>
            </div>
        </a>
    </div>
    <div class="blog-meta big-meta text-center">
        <?php get_template_part('partials/single/share'); ?>
        <h4><a href="<?php echo esc_url($post_link); ?>" title=""><?php the_title(); ?></a></h4>
        <p><?php the_excerpt(); ?></p>
        <?php
        if (is_array($categories) && count($categories)) {
            echo '<small><a href="'.get_term_link($categories[0]).'" title="">'.$categories[0]->name.'</a></small>';
        }
        ?>
        <small><a href="<?php echo get_year_link(get_the_date('Y')); ?>" title=""><?php echo get_the_date('d M, Y'); ?></a></small>
        <small><?php the_author_posts_link(); ?></small>
        <small><i class="fa fa-eye"></i> <?php echo ((int)(get_post_meta(get_the_ID(), 'wpc_post_views', true))) ?></small>
    </div>
</div>
<hr class="invis">