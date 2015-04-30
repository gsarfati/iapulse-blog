<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

    <div class="breadcrumbs"><?php wpzoom_breadcrumbs(); ?></div>

        <?php while ( have_posts() ) : the_post(); ?>

            <header class="entry-header">

                <div class="entry-info">

                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <?php if ( option::is_on( 'post_share' ) ) : ?>

                        <div class="share">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php esc_attr_e( 'Tweet this on Twitter', 'wpzoom' ); ?>" class="twitter"><?php echo esc_html( option::get( 'post_share_label_twitter' ) ); ?></a>

                            <a href="https://facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php esc_attr_e( 'Share this on Facebook', 'wpzoom' ); ?>" class="facebook"><?php echo esc_html( option::get( 'post_share_label_facebook' ) ); ?></a>

                            <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank" title="<?php esc_attr_e( 'Post this to Google+', 'wpzoom' ); ?>" class="gplus"><?php echo esc_html( option::get( 'post_share_label_gplus' ) ); ?></a>
                            <div class="clear"></div>
                        </div>

                    <?php endif; ?>


                    <div class="entry-meta">
                        <?php if ( option::is_on( 'display_author' ) )   { printf( '<span class="entry-author">%s ', __( 'By', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>

                        <?php if ( option::is_on( 'post_date' ) )     : ?><span class="entry-date"><?php _e( 'on', 'wpzoom' ); ?> <?php printf( '<time class="entry-date" datetime="%1$s">%2$s</time> ', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?></span> <?php endif; ?>

                        <?php if ( option::is_on( 'post_category' ) ) : ?><span class="entry-category"><?php _e( 'in', 'wpzoom' ); ?> <?php the_category( ', ' ); ?></span><?php endif; ?>
                         <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>

                    <div class="clear"></div>

                </div>

            </header><!-- .entry-header -->


            <div class="recent-posts">

                <?php get_template_part( 'content', 'single' ); ?>

                <?php if (option::get('post_comments') == 'on') : ?>

                    <?php comments_template(); ?>

                <?php endif; ?>

            </div>

        <?php endwhile; // end of the loop. ?>

        <?php get_sidebar(); ?>

    </main><!-- #main -->

<?php get_footer(); ?>