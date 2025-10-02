<div class="custombox authorbox clearfix">
    <h4 class="small-title"><?php _e('About author', 'wpc'); ?></h4>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?php echo get_avatar(get_the_author_meta('ID'), 90, false, false, ['class' => 'img-fluid rounded-circle']) ?>
        </div><!-- end col -->

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h4><?php the_author_link(); ?></h4>
            <p><?php echo get_the_author_meta('description'); ?></p>

            <div class="topsocial">
            <?php
            $networks = ['facebook', 'twitter', 'instagram', 'youtube', 'pinterest'];
            foreach ($networks as $network) {
                $link = get_the_author_meta('wpc_' . $network . '_link');
                if (!empty($link)) {
                    echo '<a href="'.esc_url($link).'" data-toggle="tooltip" data-placement="bottom" title="'.ucfirst($network).'"><i class="fa fa-'.$network.'"></i></a>';
                }
            }
            $author_url = get_the_author_meta('url');
            if (!empty($author_url)) {
                echo '<a href="'.esc_url($author_url).'" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>';
            }
            ?>
            
            </div><!-- end social -->

        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end author-box -->

<hr class="invis1">
