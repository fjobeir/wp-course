<div <?php post_class('pitem item-w1 item-h1'); ?>>
    <div class="blog-box">
        <?php
        if (has_block('core/video')) {
            wpc_print_first_block_instance('core/video');
        } else {
            $post_blocks = parse_blocks(get_the_content());
            foreach ($post_blocks as $block) {
                if ($block['blockName'] == 'core/embed') {
                    if (isset($block['attrs']['type'])) {
                        if ($block['attrs']['type'] == 'video') {
                            echo apply_filters('the_content', render_block($block));
                            break;
                        }
                    }
                }
            }
        }
        ?>
    </div><!-- end blog-box -->
</div><!-- end col -->