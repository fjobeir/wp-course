<?php 
get_header();
get_template_part('partials/main-title');
?>
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
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
