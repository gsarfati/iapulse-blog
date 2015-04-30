<?php

function compass_option_defaults() {
    $defaults = array(
        /**
         * General
         */
        // Site Title & Tagline
        'hide-tagline'                        => 0,
        // Logo
        'logo'                                => '',
        'logo-retina-ready'                   => 0,
        'logo-favicon'                        => 0,
        /**
         * Typography
         */
        // General Text
        'font-family-site-general'            => 'Roboto',
        'font-size-site-general'              => 16,
        // Site Title & Tag Line
        'font-family-site-title'              => 'Roboto',
        'font-size-site-title'                => 26,
        // Navigation
        'font-family-nav'                     => 'Roboto',
        'font-size-nav'                       => 16,
        // Slider Title
        'font-family-slider-title'            => 'Oswald',
        'font-size-slider-title'              => 38,
        // Widgets
        'font-family-widgets'                 => 'Roboto',
        'font-size-widgets'                   => 16,
        // Post Title
        'font-family-post-title'              => 'Oswald',
        'font-size-post-title'                => 26,
        // Single Post Title
        'font-family-single-post-title'       => 'Oswald',
        'font-size-single-post-title'         => 50,
        // Page Title
        'font-family-page-title'              => 'Oswald',
        'font-size-page-title'                => 50,
        /**
         * Color Scheme
         */
        // General
        'color-link'                          => '#5470c0',
        'color-text'                          => '#444',
        'color-widget-title'                  => '#3d3d3d',
        // Background
        'color-background-header'             => '#5470c0',
        // Footer
        'color-footer-widget-area-background' => '#19191a',
        'color-footer-text'                   => '#eeeeee',
        'color-link-footer'                   => '#7bdeff',
        'color-widget-title-footer'           => '#fff',

        /**
         * Header
         */
        // Navbar
        'navbar-hide-search'                  => 0,
        // Background Image
        'header-background-image'             => '',
        'header-background-repeat'            => 'no-repeat',
        'header-background-position'          => 'center',
        'header-background-size'              => 'cover',
        /**
         * Footer
         */
        // Widget Areas
        'footer-widget-areas'                 => 4,
        // Copyright
        'footer-text'                         => sprintf( __( 'Copyright &copy; %1$s &mdash; %2$s. All Rights Reserved', 'wpzoom' ), date( 'Y' ), get_bloginfo( 'name' ) ),
    );

    return $defaults;
}

function compass_get_default( $option ) {
    $defaults = compass_option_defaults();
    $default  = ( isset( $defaults[ $option ] ) ) ? $defaults[ $option ] : false;

    return $default;
}
