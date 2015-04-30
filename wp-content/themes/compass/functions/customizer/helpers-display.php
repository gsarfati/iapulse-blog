<?php

/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * This function reads in the options from theme mods and determines whether a CSS rule is needed to implement an
 * option. CSS is only written for choices that are non-default in order to avoid adding unnecessary CSS. All options
 * are also filterable allowing for more precise control via a child theme or plugin.
 *
 * Note that all CSS for options is present in this function except for the CSS for fonts and the logo, which require
 * a lot more code to implement.
 *
 * @return void
 */
function compass_css_add_rules() {
    /**
     * Colors section
     */
    // General
    compass_css_add_simple_color_rule( 'color-link', 'a, .entry-title a:hover, .entry-meta a:hover, .single .post_author .author-title a:hover, .comment-author .fn a:hover, .comment-author a.comment-edit-link, .widget .feature-posts-list li a:hover, .wpzoom-featured-cat h3.title a:hover, #news-ticker dd a:hover ', 'color' );
    compass_css_add_simple_color_rule( 'color-text', 'body', 'color' );
    compass_css_add_simple_color_rule( 'color-widget-title', '.widget h3.title', 'color' );

    // Background
    compass_css_add_simple_color_rule( 'color-background-header', '.navbar', 'background' );

    // Footer
    compass_css_add_simple_color_rule( 'color-footer-widget-area-background', '.site-footer', 'background' );
    compass_css_add_simple_color_rule( 'color-footer-text', '.site-footer', 'color' );
    compass_css_add_simple_color_rule( 'color-link-footer', '.site-footer a', 'color' );
    compass_css_add_simple_color_rule( 'color-widget-title-footer', '.footer-widgets .title', 'color' );

    /**
     * Header Background Image
     */
    $header_background_image = get_theme_mod( 'header-background-image', compass_get_default( 'header-background-image' ) );
    if ( ! empty( $header_background_image ) ) {
        $header_background_image    = addcslashes( esc_url_raw( $header_background_image ), '"' );
        $header_background_size     = get_theme_mod( 'header-background-size', compass_get_default( 'header-background-size' ) );
        $header_background_repeat   = get_theme_mod( 'header-background-repeat', compass_get_default( 'header-background-repeat' ) );
        $header_background_position = get_theme_mod( 'header-background-position', compass_get_default( 'header-background-position' ) );

        compass_get_css()->add( array(
            'selectors'    => array( '.navbar' ),
            'declarations' => array(
                'background-image'    => 'url("' . $header_background_image . '")',
                'background-size'     => $header_background_size,
                'background-repeat'   => $header_background_repeat,
                'background-position' => $header_background_position . ' center'
            )
        ) );
    }
}

add_action( 'compass_css', 'compass_css_add_rules' );

function compass_css_add_simple_color_rule( $setting_id, $selectors, $declarations ) {
    $value = maybe_hash_hex_color( get_theme_mod( $setting_id, compass_get_default( $setting_id ) ) );

    if ( $value === compass_get_default( $setting_id ) ) {
        return;
    }

    if ( is_string( $selectors ) ) {
        $selectors = array( $selectors );
    }

    if ( is_string( $declarations ) ) {
        $declarations = array(
            $declarations => $value
        );
    }

    compass_get_css()->add( array(
        'selectors'    => $selectors,
        'declarations' => $declarations
    ) );
}
