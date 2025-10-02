<?php
$post_link = get_permalink();
$categories = get_the_category();
?>
<div class="blog-box">
    <div class="post-media">
        <a href="<?php echo esc_url($post_link); ?>" title="">
            <img src="<?php echo get_the_post_thumbnail_url(null, $args['image_size']) ?>" alt="" class="img-fluid">
            <div class="hovereffect">
                <span></span>
            </div>
        </a>
    </div>
    <div class="blog-meta">
        <h4><a href="<?php echo esc_url($post_link); ?>" title=""><?php the_title(); ?></a></h4>
        <?php
        if (is_array($categories) && count($categories)) {
            echo '<small><a href="'.get_term_link($categories[0]).'" title="">'.$categories[0]->name.'</a></small>';
        }
        ?>
        <small><a href="<?php echo get_year_link(get_the_date('Y')); ?>" title=""><?php echo get_the_date('d M, Y'); ?></a></small>
    </div>
</div>
<hr class="invis">