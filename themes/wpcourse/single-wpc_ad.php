<?php

$post_id = get_the_ID();

$post_meta = get_post_meta($post_id);
$visits_count = ((int)($post_meta['wpc_post_views'][0])) + 1;
update_post_meta($post_id, 'wpc_post_views', $visits_count);
$post_link = get_permalink($post_id);
get_header();
while(have_posts()) {
    the_post();
?>
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area">
                        <?php 
                        get_template_part('partials/single/breadcrumb');
                        $categories = get_the_terms($post_id, 'wpc_ad_group');
                        if (is_array($categories)) {
                            foreach($categories as $category) {
                                echo '<span class="color-'.wpc_get_term_color($category->term_id).'"><a href="'.get_term_link($category).'" title="">'.$category->name.'</a></span>';
                            }
                        }
                        get_template_part('partials/single/title');
                        get_template_part('partials/single/post_meta');
                        get_template_part('partials/single/share');
                        ?>
                    </div>
                    <?php
                    get_template_part('partials/single/post_thumbnail');
                    get_template_part('partials/single/post_content');
                    if (!empty($post_meta['wpc_ad_url'][0])) {
                        echo '<h4><a href="'.esc_url($post_meta['wpc_ad_url'][0]).'">'.__('Click Here', 'wpc').'</a></h4>';
                    }
                    ?>
                    <div class="blog-title-area">
                        <?php get_template_part('partials/single/share'); ?>
                    </div><!-- end title -->
                    <hr class="invis1">
                    <?php get_template_part('partials/single/author'); ?>
                    <?php comments_template(); ?>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php
}
get_footer();
?>