<?php

$links = get_option('wpc_social_options');
if (is_array($links)) {
    foreach ($links as $network => $link) {
        if (!empty($link)) {
            ?>
            <a href="<?php echo esc_url($link); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr(ucfirst($network)); ?>">
                <i class="fa fa-<?php echo esc_attr($network); ?>"></i>
            </a>
            <?php
        }
    }
}