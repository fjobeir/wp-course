<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <?php
        if (is_registered_sidebar('blog-sidebar')) {
            dynamic_sidebar('blog-sidebar');
        }
        ?>
    </div>
</div><!-- end col -->