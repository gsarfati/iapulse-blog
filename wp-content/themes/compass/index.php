<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php if ( option::is_on( 'featured_posts_show' ) && is_front_page() && $paged < 2) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<?php if ( is_active_sidebar( 'homepage' ) && is_front_page() && $paged < 2 ) : ?>

    <section class="site-widgetized-section section-top">
        <div class="widgets clearfix <?php echo compass_widgets_count_class( 'homepage' ); ?>">

            <?php dynamic_sidebar( 'homepage' ); ?>

        </div>
    </section><!-- .site-widgetized-section -->

<?php endif; ?>

<main id="main" class="site-main" role="main">

    <section class="recent-posts">

        <h2 class="section-title">
            <span>

                <?php if ( is_front_page() ) : ?>

                    <?php echo esc_html( option::get('recent_title') ); ?>

                <?php else: ?>

                    <?php echo get_the_title( get_option( 'page_for_posts' ) ); ?>

                <?php endif; ?>

            </span>
        </h2>

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', get_post_format() ); ?>

            <?php endwhile; ?>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .recent-posts -->

    <?php get_sidebar(); ?>

</main><!-- .site-main -->


<?php if ( is_active_sidebar( 'widgetized_section' ) && is_front_page() && $paged < 2 ) : ?>

    <section class="site-widgetized-section">
        <div class="widgets clearfix <?php echo compass_widgets_count_class( 'widgetized_section' ); ?>">

            <?php dynamic_sidebar( 'widgetized_section' ); ?>

        </div>
    </section><!-- .site-widgetized-section -->

<?php endif; ?>

<?php
get_footer();
