<?php 
get_header();
while (have_posts()) {
    the_post();
    $attachment_id = get_the_ID();
    $attachment_meta = wp_get_attachment_metadata($attachment_id);
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
                        <audio controls>
                            <source src="<?php echo wp_get_attachment_url($attachment_id) ?>" type="<?php echo $attachment_meta['mime_type']; ?>">
                        </audio>
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
                    <h4><?php _e('About the file', 'wpc'); ?></h4>
                    <div class="blog-content"><?php the_content(); ?></div>
                    <?php } ?>
                    <!-- Meta //-->
                    <h4><?php _e('File Meta Data', 'wpc'); ?></h4>
                    
                    <table class="table">
                        <?php
                        foreach ($attachment_meta as $key => $value) {
                            $value = ($key == 'filesize') ? size_format($value, 2) : $value;
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