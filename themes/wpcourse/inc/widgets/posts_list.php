<?php 

if (!class_exists('Wpc_Posts_List')) {
    class Wpc_Posts_List extends WP_Widget
    {
        function __construct() {
            parent::__construct(
                'wpc_posts_list',
                __('WPC Posts List', 'wpc'), 
                [
                    'description' => __('This widget creates a posts list', 'wpc'),
                    'customize_selective_refresh' => true,
                ]
            );
        }

        function widget($args, $instance) {
            echo $args['before_widget'];
            $title = apply_filters('widget_title', $instance['title']);
            if (!empty($title)) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            $options = [];
            if (isset($instance['orderby']) && $instance['orderby'] == 'post_views') {
                $options['orderby'] = 'meta_value_num';
                $options['meta_key'] = 'wpc_post_views';
            } elseif (isset($instance['orderby']) && $instance['orderby'] == 'post_date') {
                $options['orderby'] = 'date';
            }
            if (isset($instance['order'])) {
                $options['order'] = $instance['order'];
            }
            if (isset($instance['posts_count'])) {
                $options['numberposts'] = $instance['posts_count'];
            }
            $popular_posts = get_posts($options);
            if (count($popular_posts)) {
                echo '<div class="blog-list-widget"><div class="list-group">';
                foreach($popular_posts as $post) {
                    ?>
                    <a href="<?php echo get_permalink($post) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <?php echo get_the_post_thumbnail($post, 'thumbnail', ['class' => 'img-fluid float-left']) ?>
                            <h5 class="mb-1"><?php echo $post->post_title; ?></h5>
                            <small>
                            <?php
                            if (isset($instance['alt_content']) && $instance['alt_content'] == 'post_views') {
                                ?><i class="fa fa-eye"></i> <?php echo ((int)(get_post_meta($post->ID, 'wpc_post_views', true))) ?><?php
                            } else {
                                echo get_the_date('d M, Y', $post);
                            }
                            ?>
                            </small>
                        </div>
                    </a>
                    <?php
                }
                echo '</div></div>';
            }
            echo $args['after_widget'];
        }

        function form($instance) {
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = __('Popular Posts', 'wpc');
            }
            if (isset($instance['posts_count'])) {
                $posts_count = $instance['posts_count'];
            } else {
                $posts_count = 4;
            }
            if (isset($instance['alt_content'])) {
                $alt_content = $instance['alt_content'];
            } else {
                $alt_content = 'post_date';
            }
            if (isset($instance['orderby'])) {
                $orderby = $instance['orderby'];
            } else {
                $orderby = 'post_views';
            }
            if (isset($instance['order'])) {
                $order = $instance['order'];
            } else {
                $order = 'desc';
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wpc'); ?></label>
                <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" id="<?php echo $this->get_field_id('title'); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php _e('Posts Count', 'wpc'); ?></label>
                <input type="number" name="<?php echo $this->get_field_name('posts_count'); ?>" value="<?php echo esc_attr($posts_count); ?>" min="1" id="<?php echo $this->get_field_id('posts_count'); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('alt_content'); ?>"><?php _e('Alt Content', 'wpc'); ?></label>
                <select name="<?php echo $this->get_field_name('alt_content') ?>" id="<?php echo $this->get_field_id('alt_content'); ?>">
                    <option value="post_date" <?php echo ($alt_content == 'post_date') ? 'selected' : ''; ?>><?php _e('Post date', 'wpc'); ?></option>
                    <option value="post_views" <?php echo ($alt_content == 'post_views') ? 'selected' : ''; ?>><?php _e('Post views', 'wpc'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By', 'wpc'); ?></label>
                <select name="<?php echo $this->get_field_name('orderby') ?>" id="<?php echo $this->get_field_id('orderby'); ?>">
                    <option value="post_date" <?php echo ($orderby == 'post_date') ? 'selected' : ''; ?>><?php _e('Post date', 'wpc'); ?></option>
                    <option value="post_views" <?php echo ($orderby == 'post_views') ? 'selected' : ''; ?>><?php _e('Post views', 'wpc'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'wpc'); ?></label>
                <select name="<?php echo $this->get_field_name('order') ?>" id="<?php echo $this->get_field_id('order'); ?>">
                    <option value="desc" <?php echo ($order == 'desc') ? 'selected' : ''; ?>><?php _e('DESC', 'wpc'); ?></option>
                    <option value="asc" <?php echo ($order == 'asc') ? 'selected' : ''; ?>><?php _e('ASC', 'wpc'); ?></option>
                </select>
            </p>
            <?php
        }

        function update($new_instance, $old_instance) {
            $new_data = [];
            $new_data['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
            $new_data['posts_count'] = (isset($new_instance['posts_count']) && is_numeric($new_instance['posts_count'])
                && $new_instance['posts_count'] > 0) ? ((int)($new_instance['posts_count'])) : $old_instance['posts_count'];
            $new_data['alt_content'] = (in_array($new_instance['alt_content'], ['post_views', 'post_date'])) ? $new_instance['alt_content'] : $old_instance['alt_content'];
            $new_data['orderby'] = (in_array($new_instance['orderby'], ['post_views', 'post_date'])) ? $new_instance['orderby'] : $old_instance['orderby'];
            $new_data['order'] = (in_array($new_instance['order'], ['desc', 'asc'])) ? $new_instance['order'] : $old_instance['order'];
            return $new_data;                
        }
    }
}
