
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
        <?php
        if (function_exists('pll_the_languages')) {
            $languages = pll_the_languages([
                'raw' => 1,
            ]);

            if (!empty($languages)) {
                echo '<div class="lang-switcher">';
                foreach ($languages as $lang) {
                    $active = $lang['current_lang'] ? ' is-active' : '';
                    echo '<a class="lang-link' . $active . '" href="' . esc_url($lang['url']) . '">';
                    echo esc_html(strtoupper($lang['slug']));
                    echo '</a>';
                }
                echo '</div>';
            }
        }
        ?>
       
        
    </div>
</header>