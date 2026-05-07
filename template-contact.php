<?php
/**
 * Template Name: Contact
 */

get_header();

$title    = get_theme_mod( 'contact_intro_title', '' );
$subtitle = get_theme_mod( 'contact_intro_subtitle', '' );
$content  = get_theme_mod( 'contact_intro_content', '' );
$image_id = get_theme_mod( 'contact_intro_image', 0 );
?>

<main>

    <?php if ( $title || $subtitle || $content || $image_id ) : ?>
    <section class="about-section">
        <div class="container about-inner">

            <div class="about-text">
                <?php if ( $title ) : ?>
                    <h2 class="about-title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( $subtitle ) : ?>
                    <p class="about-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>

                <?php if ( $content ) : ?>
                    <div class="about-content"><?php echo wp_kses_post( $content ); ?></div>
                <?php endif; ?>
            </div>

            <?php if ( $image_id ) : ?>
                <div class="about-image">
                    <?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'about-img', 'loading' => 'lazy' ) ); ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

    <section class="page-content">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
