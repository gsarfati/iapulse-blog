<?php


/* Registering metaboxes
============================================*/

add_action( 'admin_menu', 'wpzoom_options_box' );

function wpzoom_options_box() {

    add_meta_box('wpzoom_post_embed', 'Post Options', 'wpzoom_post_embed_info', 'post', 'side', 'high');

}


function wpzoom_post_embed_info() {
    global $post;

    ?>
    <fieldset>
        <p class="wpz_border">
            <?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
            <input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo esc_attr($isChecked); ?> /> <label for="wpzoom_is_featured">Feature in Homepage Slider</label>
        </p>

        <p class="wpz_border">
            <?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_breaking', true) == 1 ? 'checked="checked"' : '' ); ?>
            <input type="checkbox" name="wpzoom_is_breaking" id="wpzoom_is_breaking" value="1" <?php echo esc_attr($isChecked); ?> /> <label for="wpzoom_is_breaking">Add to Breaking News Bar</label>
        </p>
    </fieldset>
    <?php
}


function wpz_newpost_head() {
    ?><style type="text/css">
        fieldset.fieldset-show { padding: 0.3em 0.8em 1em; border: 1px solid rgba(0, 0, 0, 0.2); -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; }
        fieldset.fieldset-show p { margin: 0 0 1em; }
        fieldset.fieldset-show p:last-child { margin-bottom: 0; }
    </style><?php
}
add_action('admin_head-post-new.php', 'wpz_newpost_head', 100);
add_action('admin_head-post.php', 'wpz_newpost_head', 100);



add_action( 'save_post', 'custom_add_save' );

function custom_add_save( $postID ) {

    // called after a post or page is saved
    if ( $parent_id = wp_is_post_revision( $postID ) ) {
        $postID = $parent_id;
    }


    if ( isset( $_POST['save'] ) || isset( $_POST['publish'] ) ) {
        update_custom_meta( $postID, ( isset( $_POST['wpzoom_is_featured'] ) ? 1 : 0 ), 'wpzoom_is_featured' );
        update_custom_meta( $postID, ( isset( $_POST['wpzoom_is_breaking'] ) ? 1 : 0 ), 'wpzoom_is_breaking' );
    }
}


function update_custom_meta( $postID, $value, $field ) {
    // To create new meta
    if ( ! get_post_meta( $postID, $field ) ) {
        add_post_meta( $postID, $field, $value );
    } else {
        // or to update existing meta
        update_post_meta( $postID, $field, $value );
    }
}