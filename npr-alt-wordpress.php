<?php
/**
 * Plugin Name: NPR ALternative Plugin for WordPress
 * Plugin URI: https://github.com/newclarity/npr-alternative
 * Description: Alternative Plugin for NPR API integration for WordPress
 * Version: 0.1.0
 * Author: NewClarity Consulting LLC
 * Author URI: http://newclarity.net
 * Text Domain: npr-alt
 * Domain Path: /languages
 */

require __DIR__ . '/includes/NprAlt.php';

add_action( 'plugins_loaded', array( 'NprAlt_WordPress', 'on_load' ) );

use \NprAlt\Util\Drivers;

/**
 * Class NprAlt
 */
class NprAlt_WordPress extends NprAlt {

    const PLUGIN_VERSION = '0.1';

    static function on_load() {

        NprAlt::set_driver( new \NprAlt\Drivers\WordPress() );

        add_action( 'after_setup_theme', array( __CLASS__, '_after_setup_theme' ) );
        add_action( 'shutdown', array( __CLASS__, '_shutdown' ) );

    }

    /**
     *
     */
    static function _after_setup_theme() {

        Drivers::invoke_callbacks( 'on_loaded' );

    }

    /**
     *
     */
    static function _shutdown() {

        Drivers::invoke_callbacks( 'on_shutdown' );

    }
}

