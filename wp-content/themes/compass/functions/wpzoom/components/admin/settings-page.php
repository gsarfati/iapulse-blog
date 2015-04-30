<?php

class WPZOOM_Admin_Settings_Page {
    public static function init() {
        if (isset($_POST['action']) && $_POST['action'] == 'reset') {
            option::reset();
        }

        add_action('admin_enqueue_scripts',             array(__CLASS__, 'load_assets'));

        add_action('load-toplevel_page_wpzoom_options', array(__CLASS__, 'contextual_help'));

        add_filter('wpzoom_field_misc_debug',           array(__CLASS__, 'get_debug_text'));
        add_filter('wpzoom_field_misc_import',          array('option', 'get_empty'));
        add_filter('wpzoom_field_misc_import_widgets',  array('option', 'get_empty'));
        add_filter('wpzoom_field_misc_export',          array('option', 'export_options'));
        add_filter('wpzoom_field_misc_export_widgets',  array('option', 'export_widgets'));
    }

    public static function load_assets() {
        if (function_exists('wp_enqueue_media')) {
            wp_enqueue_media();
        }

        wp_enqueue_script('wpzoom-options', WPZOOM::$assetsPath . '/js/zoomAdmin.js', array('jquery', 'thickbox'), WPZOOM::$wpzoomVersion);
        wp_enqueue_style('wpzoom-options', WPZOOM::$assetsPath . '/options.css', array('thickbox'), WPZOOM::$wpzoomVersion);
    }

    /**
     * Menu for theme/framework options page
     */
    public static function menu() {
        $menu = option::$evoOptions['menu'];
        $out = '<ul class="tabs">';

        foreach ($menu as $key => $item) {
            $class = strtolower(str_replace(" ", "_", preg_replace("/[^a-zA-Z0-9\s]/", "", $item['name'])));

            if (isset($item['id'])) {
                $out.= '<li class="' . $class . ' wz-parent" id="wzm-' . $class . '"><a href="#tabid' . $item['id'] . '">' . $item['name'] . '</a><em></em>';
            } else {
                $out.= '<li class="' . $class . ' wz-parent" id="wzm-' . $class . '"><a href="#tab' . $key . '">' . $item['name'] . '</a><em></em>';
            }

            $out.= '<ul>';

            if ( ! is_string ( $key ) ) {
                $sub_sections = option::$evoOptions['id' . $item['id']];
            } else {
                $sub_sections = option::$evoOptions[$key];
            }

            foreach ($sub_sections as $submenu) {
                if ($submenu['type'] == 'preheader') {
                    $name = $submenu['name'];

                    $stitle = 'wpz_' . substr(md5($name), 0, 8);

                    $out.= '<li class="sub"><a href="#' . $stitle . '">' . $name . '</a></li>';
                }
            }
            $out.= '</ul>';
            $out.= '</li>';
        }

        $out.= '</ul>';

        echo $out;
    }

    public static function content() {
        $options = option::$evoOptions;

        unset($options['menu']);

        $settings_ui = new WPZOOM_Admin_Settings_Interface;

        foreach ($options as $tab_id => $tab_content) {
            $settings_ui->add_tab($tab_id);

            foreach ($tab_content as $field) {
                $defaults_args = array(
                    'id'    => '',
                    'type'  => '',
                    'name'  => '',
                    'std'   => '',
                    'desc'  => '',
                    'value' => '',
                    'out'   => ''
                );

                $args = wp_parse_args($field, $defaults_args);
                extract($args);

                if (option::get($id) != "" && !is_array(option::get($id))) {
                    $value = $args['value'] = stripslashes(option::get($id));
                } else {
                    $value = $args['value'] = $std;
                }

                $settings_ui->add_field($type, array($args));
            }

            $settings_ui->end_tab();
            $settings_ui->flush_content();
        }

    }

