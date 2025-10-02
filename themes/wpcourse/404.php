<?php 

get_header();

get_template_part('partials/main-title');

?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <div class="notfound">   
                        <div class="row">
                            <div class="col-md-8 offset-md-2 text-center">
                                <h2>404</h2>
                                <h3><?php _e('Oh no! Page Not Found', 'wpc'); ?></h3>
                                <p><?php _e("The page you are looking for no longer exists. Perhaps you can return back to the site's homepage and see if you can find what you are looking for. Or, you can try finding it with the information below.", 'wpc'); ?></p>
                                <a href="#" class="btn btn-primary"><?php _e('Back to Home', 'wpc'); ?></a>
                            </div>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php
get_footer();

?>