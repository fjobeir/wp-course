<?php 
get_header();
while (have_posts()) {
    the_post();
    $attachment_id = get_the_ID();
?>

<?php get_template_part('partials/main-title'); ?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <!-- Title //-->
                    <div class="blog-title-area">
                        <h3><?php the_title(); ?></h3>
                        <?php get_template_part('partials/single/share', null, ['post_link' => get_permalink()]); ?>
                    </div>
                    <!-- Attachment Picture //-->
                    <div class="single-post-media">
                        <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                    </div>
                    <!-- Caption //-->
                    <?php
                    $attachment_caption = wp_get_attachment_caption($attachment_id);
                    if (!empty($attachment_caption)) {
                    ?>
                    <h4><?php _e('What is this', 'wpc'); ?></h4>
                    <p><?php echo $attachment_caption; ?></p>
                    <?php } ?>
                    <!-- Description //-->
                    <?php if(!empty(get_the_content())) { ?>
                    <h4><?php _e('About the picture', 'wpc') ?></h4>
                    <div class="blog-content"><?php the_content(); ?></div>
                    <?php } ?>
                    <!-- Meta //-->
                    <h4><?php _e('Picture Information', 'wpc'); ?></h4>
                    <?php $attachment_meta = wp_get_attachment_metadata($attachment_id); ?>
                    <table class="table">
                        <tr>
                            <td><?php _e('Dimension', 'wpc'); ?></td>
                            <td><?php echo $attachment_meta['width'] . 'x' . $attachment_meta['height']; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Size', 'wpc'); ?></td>
                            <td><?php echo size_format(filesize(get_attached_file($attachment_id)), 2); ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Thumbnails', 'wpc'); ?></td>
                            <td>
                                <?php
                                foreach ($attachment_meta['sizes'] as $size => $info) {
                                    echo '<p>'.__(ucwords(str_replace('_', ' ', $size)), 'wpc').' :'.$info['width'].'x'.$info['height'].'</p>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        foreach ($attachment_meta['image_meta'] as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . __(ucwords(str_replace('_', ' ', $key)), 'wpc') . '</td>';
                            echo '<td>' . $value . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
get_footer();
?>