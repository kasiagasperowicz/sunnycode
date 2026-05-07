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
        'unlink-homepage-logo' => false,
    ));
    register_nav_menus( array(
        'primary'    => __( 'Menu główne (fallback)', 'sunnycode' ),
        'primary_pl' => __( 'Menu główne PL', 'sunnycode' ),
        'primary_en' => __( 'Menu główne EN', 'sunnycode' ),
    ) );
}
add_action('after_setup_theme', 'sunnycode_theme_setup');

function sunnycode_enqueue_scripts() {
    wp_enqueue_script(
        'sunnycode-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'sunnycode_enqueue_scripts' );


add_action('init', function() {
    if (function_exists('pll_register_string')) {
        pll_register_string(
            'Hero Tagline', 
            'slogan',
            'Theme'
        );
    }
});

/**
 * Sekcja "O nas" — ustawienia Customizera
 */
add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'sunnycode_about_section', array(
        'title'    => __( 'Sekcja: O nas (Homepage)', 'sunnycode' ),
        'priority' => 30,
    ) );

    // Tytuł
    $wp_customize->add_setting( 'about_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_title', array(
        'label'   => __( 'Tytuł', 'sunnycode' ),
        'section' => 'sunnycode_about_section',
        'type'    => 'text',
    ) );

    // Podtytuł
    $wp_customize->add_setting( 'about_subtitle', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_subtitle', array(
        'label'   => __( 'Podtytuł', 'sunnycode' ),
        'section' => 'sunnycode_about_section',
        'type'    => 'text',
    ) );

    // Treść
    $wp_customize->add_setting( 'about_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_content', array(
        'label'   => __( 'Treść', 'sunnycode' ),
        'section' => 'sunnycode_about_section',
        'type'    => 'textarea',
    ) );

    // Zdjęcie
    $wp_customize->add_setting( 'about_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'about_image', array(
        'label'     => __( 'Zdjęcie', 'sunnycode' ),
        'section'   => 'sunnycode_about_section',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'home_order_about', array(
        'default'           => 1,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'home_order_about', array(
        'label'       => __( 'Kolejność sekcji (1-3)', 'sunnycode' ),
        'description' => __( 'Ustaw pozycję tej sekcji na homepage.', 'sunnycode' ),
        'section'     => 'sunnycode_about_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 3,
            'step' => 1,
        ),
    ) );

    // ── Druga sekcja na homepage (jak "O nas") ────────────────

    $wp_customize->add_section( 'sunnycode_about_section_2', array(
        'title'    => __( 'Sekcja: O nas 2 (Homepage)', 'sunnycode' ),
        'priority' => 31,
    ) );

    $wp_customize->add_setting( 'about_2_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_2_title', array(
        'label'   => __( 'Tytuł', 'sunnycode' ),
        'section' => 'sunnycode_about_section_2',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'about_2_subtitle', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_2_subtitle', array(
        'label'   => __( 'Podtytuł', 'sunnycode' ),
        'section' => 'sunnycode_about_section_2',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'about_2_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'about_2_content', array(
        'label'   => __( 'Treść', 'sunnycode' ),
        'section' => 'sunnycode_about_section_2',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'about_2_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'about_2_image', array(
        'label'     => __( 'Zdjęcie', 'sunnycode' ),
        'section'   => 'sunnycode_about_section_2',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'home_order_about_2', array(
        'default'           => 2,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'home_order_about_2', array(
        'label'       => __( 'Kolejność sekcji (1-3)', 'sunnycode' ),
        'description' => __( 'Ustaw pozycję tej sekcji na homepage.', 'sunnycode' ),
        'section'     => 'sunnycode_about_section_2',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 3,
            'step' => 1,
        ),
    ) );

    // ── Sekcja intro na podstronie Contact ──────────────────────

    $wp_customize->add_section( 'sunnycode_contact_section', array(
        'title'    => __( 'Sekcja: Intro (Contact)', 'sunnycode' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'contact_intro_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'contact_intro_title', array(
        'label'   => __( 'Tytuł', 'sunnycode' ),
        'section' => 'sunnycode_contact_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'contact_intro_subtitle', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'contact_intro_subtitle', array(
        'label'   => __( 'Podtytuł', 'sunnycode' ),
        'section' => 'sunnycode_contact_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'contact_intro_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'contact_intro_content', array(
        'label'   => __( 'Treść', 'sunnycode' ),
        'section' => 'sunnycode_contact_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'contact_intro_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'contact_intro_image', array(
        'label'     => __( 'Zdjęcie', 'sunnycode' ),
        'section'   => 'sunnycode_contact_section',
        'mime_type' => 'image',
    ) ) );

    // ── Sekcja parallax ─────────────────────────────────────────

    $wp_customize->add_section( 'sunnycode_parallax_section', array(
        'title'    => __( 'Sekcja: Parallax (Homepage)', 'sunnycode' ),
        'priority' => 32,
    ) );

    $wp_customize->add_setting( 'parallax_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'parallax_image', array(
        'label'     => __( 'Zdjęcie tła', 'sunnycode' ),
        'section'   => 'sunnycode_parallax_section',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'home_order_parallax', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'home_order_parallax', array(
        'label'       => __( 'Kolejność sekcji (1-3)', 'sunnycode' ),
        'description' => __( 'Ustaw pozycję tej sekcji na homepage.', 'sunnycode' ),
        'section'     => 'sunnycode_parallax_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 3,
            'step' => 1,
        ),
    ) );

} );

