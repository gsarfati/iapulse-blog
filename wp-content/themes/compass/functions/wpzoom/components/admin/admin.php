<?php
/**
 * WPZOOM_Admin
 *
 * @package WPZOOM
 * @subpackage Admin
 */

new WPZOOM_Admin();

class WPZOOM_Admin {

    /**
     * Initialize wp-admin options page
     */
    public function __construct() {
        if (isset($_GET['activated']) && $_GET['activated'] == 'true') {
            header('Location: admin.php?page=wpzoom_options');
        }

        if (isset($_GET['page']) && $_GET['page'] == 'wpzoom_options') {
            add_action('init', array('WPZOOM_Admin_Settings_Page', 'init'));
        }

        add_action('admin_menu', array($this, 'register_admin_pages'));
        add_action('admin_footer', array($this, 'activate'));

        add_action('wp_ajax_wpzoom_ajax_post',       array('WPZOOM_Admin_Settings_Page', 'ajax_options'));
        add_action('wp_ajax_wpzoom_widgets_default', array('WPZOOM_Admin_Settings_Page', 'ajax_widgets_default'));

        add_action('admin_print_scripts-widgets.php', array($this, 'widgets_styling_script'));
        add_action('admin_print_scripts-widgets.php', array($this, 'widgets_styling_css'));

        add_action('admin_enqueue_scripts',  array($this, 'wpadmin_css'));
    }

    public function widgets_styling_script() {
        wp_enqueue_script('wpzoom_widgets_styling', WPZOOM::$assetsPath . '/js/widgets-styling.js', array('jquery'));
    }

    public function widgets_styling_css() {
        wp_enqueue_style('wpzoom_widgets_styling', WPZOOM::$assetsPath . '/css/widgets-styling.css');
    }

    public function wpadmin_css() {
        wp_enqueue_style('zoom-wp-admin', WPZOOM::get_assets_uri() . '/css/wp-admin.css', array(), WPZOOM::$wpzoomVersion);
    }

    public function activate() {
        if (option::get('wpzoom_activated') != 'yes') {
            option::set('wpzoom_activated', 'yes');
            option::set('wpzoom_activated_time', time());
        } else {
            $activated_time = option::get('wpzoom_activated_time');
            if ((time() - $activated_time) < 2592000) {
                return;
            }
        }

        option::set('wpzoom_activated_time', time());
    }

    public function admin() {
        require_once(WPZOOM_INC . '/pages/admin.php');
    }

    public function update() {
        require_once(WPZOOM_INC . '/pages/update.php');
    }

    /**
     * WPZOOM custom menu for wp-admin
     */
    public function register_admin_pages() {
        add_object_page ( 'Page Title', 'WPZOOM', 'manage_options','wpzoom_options', array($this, 'admin'), 'none');

        add_submenu_page('wpzoom_options', 'WPZOOM', 'Theme Options', 'manage_options', 'wpzoom_options', array($this, 'admin'));

        if (option::is_on('framework_update_enable')) {
            add_submenu_page('wpzoom_options', 'Update Framework', 'Update Framework', 'update_themes', 'wpzoom_update', array($this, 'update'));
        }

    }
}
