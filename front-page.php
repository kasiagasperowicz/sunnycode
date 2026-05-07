<?php get_header(); ?>

<main>
  <section class="hero">
    <div class="container hero-inner">
      <h1 class="sunnycode">
        Sunny<span class="sunnycode-c-svg">
          <?php include get_template_directory() . '/assets/images/c-letter.svg'; ?>
        </span>ode
      </h1>

      <p class="sunnycode-paragraph-gray"><?php echo esc_html( pll__( 'slogan' ) ); ?></p>
    </div>
  </section>

  <?php
  $about_title    = get_theme_mod( 'about_title', '' );
  $about_subtitle = get_theme_mod( 'about_subtitle', '' );
  $about_content  = get_theme_mod( 'about_content', '' );
  $about_image_id = get_theme_mod( 'about_image', 0 );

  $about_2_title    = get_theme_mod( 'about_2_title', '' );
  $about_2_subtitle = get_theme_mod( 'about_2_subtitle', '' );
  $about_2_content  = get_theme_mod( 'about_2_content', '' );
  $about_2_image_id = get_theme_mod( 'about_2_image', 0 );
  $parallax_image_id = get_theme_mod( 'parallax_image', 0 );

  $sections = array();

  if ( $about_title || $about_subtitle || $about_content || $about_image_id ) {
      $sections['about_1'] = array(
          'order' => max( 1, min( 3, (int) get_theme_mod( 'home_order_about', 1 ) ) ),
          'html'  => function() use ( $about_title, $about_subtitle, $about_content, $about_image_id ) {
              ?>
              <section class="about-section">
                <div class="container about-inner">
                  <div class="about-text">
                    <?php if ( $about_title ) : ?>
                      <h2 class="about-title"><?php echo esc_html( $about_title ); ?></h2>
                    <?php endif; ?>

                    <?php if ( $about_subtitle ) : ?>
                      <p class="about-subtitle"><?php echo esc_html( $about_subtitle ); ?></p>
                    <?php endif; ?>

                    <?php if ( $about_content ) : ?>
                      <div class="about-content"><?php echo wp_kses_post( $about_content ); ?></div>
                    <?php endif; ?>
                  </div>

                  <?php if ( $about_image_id ) : ?>
                    <div class="about-image">
                      <?php echo wp_get_attachment_image( $about_image_id, 'large', false, array( 'class' => 'about-img', 'loading' => 'lazy' ) ); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </section>
              <?php
          },
      );
  }

  if ( $about_2_title || $about_2_subtitle || $about_2_content || $about_2_image_id ) {
      $sections['about_2'] = array(
          'order' => max( 1, min( 3, (int) get_theme_mod( 'home_order_about_2', 2 ) ) ),
          'html'  => function() use ( $about_2_title, $about_2_subtitle, $about_2_content, $about_2_image_id ) {
              ?>
              <section class="about-section">
                <div class="container about-inner">
                  <div class="about-text">
                    <?php if ( $about_2_title ) : ?>
                      <h2 class="about-title"><?php echo esc_html( $about_2_title ); ?></h2>
                    <?php endif; ?>

                    <?php if ( $about_2_subtitle ) : ?>
                      <p class="about-subtitle"><?php echo esc_html( $about_2_subtitle ); ?></p>
                    <?php endif; ?>

                    <?php if ( $about_2_content ) : ?>
                      <div class="about-content"><?php echo wp_kses_post( $about_2_content ); ?></div>
                    <?php endif; ?>
                  </div>

                  <?php if ( $about_2_image_id ) : ?>
                    <div class="about-image">
                      <?php echo wp_get_attachment_image( $about_2_image_id, 'large', false, array( 'class' => 'about-img', 'loading' => 'lazy' ) ); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </section>
              <?php
          },
      );
  }

  if ( $parallax_image_id ) {
      $sections['parallax'] = array(
          'order' => max( 1, min( 3, (int) get_theme_mod( 'home_order_parallax', 3 ) ) ),
          'html'  => function() use ( $parallax_image_id ) {
              $parallax_url = wp_get_attachment_image_url( $parallax_image_id, 'full' );
              ?>
              <section
                class="parallax-section"
                id="parallax-section"
                aria-hidden="true"
                style="--parallax-bg: url('<?php echo esc_url( $parallax_url ); ?>')"
              >
                <div class="parallax-bg" id="parallax-bg"></div>
              </section>
              <?php
          },
      );
  }

  uasort( $sections, function( $a, $b ) {
      return $a['order'] <=> $b['order'];
  } );

  foreach ( $sections as $section ) {
      $renderer = $section['html'];
      $renderer();
  }
  ?>
</main>

<?php get_footer(); ?>
