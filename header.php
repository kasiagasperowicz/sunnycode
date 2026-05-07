
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>

<header class="site-header">
    <div class="container top-container">
         <?php
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
        ?>

        <nav class="site-nav" id="site-nav" aria-label="Menu główne">
            <?php
            $menu_location = 'primary';
            $current_lang  = '';

            if ( function_exists( 'pll_languages_list' ) ) {
                $languages     = pll_languages_list( array( 'fields' => 'slug' ) );
                $request_uri   = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
                $request_path  = trim( (string) parse_url( $request_uri, PHP_URL_PATH ), '/' );
                $path_parts    = explode( '/', $request_path );
                $first_segment = isset( $path_parts[0] ) ? $path_parts[0] : '';

                if ( in_array( $first_segment, $languages, true ) ) {
                    $current_lang = $first_segment;
                } elseif ( function_exists( 'pll_current_language' ) ) {
                    $current_lang = pll_current_language( 'slug' );
                }
            } elseif ( function_exists( 'pll_current_language' ) ) {
                $current_lang = pll_current_language( 'slug' );
            }

            if ( 'en' === $current_lang ) {
                $menu_location = has_nav_menu( 'primary_en' ) ? 'primary_en' : 'primary';
            } elseif ( 'pl' === $current_lang ) {
                $menu_location = has_nav_menu( 'primary_pl' ) ? 'primary_pl' : 'primary';
            }

            wp_nav_menu( array(
                'theme_location' => $menu_location,
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => 'wp_page_menu',
            ) );
            ?>
        </nav>

        <div class="header-right">
            <?php
            if ( function_exists( 'pll_languages_list' ) ) {
                $lang_slugs = pll_languages_list( array( 'fields' => 'slug' ) );

                if ( ! empty( $lang_slugs ) ) {
                    $queried_id = get_queried_object_id();
                    $request_uri  = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
                    $request_path = trim( (string) parse_url( $request_uri, PHP_URL_PATH ), '/' );
                    $is_lang_root = in_array( $request_path, $lang_slugs, true );

                    echo '<div class="lang-switcher">';

                    foreach ( $lang_slugs as $lang_slug ) {
                        $lang_url = function_exists( 'pll_home_url' )
                            ? pll_home_url( $lang_slug )
                            : home_url( '/' . $lang_slug . '/' );

                        if ( ! $is_lang_root && is_singular() && $queried_id && function_exists( 'pll_get_post' ) ) {
                            $translated_post_id = pll_get_post( $queried_id, $lang_slug );
                            if ( $translated_post_id ) {
                                $lang_url = get_permalink( $translated_post_id );
                            }
                        }

                        $active = ( $current_lang === $lang_slug ) ? ' is-active' : '';
                        echo '<a class="lang-link' . esc_attr( $active ) . '" href="' . esc_url( $lang_url ) . '">';
                        echo esc_html( strtoupper( $lang_slug ) );
                        echo '</a>';
                    }

                    echo '</div>';
                }
            }
            ?>

            <button class="hamburger" id="hamburger" aria-controls="site-nav" aria-expanded="false" aria-label="Otwórz menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
       
    </div>
</header>