/**
 * Wymusza homepage template dla adresu root języka (np. /pl/),
 * nawet jeśli przez przypadek przypisano tam inny szablon strony.
 */
add_filter( 'template_include', function( $template ) {
    if ( is_admin() ) {
        return $template;
    }

    if ( ! function_exists( 'pll_languages_list' ) ) {
        return $template;
    }

    $request_path = trim( (string) parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    $languages    = pll_languages_list( array( 'fields' => 'slug' ) );

    if ( in_array( $request_path, $languages, true ) ) {
        $front_template = get_stylesheet_directory() . '/front-page.php';
        if ( file_exists( $front_template ) ) {
            return $front_template;
        }
    }

    return $template;
}, 99 );

/**
 * Gdy używamy jednego menu jako fallback, podmienia URL i tytuły pozycji
 * na odpowiedniki w aktualnym języku (PL/EN).
 */
add_filter( 'wp_nav_menu_objects', function( $items, $args ) {
    if ( ! function_exists( 'pll_languages_list' ) || ! function_exists( 'pll_get_post' ) ) {
        return $items;
    }

    if ( empty( $args->theme_location ) || ! in_array( $args->theme_location, array( 'primary', 'primary_pl', 'primary_en' ), true ) ) {
        return $items;
    }

    $lang_slugs   = pll_languages_list( array( 'fields' => 'slug' ) );
    $request_uri  = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
    $request_path = trim( (string) parse_url( $request_uri, PHP_URL_PATH ), '/' );
    $path_parts   = explode( '/', $request_path );
    $first_part   = isset( $path_parts[0] ) ? $path_parts[0] : '';

    $current_lang = in_array( $first_part, $lang_slugs, true )
        ? $first_part
        : ( function_exists( 'pll_current_language' ) ? pll_current_language( 'slug' ) : '' );

    if ( ! $current_lang ) {
        return $items;
    }

    foreach ( $items as $item ) {
        if ( isset( $item->type ) && 'post_type' === $item->type && ! empty( $item->object_id ) ) {
            $translated_id = pll_get_post( (int) $item->object_id, $current_lang );
            if ( $translated_id ) {
                $item->object_id = $translated_id;
                $item->url       = get_permalink( $translated_id );
                $item->title     = get_the_title( $translated_id );
            }
        }
    }

    return $items;
}, 10, 2 );
