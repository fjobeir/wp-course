<?php

if (!function_exists('wpc_customize_register')) {
    function wpc_customize_register($wp_customize) {
        // Add section
        $wp_customize->add_section('footer_settings', [
            'title' => __('Footer Settings', 'wpc'),
            'priority' => 115,
        ]);

        // Copyrights
        $wp_customize->add_setting('footer_copy_rights', [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->selective_refresh->add_partial('footer_copy_rights', [
            'selector' => '.copyright',
            'container_inclusive' => false,
            'render_callback' => function() {
                echo esc_html(get_theme_mod('footer_copy_rights', ''));
            }
        ]);
        $wp_customize->add_control('footer_copy_rights', [
            'type' => 'text',
            'section' => 'footer_settings',
            'label' => __('Copyrights Text', 'wpc'),
        ]);

        // Footer Signature
        $wp_customize->add_setting('footer_signature', [
            'default' => '',
            'sanitize_callback' => 'wpc_sanitize_footer_signature',
            'validate_callback' => 'wpc_validate_footer_signature',
            'transport' => 'postMessage',
        ]);
        $wp_customize->add_control('footer_signature', [
            'type' => 'textarea',
            'section' => 'footer_settings',
            'label' => __('Footer Signature', 'wpc'),
        ]);

        // Footer Background
        $wp_customize->add_setting('footer_image', [
            'default' => '',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'footer_image',
            [
                'label' => __('Footer Image', 'wpc'),
                'section' => 'footer_settings',
                'mime_type' => 'image',
            ]
        ));

        // Footer Color
        $wp_customize->add_setting('footer_color', [
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            [
                'label' => __('Footer Color', 'wpc'),
                'section' => 'footer_settings',
            ]
        ));
        // Default Color
        $wp_customize->add_setting('default_color', [
            'default' => 'aqua',
            'sanitize_callback' => function($value) {
                return in_array($value, ['aqua', 'green', 'grey', 'pink', 'red', 'yellow']) ?
                    $value : 'aqua';
            }
        ]);
        $wp_customize->add_control('default_color', [
            'type' => 'select',
            'section' => 'title_tagline',
            'label' => __('Default Color', 'wpc'),
            'choices' => [
                'aqua' => __('Aqua', 'wpc'),
                'green' => __('Green', 'wpc'),
                'grey' => __('Grey', 'wpc'),
                'pink' => __('Pink', 'wpc'),
                'red' => __('Red', 'wpc'),
                'yellow' => __('Yellow', 'wpc'),
            ]
        ]);
    }
    add_action('customize_register', 'wpc_customize_register');
}


add_action('wp_head', function() {
    echo '<style>.footer{';
    $custom_footer_background = get_theme_mod('footer_image', '');
    if (!empty($custom_footer_background)) {
        echo 'background-image:url('.wp_get_attachment_image_url($custom_footer_background, 'full').');';
    }
    $footer_custom_color = get_theme_mod('footer_color', '');
    if (!empty($footer_custom_color)) {
        echo 'background-color:' . $footer_custom_color . ';';
    }
    echo '}</style>';
}, 99);

function wpc_sanitize_footer_signature($footer_signature)
{
    return wp_kses($footer_signature, [
        'a' => [
            'href' => []
        ]
    ]);
}

function wpc_validate_footer_signature($validity, $footer_signature)
{
    if (mb_strlen($footer_signature) > 100) {
        $validity->add('invalid_footer_signature', __('Footer Signature is too long', 'wpc'));
    }
    return $validity;
}



add_action('customize_preview_init', function() {
    wp_enqueue_script('customize_post_message', get_template_directory_uri().'/assets/js/customize.js', [
        'jquery',
        'customize-preview',
    ]);
});