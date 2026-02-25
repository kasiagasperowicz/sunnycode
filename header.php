
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>

<header class="site-header">
    <div class="container">
        <?php
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
        ?>
        
    </div>
</header>