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
                    <?php
                    $sections = get_option('wpc_post_options', []);
                    ?>
                    <div class="blog-title-area">
                    <?php 
                    foreach (['breadcrumb', 'categories', 'title', 'post_meta', 'share_top'] as $section) {
                        if ($sections[$section]['show'] == 1) {
                            get_template_part('partials/single/' . $sections[$section]['file']);
                        }
                    }
                    ?>
                    </div>
                    <?php 
                    foreach (['post_thumbnail', 'post_content'] as $section) {
                        if ($sections[$section]['show'] == 1) {
                            get_template_part('partials/single/' . $sections[$section]['file']);
                        }
                    }
                    get_template_part('partials/single/link_pages');
                    ?>
                    <div class="blog-title-area">
                    <?php 
                    foreach (['tags', 'share_bottom'] as $section) {
                        if ($sections[$section]['show'] == 1) {
                            get_template_part('partials/single/' . $sections[$section]['file']);
                        }
                    }
                    ?>
                    </div>
                    <?php 
                    foreach (['next_previous', 'author', 'related_posts'] as $section) {
                        if ($sections[$section]['show'] == 1) {
                            get_template_part('partials/single/' . $sections[$section]['file']);
                        }
                    }
                    ?>

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