<?php

add_filter('upload_mimes', function($mime_types) {
    $current_user = wp_get_current_user();
    if (in_array('company', $current_user->roles)) {
        return [
            'jpg|jpeg|jpe' => 'image/jpeg',
            'png' => 'image/png',
        ];
    }
    return $mime_types;
});