    public static function contextual_help() {
        if (!method_exists('WP_Screen', 'add_help_tab')) return;

        $screen = get_current_screen();

        $screen->add_help_tab(
            array(
                 'id'       => 'zoom-welcome'
                ,'title'    => 'Overview'
                ,'content'  => '<p>Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. </p><p>Your current theme is running on ZOOM Framework. The <strong>ZOOM framework</strong> is designed to ease the process of customizing WPZOOM themes. The many options available allow you to change almost every aspect of your WPZOOM theme without needing to know how to write any sort of code. The framework has also been designed to stay as consistent as possible across all WPZOOM themes so you can take your knowledge from one theme to another with ease.</p>'
            )
        );
    }

    /**
     * Handle Ajax calls for option updates.
     *
     * @return void
     */
    public static function ajax_options() {
        parse_str($_POST['data'], $data);

        check_ajax_referer('wpzoom-ajax-save', '_ajax_nonce');

        if ($data['misc_import']) {
            option::setupOptions($data['misc_import'], true);
            wp_send_json_success();
        }

        if ($data['misc_import_widgets']) {
            option::setupWidgetOptions($data['misc_import_widgets'], true);
            wp_send_json_success();
        }

        new WPZOOM_Admin_Settings_Sanitization();

        foreach(option::$options as $name => $null) {
            $ignored = array('misc_export', 'misc_export_widgets', 'misc_debug');
            if (in_array($name, $ignored)) continue;

            if (isset($data[$name])) {
                $value = $data[$name];

                if (!is_array($data[$name])) {
                    $value = stripslashes($value);
                }
            } else {
                $value = 'off';
            }

            /*
             * Filter for custom options validators.
             */
            $value = apply_filters( 'zoom_field_save_' . $name, $value );

            option::set($name, $value);
        }

        do_action( 'zoom_after_options_save' );

        wp_send_json_success();
    }

    /**
     * Handle Ajax calls for widgets default.
     *
     * @return void
     */
    public static function ajax_widgets_default() {
        check_ajax_referer('wpzoom-ajax-save', '_ajax_nonce');

        $settingsFile = FUNC_INC . "/widgets/default.json";

        /* backwards compatibility */
        if (!file_exists($settingsFile) && defined('THEME_INC')) {
            $settingsFile = THEME_INC . "/widgets/default.json";
        }

        if (file_exists($settingsFile)) {
            $settings = file_get_contents($settingsFile);

            option::setupWidgetOptions($settings, true);
        }

        wp_send_json_success();
    }

    /**
     * Get debug information
     *
     * Usually when someone have a problem, for a faster resolve we need to
     * know what theme version is, what framework is running and what WordPress
     * is installed. Also most problems are related to 3rd party plugins,
     * so let's also keep track them.
     *
     * This information is private and is displayed only on framework admin
     * page `/wp-admin/admin.php?page=wpzoom_options`
     *
     * @return string
     */
    public static function get_debug_text() {
        // we'll need access to WordPress version
        global $wp_version;

        $debug  = "\n# Debug\n";

        // site url, theme info
        $debug .= "\nSite URL: "          . get_home_url();
        $debug .= "\nTheme Name: "        . WPZOOM::$themeName;
        $debug .= "\nTheme Version: "     . WPZOOM::$themeVersion;
        $debug .= "\nWPZOOM Version: "    . WPZOOM::$wpzoomVersion;
        $debug .= "\nWordPress Version: " . $wp_version;

        $debug .= "\n\n# Plugins\n";

        // active plugins
        $active_plugins = get_option('active_plugins');

        // in order to be able to intersect plugins vs. active plugins by
        // keys, we need to change keys with values
        $active_plugins = array_flip($active_plugins);

        if (!function_exists('get_plugins')) {
            include('wp-admin/includes/plugin.php');
        }

        // get all installed plugins
        $plugins = get_plugins();

        // select only active plugins
        $active_plugins = array_intersect_key($plugins, $active_plugins);

        $i = 1;
        if ($active_plugins && is_array($active_plugins)) {
            // if there are active plugins, get their name, version.
            foreach ($active_plugins as $id => $plugin) {
                $debug .= "\n$i. " . $plugin['Name'] . " " . $plugin['Version'];
                $debug .= "\n   "  . $id;
                $i++;
            }
        }

        // return debug text
        return $debug;
    }
}
