<?php 

require 'sidebars.php';
require 'posts_list.php';
require 'search.php';
require 'instagram.php';
require 'categories.php';

add_action('widgets_init', function() {
    register_widget('Wpc_Instagram');
    register_widget('Wpc_Posts_List');
    register_widget('Wpc_Search');
    register_widget('Wpc_Categories');
});