<?php

if ( ! defined( 'NPRALT_DEBUG' ) ) {

    define( 'NPRALT_DEBUG', WP_DEBUG );

}

use NprAlt\Core;
use NprAlt\Util\Drivers;
use NprAlt\Util\Messaging;
use NprAlt\Util\Settings;

/**
 * Class NprAlt
 */
abstract class NprAlt {

    const AUTOLOADER_CACHE_KEY = 'autoloader_files';

    const API_ROOT = 'http://api.npr.org';
    const QUERY_PATH = 'query';

    private static $_autoload_files = array();

    /**
     *
     */
    static function on_load() {

        spl_autoload_register( array( __CLASS__, 'autoloader' ), false, true );

        Drivers::register_callback( 'on_loaded', array( get_called_class(), 'on_loaded' ) );
        Drivers::register_callback( 'on_shutdown', array( get_called_class(), 'on_shutdown' ) );

    }

    /**
     *
     */
    static function on_loaded() {

        static::load_cached_autoload_files();

    }

    /**
     *
     */
    static function on_shutdown() {

        static::cache_autoload_files();

    }

    /**
     *
     */
    static function load_cached_autoload_files() {

        $cached_files = Drivers::driver()->get_cached_value( self::AUTOLOADER_CACHE_KEY );
        if ( is_array( $cached_files ) ) {
            self::$_autoload_files = array_merge( self::$_autoload_files, $cached_files );
        }
    }

    /**
     *
     */
    static function cache_autoload_files() {

        Drivers::driver()->cache_value( self::AUTOLOADER_CACHE_KEY, self::$_autoload_files );

    }

    /**
     * @param string $class_name
     */
    static function autoloader( $class_name ) {

        if ( '\\' !== DIRECTORY_SEPARATOR ) {

            $class_name = preg_replace( "#^NprAlt/#", '',
                str_replace( '\\', DIRECTORY_SEPARATOR, $class_name )
            );

        }

        if ( isset( self::$_autoload_files[ $class_name ] ) ) {

            require self::$_autoload_files[ $class_name ];

        } else if ( is_file( $class_file = __DIR__ . "/{$class_name}.php" ) ) {

            /*
             * Gotta bootstrap loading 'Drivers' etc. in cache_autoload_files()
             */
            require $class_file;

            /*
             * Save so we can cache them on a shutdown hook
             */
            self::$_autoload_files[ $class_name ] = $class_file;

        }

    }

    /**
     *
     */
    static function on_cron() {

        static::process_api_queries();
    }

    /**
     * Loop through all the API queries in the settings and pull down their response.
     *
     * @return \NprAlt\ML\Objects\Root[]
     *
     */
    static function process_api_queries() {

        $api_queries = static::api_queries();

        if ( 0 === count( $api_queries ) ) {

            static::register_api_query( 'id=' );

        }

        $results = array();

        foreach ( $api_queries as $index => $api_query ) {

            $message = sprintf( "Cron %d querying NPR API for %s.", $index, $api_query->text );
            Messaging::debug_log( $message );

            $request = static::make_new_request();

            $response = $request->query_api( $api_query->query );

            if ( $response->error ) {

                Messaging::log_error( $response->error );
                continue;

            } else if ( empty( $response->body ) ) {

                Messaging::log_error( 'No XML to parse_results.' );
                break;
            }

            $results[ $index ] = static::make_new_root( $response->body );

        }

        return $results;

    }

    /**
     * @return mixed|void
     */
    static function api_key() {
        return static::settings()->api_key;
    }

    /**
     * @return int
     */
    static function org_id() {
        return static::settings()->org_id;
    }

    /**
     * @return object[]
     */
    static function api_queries() {
        return static::settings()->api_queries;
    }

    /**
     * @param string|array $api_query
     */
    static function register_api_query( $api_query ) {

        Settings::register_api_query( $api_query );

    }

    /**
     * @param array $settings
     */
    static function register_settings( $settings ) {

        Settings::register_settings( $settings );

    }

    /**
     * @param Core\Driver $driver
     */
    static function set_driver( $driver ) {

        Drivers::set_driver( $driver );

    }

    /**
     * @return Core\Settings
     */
    static function settings() {

        return Settings::settings();

    }

    /**
     * @param Core\Settings|object|array $settings
     */
    static function save_settings( $settings ) {

        Settings::save_settings( $settings );

    }

    /**
     * Factory method to create new Request object
     *
     * Can be overridden in child class.
     *
     * @param array $args
     *
     * @return \NprAlt\Core\Request
     */
    static function make_new_request( $args = array() ) {
        return new \NprAlt\Core\Request( static::org_id(), static::api_key(), $args );
    }

    /**
     * Factory method to create new Root object
     *
     * Can be overridden in child class.
     *
     * @param string $xml
     *
     * @return \NprAlt\ML\Objects\Root
     */
    static function make_new_root( $xml ) {
        return new \NprAlt\ML\Objects\Root( $xml );
    }

    /**
     * @return string
     */
    static function api_url() {
        return static::API_ROOT;
    }

}

/**
 * Call here to ensure autoloader is added before anything else.
 */
NprAlt::on_load();