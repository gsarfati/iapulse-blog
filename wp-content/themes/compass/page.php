<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <div class="breadcrumbs"><?php wpzoom_breadcrumbs(); ?></div>

        <header class="entry-header">
            <div class="entry-info">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>

            </div>
        </header><!-- .entry-header -->

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

            <?php if (option::get('comments_page') == 'on') { ?>
                <?php comments_template(); ?>
            <?php } ?>

        <?php endwhile; // end of the loop. ?>

        <?php get_sidebar(); ?>

    </main><!-- #main -->

<?php get_footer(); ?>