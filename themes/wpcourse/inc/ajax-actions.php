<?php

if (!function_exists('wpc_new_subscriber')) {
    function wpc_new_subscriber()
    {
        $response = [
            'done' => false,
            'message' => ''
        ];
        if (isset($_POST['subscriber_email'])) {
            if (is_email($_POST['subscriber_email'])) {
                global $wpdb;
                if ($wpdb->insert(
                    $wpdb->prefix . 'subscribers',
                    [
                        'email' => $_POST['subscriber_email']
                    ],
                    [
                        '%s'
                    ]
                )) {
                    $response['done'] = true;
                    $response['message'] = __('Thank you for subscribing', 'wpc');
                } else {
                    $response['message'] = __('You are already subscribed to our newsletter', 'wpc');
                }
            } else {
                $response['message'] = __('Please provide a valid email', 'wpc');
            }
        } else {
            $response['message'] = __('Please provide an email', 'wpc');
        }
        wp_send_json($response);
    }
    add_action('wp_ajax_new_subscriber', 'wpc_new_subscriber');
    add_action('wp_ajax_nopriv_new_subscriber', 'wpc_new_subscriber');
}