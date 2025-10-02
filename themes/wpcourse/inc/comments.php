<?php


add_filter('comment_form_fields', function ($fields) {
    return [
        'author' => $fields['author'],
        'email' => $fields['email'],
        'url' => $fields['url'],
        'comment' => $fields['comment'],
    ];
});

if (!function_exists('wpc_comment_callback')) {
    function wpc_comment_callback($comment, $args, $depth)
    {
        $tag = $args['style'] == 'div' ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> <?php comment_class('media'); ?> id="comment-<?php echo $comment->comment_ID; ?>">
            <?php if (get_option('show_avatars') == '1') { ?>
            <a class="media-left" href="#">
                <?php echo get_avatar($comment, $args['avatar_size'], false, false, ['class' => 'rounded-circle']) ?>
            </a>
            <?php } ?>
            <div class="media-body" id="comment-body-<?php echo $comment->comment_ID; ?>">
                <h4 class="media-heading user_name">
                <?php echo get_comment_author_link($comment); ?> 
                <small><?php printf(
                    /* translators: %s is a time difference */
                    __('%s ago', 'wpc'),
                    human_time_diff(get_comment_time('U'), current_time('U'))
                ); ?></small></h4>
                <?php
                if ($comment->comment_approved == 0) {
                    echo '<p>'.__('Your comment is awaiting moderation', 'wpc').'</p>';
                }
                comment_text(); 
                comment_reply_link([
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => __('Reply', 'wpc'),
                    'add_below' => 'comment-body',
                ]);
                edit_comment_link(__('Edit Comment', 'wpc'));
                ?>
            </div>
        <?php
    }
}

add_filter('comment_reply_link', function($link) {
    return str_replace("class='", "class='btn btn-primary btn-sm ", $link);
});
if (!function_exists('wpc_comments_pagination_attributes')) {
    add_filter('next_comments_link_attributes', 'wpc_comments_pagination_attributes');
    add_filter('previous_comments_link_attributes', 'wpc_comments_pagination_attributes');
    function wpc_comments_pagination_attributes()
    {
        return 'class="btn btn-primary"';
    }
}

if (!function_exists('wpc_comment_form_additional_fields')) {
    add_action('comment_form_after_fields', 'wpc_comment_form_additional_fields');
    add_action('comment_form_logged_in_after', 'wpc_comment_form_additional_fields');
    function wpc_comment_form_additional_fields()
    {
        echo '<input type="text" class="form-control" placeholder="'.esc_attr(__('Country', 'wpc')).'" name="wpc_commenter_country">';
    }
}

add_filter('preprocess_comment', function($commentdata) {
    if (!isset($_POST['wpc_commenter_country']) || empty($_POST['wpc_commenter_country'])) {
        wp_die(__('Please go back and enter your country', 'wpc'));
    }
    return $commentdata;
});

add_action('comment_post', function($comment_id, $comment_approved) {
    if ($comment_approved != 'spam') {
        update_comment_meta($comment_id, 'wpc_commenter_country', $_POST['wpc_commenter_country']);
    }
}, 10, 2);

if (!function_exists('wpc_commenter_country_field')) {
    function wpc_commenter_country_field($comment)
    {
        ?>
        <p>
            <label for="wpc_commenter_country"><?php _e('Commenter Country', 'wpc') ?></label>
            <input type="text" name="wpc_commenter_country" id="wpc_commenter_country"
            value="<?php echo esc_attr(get_comment_meta($comment->comment_ID, 'wpc_commenter_country', true)); ?>">
        </p>
        <?php
    }
    add_action('add_meta_boxes', function() {
        add_meta_box(
            'wpc_commenter_country_meta_box',
            __('Commenter Country', 'wpc'),
            'wpc_commenter_country_field',
            'comment',
            'normal',
        );
    });
}

add_action('edit_comment', function($comment_id) {
    if (isset($_POST['wpc_commenter_country']) && !empty($_POST['wpc_commenter_country'])) {
        update_comment_meta($comment_id, 'wpc_commenter_country', $_POST['wpc_commenter_country']);
    }
});

add_filter('edit_comment_link', function($link) {
    return str_replace('class="', 'class="btn btn-primary btn-sm ', $link);
});