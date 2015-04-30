<?php
/**
 * WPZOOM_Theme_Updater Class
 *
 * @package WPZOOM
 * @subpackage Updater
 */

add_action('admin_init', array('WPZOOM_Updater', 'init'));

class WPZOOM_Updater {
    public static function init() {
        if (option::is_on('framework_update_enable') &&
            option::is_on('framework_update_notification_enable'))
        {
            add_action('admin_head', array('WPZOOM_Framework_Updater', 'update_init'));
            add_action('admin_head', array('WPZOOM_Framework_Updater', 'check_update'));
        }

        add_filter('http_request_args',  array(__CLASS__, 'disable_wporg_request'), 5, 2);
    }

    public static function ajax() {
        if ($_POST['type'] == 'framework-notification-hide') {
            option::set('framework_last_checked', time() + 60 * 60 * 48);
            option::delete('framework_status');
        }

        die();
    }

    public static function disable_wporg_request($args, $url) {
        if (0 !== strpos($url, 'https://api.wordpress.org/themes/update-check/1.1/') &&
            0 !== strpos($url, 'http://api.wordpress.org/themes/update-check/1.1/')) {
            return $args;
        }

        $themes = json_decode($args['body']['themes']);

        $parent = get_option('template');
        $child = get_option('stylesheet');

        unset($themes->themes->$parent);
        unset($themes->themes->$child);

        $args['body']['themes'] = json_encode($themes);

        return $args;
    }
}
