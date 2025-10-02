<?php
$next_post = get_next_post();
$previous_post = get_previous_post();
if (is_object($next_post) || is_object($previous_post)) {
?>
<div class="custombox prevnextpost clearfix">
    <div class="row">
        <div class="col-lg-6">
        <?php if (is_object($previous_post)) { ?>
            <div class="blog-list-widget">
                <div class="list-group">
                    <a href="<?php echo get_permalink($previous_post->ID) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between text-right">
                            <?php echo get_the_post_thumbnail($previous_post, 'thumbnail'); ?>
                            <h5 class="mb-1"><?php echo $previous_post->post_title; ?></h5>
                            <small><?php _e('Previous Post', 'wpc'); ?></small>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        </div><!-- end col -->

        <div class="col-lg-6">
        <?php if (is_object($next_post)) { ?>
            <div class="blog-list-widget">
                <div class="list-group">
                    <a href="<?php echo get_permalink($next_post) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <?php echo get_the_post_thumbnail($next_post, 'thumbnail') ?>
                            <h5 class="mb-1"><?php echo $next_post->post_title;?></h5>
                            <small><?php _e('Next Post', 'wpc'); ?></small>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end author-box -->

<hr class="invis1">
<?php } ?>