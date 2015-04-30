<?php
/**
 * WPZOOM Global Theme Features
 *
 * @package WPZOOM
 * @subpackage ui
 */

class ui {
    /**
     * Includes rss link if is specified in theme options
     */
    public static function rss() {
        $feed = esc_attr(trim(option::get('misc_feedburner')));
        if (!$feed) {
            bloginfo('rss2_url');
        } else {
            echo option::get('misc_feedburner');
        }
    }

    /**
     * Takes an image URL (or attachment ID) and returns a URL to a version of that same image that is equal in dimensions to the passed $width and $height parameters
     * The image will be resized on-the-fly, saved, and returned if an image of that same size doesn't already exist in the media library
     *
     * @param string|int $image The image URL or attachment ID whose resized version the function should return
     * @param int $width The desired width of the returned image
     * @param int $height The desired height of the returned image
     * @param boolean $crop Should the image be cropped to the desired dimensions (Defaults to false in which case the image is scaled down, rather than cropped)
     * @return string
     */
    public static function thumbIt( $image, $width, $height, $crop = true ) {
        global $wpdb;

        if ( is_int( $image ) ) {
            $attachment_id = $image > 0 ? $image : false;
        } else {
            $img_url = esc_url( $image );
            $upload_dir = wp_upload_dir();
            $base_url = $upload_dir['baseurl'];
            if ( substr( $img_url, 0, strlen( $base_url ) ) !== $base_url ) return $image;
            $result = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE %s LIMIT 1;", '%' . wpdb::esc_like( str_replace( trailingslashit( $base_url ), '', $img_url ) ) . '%' ) );
            $attachment_id = absint( $result ) > 0 ? absint( $result ) : false;
        }

        if ( $attachment_id === false ) return $image;

        $image = wp_get_attachment_url( $attachment_id );

        $attachment_meta = wp_get_attachment_metadata( $attachment_id );
        if ( $attachment_meta === false ) return $image;

        $width = absint( $width );
        $height = absint( $height );
        $needs_resize = true;

        foreach ( $attachment_meta['sizes'] as $size ) {
            if ( $width === $size['width'] && $height === $size['height'] ) {
                $image = str_replace( basename( $image ), $size['file'], $image );
                $needs_resize = false;
                break;
            }
        }

        if ( $needs_resize ) {
            $attached_file = get_attached_file( $attachment_id );
            $resized = image_make_intermediate_size( $attached_file, $width, $height, (bool)$crop );

            if ( !is_wp_error( $resized ) && $resized !== false ) {
                $key = sprintf( 'resized-%dx%d', $width, $height );
                $attachment_meta['sizes'][ $key ] = $resized;
                $image = str_replace( basename( $image ), $resized['file'], $image );
                wp_update_attachment_metadata( $attachment_id, $attachment_meta );

                $backup_sizes = get_post_meta( $attachment_id, '_wp_attachment_backup_sizes', true );
                if ( !is_array( $backup_sizes ) ) $backup_sizes = array();
                $backup_sizes[ $key ] = $resized;
                update_post_meta( $attachment_id, '_wp_attachment_backup_sizes', $backup_sizes );
            }
        }

        return $image;
    }

    /**
     * Return an array of categories
     * if $parent is true returns only top level categories
     *
     * @param boolean $parent
     * @return array
     */
    public static function getCategories($parent = false) {
        global $wpdb, $table_prefix;

        $tb1 = $table_prefix . "terms";
        $tb2 = $table_prefix . "term_taxonomy";

        $qqq = $parent ? "AND $tb2" . ".parent = 0" : "";

        $q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq ORDER BY $tb1.name ASC";
        $q = $wpdb->get_results($q);

        foreach ($q as $cat) {
            $categories[$cat->term_id] = $cat->name;
        }

        return $categories;
    }

    /**
     * Returns an array of pages
     *
     * @return array
     */
    public static function getPages() {
        global $wpdb, $table_prefix;

        $tb1 = $table_prefix . "posts";

        $q = "SELECT $tb1.ID,$tb1.post_title FROM $tb1 WHERE $tb1.post_type = 'page' AND $tb1.post_status = 'publish' ORDER BY $tb1.post_title ASC";
        $q = $wpdb->get_results($q);

        foreach ($q as $pag) {
            $pages[$pag->ID] = $pag->post_title;
        }

        return $pages;
    }

    /**
     * Trims $moreText to $maxChars
     *
     * @param int $maxChars
     * @param string $moreText
     * @param string $stripteaser
     * @param string $morefile
     * @return void
     */
    public static function theContentLimit($maxChars, $moreText = '(more ...)', $stripteaser, $moreFile = '') {
        $content = get_the_content($moreText, $stripteaser, $moreFile);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $content = strip_tags($content);

        if (strlen($_GET['p']) > 0 && $thisshouldnotapply) {
            echo $content;
        } elseif ((strlen($content) > $maxChars) && ($espacio = strpos($content, " ", $maxChars))) {
            $content = substr($content, 0, $espacio);
            $content = $content;
            echo $content;
            echo "...";
        } else {
            echo $content;
        }
    }

    /**
     * Checks if WordPress version is greater or equal to $is_ver
     *
     * @param  string  $is_ver version to be checked
     * @return boolean
     */
    public static function is_wp_version($is_ver) {
        include( ABSPATH . WPINC . '/version.php' ); // $wp_version; // x.y.z

        return version_compare($wp_version, $is_ver, '>=');
    }

    /**
     * WPZOOM public head
     */
    public static function head() {
        /**
         * Call WordPress head hook
         */
        wp_head();
    }

    /**
     * WPZOOM public footer
     */
    public static function footer() {
        /**
         * Call WordPress footer hook
         */
        wp_footer();
    }

}
