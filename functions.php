<?php

function sunnycode_enqueue_styles() {
    wp_enqueue_style(
        'sunnycode-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'sunnycode_enqueue_styles');