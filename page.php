<?php get_header(); ?>

<main>
    <section class="page-content">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
