<?php

if (!function_exists('wpc_create_db_tables')) {
    function wpc_create_db_tables()
    {
        global $wpdb;
        $table_query = 'CREATE TABLE IF NOT EXISTS `'.$wpdb->prefix.'subscribers` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` varchar(40) COLLATE '.$wpdb->collate.' NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `email` (`email`)
          ) ENGINE=MyISAM DEFAULT CHARSET='.$wpdb->charset.' COLLATE='.$wpdb->collate.';';
          require_once ABSPATH . 'wp-admin/includes/upgrade.php';
          dbDelta($table_query);
    }
}