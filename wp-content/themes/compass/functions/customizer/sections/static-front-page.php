<?php

/**
 * @param WP_Customize_Manager $wp_customize
 */
function compass_customizer_staticfrontpage( $wp_customize ) {
    $section_id = 'static_front_page';
    $section    = $wp_customize->get_section( $section_id );

    $section->panel = WPZOOM::$theme_raw_name . '_general';
}

add_action( 'customize_register', 'compass_customizer_staticfrontpage', 20 );
