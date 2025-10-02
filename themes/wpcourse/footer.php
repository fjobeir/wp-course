    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <?php dynamic_sidebar('footer-area'); ?>
                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <?php dynamic_sidebar('footer-area-2'); ?>
                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <?php dynamic_sidebar('footer-area-3'); ?>
                </div><!-- end col -->
            </div><!-- end row -->

            <hr class="invis1">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="widget">
                        <div class="footer-text text-center">
                            <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            }
                            ?>
                            <p class="footer_signature"><?php echo esc_html(get_theme_mod('footer_signature', '')); ?></p>
                            <div class="social">
                            <?php get_template_part('partials/site-social-links'); ?>
                            </div>

                            <hr class="invis">

                            <div class="newsletter-widget text-center">
                                <form class="form-inline ajax-form">
                                    <input type="hidden" name="action" value="new_subscriber">
                                    <input type="email" required name="subscriber_email" class="form-control" placeholder="<?php _e('Enter your email address', 'wpc') ?>">
                                    <button type="submit" class="btn btn-primary"><?php _e('Subscribe', 'wpc'); ?> <i class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div><!-- end newsletter -->
                        </div><!-- end footer-text -->
                    </div><!-- end widget -->
                </div><!-- end col -->
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <div class="copyright"><?php echo esc_html(get_theme_mod('footer_copy_rights', '')); ?></div>
                </div>
            </div>
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="dmtop"></div>
    
</div><!-- end wrapper -->
    <?php wp_footer(); ?>
</body>
</html>