<?php
/**
 * @package FMateo_Ajax
 * @version 1.0
 */
/*
Plugin Name: FMateo Ajax
Plugin URI: https://fmateo.es
Description: Plugin de ejemplo dónde podrás ver Ajax en funcionamiento.
Author: Francisco Mateo
Version: 1.0
Author URI: https://fmateo.es
 */

!defined('FM_AJAX_PATH') && define('FM_AJAX_PATH', plugin_dir_path(__FILE__));
!defined('FM_AJAX_VERSION') && define('FM_AJAX_VERSION', '1.0.0');

if (!function_exists('Init_FM_Ajax_Main')) {

    function Init_FM_Ajax_Main()
    {
        require_once FM_AJAX_PATH . 'includes/class.fm-ajax-main.php';
        return FM_Ajax_Main::instance();
    }
}
Init_FM_Ajax_Main();
