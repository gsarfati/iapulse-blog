<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
        <?php the_content(); ?>

        <div class="clear"></div>

        <?php if ( option::is_on( 'post_tags' ) ) : ?>

            <?php the_tags( '<div class="tag_list">' . __( 'Tags:', 'wpzoom' ). ' ', ' ',  '</div>'  ); ?>

        <?php endif; ?>
    </div><!-- .entry-content -->


    <footer class="entry-footer">

        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'wpzoom' ),
            'after'  => '</div>',
        ) );
        ?>


        <?php if ( option::is_on( 'post_author_box' ) ) : ?>

            <div class="post_author clearfix">

                <?php echo get_avatar( get_the_author_meta( 'ID' ) , 65 ); ?>

                <div class="author-description">
                    <h3 class="author-title"><?php _e( 'Written by', 'wpzoom' ); ?> <?php the_author_posts_link(); ?></h3>

                    <p class="author-bio">
                        <?php the_author_meta( 'description' ); ?>
                    </p>
                </div>

            </div>

        <?php endif; ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
