<?php get_header(); ?>

<main id="main" class="site-main" role="main">

   <h2 class="section-title"><span><?php _e('Search Results for','wpzoom');?> <strong>"<?php the_search_query(); ?>"</strong></span></h2>

    <section class="recent-posts">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php

                get_template_part( 'content', get_post_format() );
                ?>

            <?php endwhile; ?>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .recent-posts -->

    <?php get_sidebar(); ?>

</main><!-- .site-main -->


<?php
get_footer();
