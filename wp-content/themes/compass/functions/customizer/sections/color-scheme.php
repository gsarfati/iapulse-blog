<?php

function compass_customizer_define_color_scheme_sections( $sections ) {
    $panel           = WPZOOM::$theme_raw_name . '_color-scheme';
    $colors_sections = array();

    $colors_sections['color'] = array(
        'panel'   => $panel,
        'title'   => __( 'General', 'wpzoom' ),
        'options' => array(
            'color-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Links Color', 'wpzoom' ),
                ),
            ),

            'color-text'  => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Text Color', 'wpzoom' ),
                ),
            ),

            'color-widget-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Widget Title', 'wpzoom' ),
                ),
            ),
        )
    );

    $colors_sections['color-background'] = array(
        'panel'   => $panel,
        'title'   => __( 'Background', 'wpzoom' ),
        'options' => array(
            'color-background-header' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Header Background', 'wpzoom' ),
                ),
            ),
        )
    );

    $colors_sections['color-footer'] = array(
        'panel'   => $panel,
        'title'   => __( 'Footer', 'wpzoom' ),
        'options' => array(
            'color-footer-widget-area-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Widget Area Background', 'wpzoom' ),
                ),
            ),

            'color-footer-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Text', 'wpzoom' ),
                ),
            ),


            'color-link-footer' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer Links', 'wpzoom' ),
                ),
            ),

            'color-widget-title-footer' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Widget Title', 'wpzoom' ),
                ),
            ),

        )
    );

    return array_merge( $sections, $colors_sections );
}

add_filter( 'zoom_customizer_sections', 'compass_customizer_define_color_scheme_sections' );
