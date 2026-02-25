<?php
function sunnycode_enqueue_styles() {
    wp_enqueue_style(
        'sunnycode-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );
}
add_action('wp_enqueue_scripts', 'sunnycode_enqueue_styles');