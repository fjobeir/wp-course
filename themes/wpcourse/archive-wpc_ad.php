<?php 

get_header();

get_template_part('partials/main-title');

if (have_posts()) { ?>
<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    
                    <?php 
                    while(have_posts()) {
                        the_post();
                        get_template_part('partials/post-card', 'wide');
                    }
                    ?>
                    
                </div><!-- end page-wrapper -->

                <hr class="invis">
                <?php get_template_part('partials/pagination'); ?>
            </div><!-- end col -->
            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php } else {
    _e('No posts found', 'wpc');
}
?>
<?php

get_footer();

?>