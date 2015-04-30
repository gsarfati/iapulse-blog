<?php
/**
 * Custom template tags.
 */


/* Comments Custom Template
==================================== */


if ( ! function_exists( 'compass_comment' ) ) :

	function compass_comment( $comment, $args, $depth ) {
	    $GLOBALS['comment'] = $comment;
	    switch ( $comment->comment_type ) :
	        case '' :
	            ?>
	            <li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">
	            <div id="comment-<?php comment_ID(); ?>">

	                <?php echo get_avatar( $comment, 72 ); ?>

	                <div class="comment-main">
	                    <div class="comment-author vcard">
	                        <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

	                        <div class="comment-meta commentmetadata"><a
	                                href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
	                                <?php printf( __( '%s at %s', 'wpzoom' ), get_comment_date(), get_comment_time() ); ?></a>
	                                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply', 'before' => '&nbsp;&middot;&nbsp;&nbsp;' ) ) ); ?>
	                                <?php edit_comment_link( __( 'Edit', 'wpzoom' ), '&nbsp;&middot;&nbsp;&nbsp;' ); ?>

	                        </div>
	                        <!-- .comment-meta .commentmetadata -->
	                    </div>
	                    <!-- .comment-author .vcard -->

	                    <?php if ( $comment->comment_approved == '0' ) : ?>
	                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpzoom' ); ?></em>
	                        <br/>
	                    <?php endif; ?>

	                    <div class="comment-body"><?php comment_text(); ?></div>
	                </div>

	            </div><!-- #comment-##  -->

	            <?php
	            break;
	        case 'pingback'  :
	        case 'trackback' :
	            ?>
	            <li class="post pingback">
	            <p><?php _e( 'Pingback:', 'wpzoom' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wpzoom' ), ' ' ); ?></p>
	            <?php
	            break;
	    endswitch;
	}

endif;



/* Breadcrumbs
=========================================== */

function wpzoom_breadcrumbs() {

    $delimiter = '&raquo;';
    $name = __( 'Home', 'wpzoom' ); //text for the 'Home' link
    $currentBefore = '<span class="current">';
    $currentAfter = '</span>';

    global $post;
    $home = home_url();


    if ( is_home()  ) {

        echo $currentBefore . '';
        echo '<a href="' . $home . '">' . $name . '</a> ';
        echo '' . $currentAfter;

    }

    if ( is_front_page() ) {

        echo $currentBefore . '';
        echo '<a href="' . $home . '">' . get_the_title() . '</a> ';
        echo '' . $currentAfter;

    }

    if ( is_category() ) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category( $thisCat );
        $parentCat = get_category( $thisCat->parent );
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        if ( $thisCat->parent != 0 ) echo(get_category_parents( $parentCat, true, ' ' . $delimiter . ' ' ));
        echo $currentBefore . '';
        single_cat_title();
        echo '' . $currentAfter;

    } elseif ( is_day() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
        echo $currentBefore . get_the_time( 'd' ) . $currentAfter;

    } elseif ( is_month() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
        echo $currentBefore . get_the_time( 'F' ) . $currentAfter;

    } elseif ( is_year() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore . get_the_time( 'Y' ) . $currentAfter;

    } elseif ( is_singular( 'post' ) ) {
        if ( !is_attachment() ) {
            $cat = get_the_category();
            $cat = $cat[0];
            if ( $cat ) {
                echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
                echo $currentBefore;
                echo $cat->cat_name;
                echo $currentAfter;
            }
        }

    } elseif ( is_page() && !is_front_page() && !$post->post_parent ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore;
        the_title();
        echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ( $parent_id ) {
            $page = get_page( $parent_id );
            $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse( $breadcrumbs );
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        foreach ( $breadcrumbs as $crumb ) echo $crumb . ' ' . $delimiter . ' ';
        echo $currentBefore;
        the_title();
        echo $currentAfter;

    } elseif ( is_search() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore . __( 'Search results for &#39;', 'wpzoom' ) . get_search_query() . '&#39;' . $currentAfter;

    } elseif ( is_tag() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore;
        single_tag_title();
        echo $currentAfter;

    } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata( $author );
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore . ' ' . $userdata->display_name . $currentAfter;

    } elseif ( is_404() ) {
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
        echo $currentBefore . __( '404', 'wpzoom' ) . $currentAfter;
    }


}



/* Count number of widgets in a sidebar
=========================================== */
function compass_widgets_count_class( $index = 1 ) {
    global $wp_registered_sidebars, $wp_registered_widgets;

    if ( is_int($index) ) {
        $index = "sidebar-$index";
    } else {
        $index = sanitize_title($index);
        foreach ( (array) $wp_registered_sidebars as $key => $value ) {
            if ( sanitize_title($value['name']) == $index ) {
                $index = $key;
                break;
            }
        }
    }

    $sidebars_widgets = wp_get_sidebars_widgets();

    if ( empty( $wp_registered_sidebars[ $index ] ) || empty( $sidebars_widgets[ $index ] ) || ! is_array( $sidebars_widgets[ $index ] ) ) {
        return '';
    }

    $count = 0;

    foreach ( (array) $sidebars_widgets[ $index ] as $id ) {
        if ( ! isset( $wp_registered_widgets[ $id ] ) ) continue;

        $count++;
    }

    return ' widgets-' . $count;
}