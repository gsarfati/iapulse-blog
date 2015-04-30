<?php

class WPZOOM_Theme {
    private static $dynamic_google_webfonts = array();

    public static function init() {
        add_action('after_setup_theme', array(__CLASS__, 'add_feed_links'));

        if (option::is_on("meta_generator")) {
            add_action('wp_head', array(__CLASS__, 'meta_generator'));
        }

        add_action('wp_enqueue_scripts', array(__CLASS__, 'theme_styles'), 20);
        add_action('wp_enqueue_scripts', array(__CLASS__, 'theme_scripts'));
    }

    public static function add_feed_links() {
        global $wpz_default_feed;
        $wpz_default_feed = get_feed_link();

        add_theme_support('automatic-feed-links');
        add_filter('feed_link', array(__CLASS__, 'custom_feed_links'), 1);
    }

    public static function custom_feed_links($feed) {
        global $wpz_default_feed;
        $custom_feed = esc_attr(trim(option::get('misc_feedburner')));

        if ($feed == $wpz_default_feed && $custom_feed) {
            return $custom_feed;
        }

        return $feed;
    }

    /**
     * Adds WPZOOM to html meta generator
     *
     * @return void
     */
    public static function meta_generator() {
        $mg = "<!-- WPZOOM Theme / Framework -->\n";
        $mg.= '<meta name="generator" content="' . esc_attr(WPZOOM::$themeName . ' ' . WPZOOM::$themeVersion) . '" />' . "\n";
        $mg.= '<meta name="generator" content="WPZOOM Framework ' . esc_attr(WPZOOM::$wpzoomVersion) . '" />' . "\n";

        echo $mg;
    }

    /**
     * Include css file for specified style
     */
    public static function theme_styles() {
        /**
         * If current theme supports styles use them
         */
        if (option::get('theme_style')) {
            $style = str_replace(" ", "-", strtolower(option::get('theme_style')));

            if (file_exists(get_template_directory() . '/styles/' . $style . '.css')) {
                wp_register_style('wpzoom-theme', get_template_directory_uri() . '/styles/' . $style . '.css');
                wp_enqueue_style('wpzoom-theme');
            }
        }

        /**
         * Deprecated file, but we still register this stylesheet for
         * backwards comptability.
         */
        if (file_exists(get_template_directory() . '/custom.css')) {
            wp_register_style('wpzoom-custom', get_template_directory_uri() . '/custom.css');
            wp_enqueue_style('wpzoom-custom');
        }

        if (file_exists(get_template_directory() . '/css/custom.css')) {
            wp_register_style('theme-custom', get_template_directory_uri() . '/css/custom.css');
            wp_enqueue_style('theme-custom');
        }
    }

    public static function theme_scripts() {
        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }

        /**
         * Enqueue initialization script, HTML5 Shim included.
         *
         * Only if this file exists.
         */
        if (file_exists(get_template_directory() . '/js/init.js')) {
            wp_enqueue_script('wpzoom-init',  get_template_directory_uri() . '/js/init.js', array('jquery'));
        }
    }
}
