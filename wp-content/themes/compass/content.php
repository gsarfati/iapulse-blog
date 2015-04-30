<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() ) {
        get_the_image( array( 'size' => 'loop', 'width' => option::get('thumb_width'), 'height' => option::get('thumb_height'), 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );
    } ?>

    <section class="entry-body">
        <header class="entry-header">
            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        </header>

        <div class="entry-meta">
            <?php if ( option::is_on( 'display_author' ) ) { printf( '<span class="entry-author">%s ', __( 'By', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>
            <?php if ( option::is_on( 'display_date' ) )     printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
            <?php if ( option::is_on( 'display_category' ) ) printf( '<span class="cat-links">%s</span>', get_the_category_list( ', ' ) ); ?>
            <?php if ( option::is_on( 'display_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>


            <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
        </div>

        <div class="entry-content">
            <?php if (option::get('display_content') == 'Full Content') {
                the_content(''.__('Read More', 'wpzoom').'');
            }
            if (option::get('display_content') == 'Excerpt')  {
                the_excerpt();
            } ?>
        </div>
    </section>

    <div class="clearfix"></div>
</article><!-- #post-## -->