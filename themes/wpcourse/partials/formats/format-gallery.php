<div <?php post_class('pitem item-w1 item-h1'); ?>>
    <div class="blog-box">
        <?php
        if (has_block('core/gallery')) {
            $post_blocks = parse_blocks(get_the_content());
            foreach ($post_blocks as $block) {
                if ($block['blockName'] === 'core/gallery') {
                    $gallery_id = 'gallery_' . uniqid();
                    $images = $indicators = '';
                    $ids = $block['attrs']['ids'];
                    for ($i = 0; $i < count($ids); $i++) {
                        $active = ($i === 0) ? 'active' : '';
                        $images .= '<div class="carousel-item '.$active.'">
                        <img class="d-block img-fluid" src="'.wp_get_attachment_image_url($ids[$i], '533x261').'">
                    </div>';
                        $indicators .= '<li data-target="#'.$gallery_id.'" data-slide-to="'.$i.'" class="'.$active.'"></li>';
                    }
                    ?>
                    <div id="<?php echo $gallery_id; ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php echo $images; ?>
                        </div>
                        <ol class="carousel-indicators">
                            <?php echo $indicators; ?>
                        </ol>
                    </div>
                    <?php
                    break;
                }
            }
        }
        
        ?>
    </div><!-- end blog-box -->
</div><!-- end col -->