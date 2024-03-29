<?php

/**
 * WPZOOM Framework Options Manager
 *
 * @category WPZOOM
 */
class option {
    public static $options = array();
    public static $evoOptions;

    private static $prefix = "wpzoom_";

    public static function init() {
        self::loadOptions();
    }

    public static function set($name, $value) {
        update_option(self::$prefix . $name, $value);
        self::$options[$name] = $value;

        return $value;
    }

    public static function get($name, $echo = false) {
        $result = false;
        if (isset(self::$options[$name])) {
            $result = self::$options[$name];
        }

        if ($result === false) {
            $result = get_option(self::$prefix . $name);
        }

        if ($result === false) {
            return;
        }

        if (!$echo) {
            return $result;
        }

        echo esc_html($result);
    }

    public static function delete($name) {
        $args = func_get_args();
        $num = count($args);

        if ($num == 1) {
            return (delete_option(self::$prefix . $args[0]) ? true : false);
        } elseif ($num > 1) {
            foreach ($args as $option) {
                if (!delete_option(self::$prefix . $option))
                    return false;
            }
            return true;
        }
        return false;
    }

    public static function is_on($name) {
        return (self::get($name) === 'on');
    }

    private static function loadOptions() {
        self::$options = self::getOptions();
    }

    public static function getOptions() {
        self::$evoOptions = self::getOptionsArray();

        $rOptions = self::$evoOptions;

        unset($rOptions['menu']);

        foreach ($rOptions as $column) {
            foreach ($column as $row) {
                if (isset($row['id'])) {
                    $id = $row['id'];
                } else {
                    continue;
                }

                $ignored = array('misc_export', 'misc_export_widgets', 'misc_debug');
                if (in_array($id, $ignored)) continue;

                $fetched_option = get_option(self::$prefix . $id);

                if ($fetched_option === false) {
                    $globalOptions[$id] = isset($row['std']) ? $row['std'] : '';
                    update_option(self::$prefix . $id, $globalOptions[$id]);
                } else {
                    $globalOptions[$id] = $fetched_option;
                }
            }
        }

        return $globalOptions;
    }

    public static function getJsOptions() {
        $rOptions = self::getOptionsArray();
        $options = array();

        foreach ($rOptions as $column) {
            foreach ($column as $row) {
                if (!isset($row['js']) || !isset($row['id'])) {
                    continue;
                }

                $id = $row['id'];
                $value = get_option(self::$prefix . $id);

                if ($value === false) {
                    $options[$id] = isset($row['std']) ? $row['std'] : '';
                } else {
                    $options[$id] = $value;
                }

                if ($options[$id] === 'on') {
                    $options[$id] = true;
                }

                if ($options[$id] === 'off') {
                    $options[$id] = false;
                }
            }
        }

        return $options;
    }

    public static function setupOptions($xoptions, $decode = false) {
        if ($decode) {
            $xoptions = unserialize(stripslashes(base64_decode($xoptions)));
        }

        self::$evoOptions = self::getOptionsArray();

        foreach(self::$evoOptions as $name => $options) {
            $name = explode("id", $name);
            if (isset($name[1]) && $name[1] != "") {
                $rOptions[] = $options;
            }
        }

        foreach ($rOptions as $column) {
            foreach ($column as $row) {
                $ignored = array('preheader', 'startsub', 'endsub');
                if (in_array($row['type'], $ignored)) continue;

                $id = $row['id'];

                self::set($id, $xoptions[$id]);
            }
        }

    }

    public static function getOptionsArray() {
        $option_files = apply_filters( 'zoom_option_files', array(
            sprintf( '%s/theme/options.php', FUNC_INC), // for backwards compatibility
            sprintf( '%s/options.php',       FUNC_INC),
            sprintf( '%s/options.php',       WPZOOM_INC)
        ) );

        /**
         * Check if supplied files exists and load options definitions from them.
         */
        $options = array();
        foreach ( $option_files as $file ) {
            if ( ! file_exists( $file ) ) continue;
            $options[] = include( $file );
        }

        $merged = call_user_func_array( 'array_merge_recursive' , $options);

        /*
         * Move down framework section.
         */
        $opt = $merged['menu']['framework'];
        unset($merged['menu']['framework']);
        $merged['menu']['framework'] = $opt;

        /*
         * Move down Import/Export section.
         */
        $opt = $merged['menu']['import-export'];
        unset($merged['menu']['import-export']);
        $merged['menu']['import-export'] = $opt;

        /**
         * Merge options and return an array of options.
         */
        return $merged;
    }

    public static function reset() {
        global $wpdb;

        $query = "DELETE FROM $wpdb->options WHERE option_name LIKE '" . self::$prefix . "%'";
        $wpdb->query($query);

        if (isset($_GET['page'])) {
            $send = $_GET['page'];
            header("Location: admin.php?page=$send");
        }
    }

    public static function getWidgetOptions() {
            global $wpdb;

            $q = "SELECT * FROM $wpdb->options WHERE option_name LIKE 'widget_%'";
            $q = $wpdb->get_results($q);

            $widgetOptions = array();

            foreach($q as $option) {
                $widgetOptions[$option->option_name] = maybe_unserialize($option->option_value);
            }

            //Get sidebar widgets locations
            $widgetOptions['sidebars_widgets'] = get_option('sidebars_widgets');

            return $widgetOptions;
    }

    public static function setupWidgetOptions($options, $decode = false) {
        if ($decode) {
            $options = unserialize(stripslashes(base64_decode($options)));
        }

        if (!is_array($options)) {
            return false;
        }

        $builder_widgets = array();

        $sidebars_widgets = wp_get_sidebars_widgets();
        if ( is_array( $sidebars_widgets ) && !empty( $sidebars_widgets ) ) {
            foreach ( $sidebars_widgets as $sidebar_id => $widgets ) {
                    if ( preg_match( '/^_wpzlb-page-[0-9]+-widgets$/i', $sidebar_id ) ) {
                            foreach ( $widgets as $widget_id ) {
                                    $builder_widgets[ preg_replace( '/-[0-9]+$/', '', $widget_id ) ][] = intval( preg_replace( '/^.+-([0-9]+)$/', '$1', $widget_id ) );
                            }
                    }
            }
        }

        foreach ( $options as $id => $option ) {
            $current_value = get_option( $id );
            $keep = array();

            if ( $id == 'sidebars_widgets' ) {
                foreach ( $current_value as $sidebar_id => $widgets ) {
                    if ( preg_match( '/^_wpzlb-page-[0-9]+-widgets$/i', $sidebar_id ) ) $keep[ $sidebar_id ] = $widgets;
                }
            } else {
                $widget_id = preg_replace( '/^widget_/i', '', $id );

                if ( isset( $builder_widgets[ $widget_id ] ) ) {
                    foreach ( $current_value as $widget_num => $widget_settings ) {
                        if ( in_array( $widget_num, $builder_widgets[ $widget_id ] ) ) $keep[ $widget_num ] = $widget_settings;
                    }
                }
            }

            update_option( $id, ( $keep + $option ) );
        }
    }

    public static function export_options() {
        return base64_encode(serialize(self::getOptions()));
    }

    public static function export_widgets() {
        return base64_encode(serialize(self::getWidgetOptions()));
    }

    public static function get_empty() {
        return '';
    }
}
