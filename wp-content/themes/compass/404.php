<?php get_header(); ?>

<main id="main" class="site-main" role="main">

    <h2 class="section-title"><span><?php _e( 'Error 404', 'wpzoom' ); ?></span></h2>

    <section class="recent-posts">

        <?php get_template_part( 'content', 'none' ); ?>

    </section><!-- .recent-posts -->

    <?php get_sidebar(); ?>

</main><!-- .site-main -->

<?php
get_footer();
