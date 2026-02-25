<?php
function sunnycode_enqueue_styles() {
    wp_enqueue_style(
        'sunnycode-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );
}


function sunnycode_enqueue_fonts() {

    wp_enqueue_style(
        'sunnycode-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
        array(),
        null
    );

}
add_action('wp_enqueue_scripts', 'sunnycode_enqueue_fonts');

function sunnycode_add_preconnect( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'sunnycode_add_preconnect', 10, 2 );

function sunnycode_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'sunnycode_theme_setup');