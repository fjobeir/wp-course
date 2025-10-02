<?php
if (have_comments()) {
?>

<div class="custombox clearfix" id="comments">
    <h4 class="small-title">
    <?php printf(
        _n('%s Comment', '%s Comments', get_comments_number(), 'wpc'),
        number_format_i18n(get_comments_number())
    ); ?>
    </h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="comments-list">
            <?php
            $max_depth = get_option('thread_comments_depth');
            if (get_option('thread_comments') != '1') {
                $max_depth = 1;
            }
            wp_list_comments([
                'avatar_size' => 80,
                'style' => 'div',
                'callback' => 'wpc_comment_callback',
                'max_depth' => $max_depth,
            ]);
            ?>
            </div>
            <div class="d-flex justify-content-between">
                <div><?php previous_comments_link(__('Previous Comments', 'wpc')); ?></div>
                <div><?php next_comments_link(__('Next Comments', 'wpc')); ?></div>
            </div>
        </div>
    </div>
</div>
<hr class="invis1">
<?php
}

if (comments_open()) {
    comment_form([
        'class_container' => 'custombox clearfix',
        'title_reply_before' => '<h4 class="small-title">',
        'title_reply_after' => '</h4>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'class_submit' => 'btn btn-primary',
        'fields' => [
            'author' => '<input name="author" type="text" class="form-control" placeholder="'.esc_attr(__('Your name', 'wpc')).'">',
            'email' => '<input name="email" type="text" class="form-control" placeholder="'.esc_attr(__('Email address', 'wpc')).'">',
            'url' => '<input name="url" type="text" class="form-control" placeholder="'.esc_attr(__('Website', 'wpc')).'">',
            'cookies' => '',
        ],
        'comment_field' => '<textarea name="comment" class="form-control" placeholder="'.esc_attr(__('Your comment', 'wpc')).'"></textarea>',
        'class_form' => 'form-wrapper',
    ]);
} else {
    ?>
    <div class="alert alert-info mt-4"><?php _e('Comments are closed', 'wpc'); ?></div>
    <?php
}
echo '<hr class="invis1">';
