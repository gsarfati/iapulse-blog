<?php
$featured = new WP_Query( array(
    'showposts'    => option::get( 'slideshow_posts' ),
    'post__not_in' => get_option( 'sticky_posts' ),
    'meta_key'     => 'wpzoom_is_featured',
    'meta_value'   => 1,
) );

$image_args = array(
    'link_to_post' => false,
    'size'         => 'featured',
    'height'       => 450,
);
?>

<div id="slider">

	<?php if ( $featured->have_posts() ) : ?>

		<ul class="slides clearfix">

			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?><!-- fix inline-block
                --><li class="slide">
                    <?php get_the_image( $image_args ); ?>

                    <div class="slide-overlay">

                        <div class="slide-header">

                            <?php the_title( sprintf( '<h3><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

                            <div class="entry-meta">
                                <?php if ( option::is_on( 'slider_date' ) )     printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
                                <?php if ( option::is_on( 'slider_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>
                            </div>

                        </div>

                    </div>
                </li><!-- fix-inline block
			--><?php endwhile; ?>

		</ul>

	<?php else: ?>

		<div class="empty-slider">
			<p><strong><?php _e( 'You are now ready to set-up your Slideshow content.', 'wpzoom' ); ?></strong></p>

			<p>
				<?php
				printf(
					__( 'For more information about adding posts to the slider, please <a href="%1$s">read the documentation</a>', 'wpzoom' ),
					'http://www.wpzoom.com/documentation/compass/'
				);
				?>
			</p>
		</div>

	<?php endif; ?>

</div>