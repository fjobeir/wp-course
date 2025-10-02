<?php
/**
 * Template name: Sitemap
 */

get_header();
get_template_part('partials/main-title');
?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-wrapper">
                    <?php 
                    $current_year = (int)(date('Y'));
                    $base_year = 2019;
                    for ($year = $current_year; $year >= $base_year; $year--) {
                        $posts = get_posts([
                            'numberposts' => -1,
                            'post_type' => ['post', 'wpc_ad', 'page'],
                            'exclude' => [get_the_ID()],
                            'date_query' => [
                                [
                                    'year' => $year
                                ]
                            ]
                        ]);
                        if (count($posts)) {
                            ?>
                            <div class="sitemap-wrapper">
                                <span class="year"><?php echo $year; ?></span>
                                <div class="row">
                                    <?php
                                    foreach ($posts as $post) {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">         
                                            <div class="sitemap-text">
                                                <small><?php echo get_the_date('d M, Y', $post->ID) ?></small>
                                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo $post->post_title; ?></a>
                                            </div><!-- end sitemap text -->
                                        </div><!-- end col -->
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<?php
get_footer();
?>