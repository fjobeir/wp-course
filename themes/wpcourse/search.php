<?php 

get_header();
get_template_part('partials/main-title');
?>
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="custombox clearfix mb-4">
                        <h4 class="small-title"><?php _e('Search Summary', 'wpc'); ?></h4>
                        <div class="row">
                            <div class="col"><h6><?php _e('Search Term', 'wpc'); ?>: <?php echo get_search_query(); ?></h6></div>
                            <div class="col"><h6><?php _e('Found Posts', 'wpc'); ?>: <?php echo $wp_query->found_posts; ?></h6></div>
                        </div>
                    </div>
                    <div class="blog-custom-build">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('partials/post-card-big');
                        }
                    }
                    ?>
                    </div>
                </div>
                <?php get_template_part('partials/pagination'); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php
get_footer();
