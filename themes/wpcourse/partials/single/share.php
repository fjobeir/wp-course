<?php
$post_link = (isset($args['post_link'])) ? $args['post_link'] : get_permalink();
?>
<div class="post-sharing">
    <ul class="list-inline">
        <li>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>" class="fb-button btn btn-primary">
                <i class="fa fa-facebook"></i> 
                <span class="down-mobile"><?php echo __('Share on Facebook', 'wpc'); ?></span>
            </a>
        </li>&nbsp;
        <li>
            <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $post_link; ?>" class="tw-button btn btn-primary">
                <i class="fa fa-twitter"></i> 
                <span class="down-mobile"><?php echo __('Tweet on Twitter', 'wpc'); ?></span>
            </a>
        </li>
    </ul>
</div><!-- end post-sharing -->