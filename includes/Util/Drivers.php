<?php

namespace NprAlt\Util {

    use NprAlt\Core;
    use NprAlt\Util\Messaging;
    
    /**
     * Class Util
     */
    class Drivers {

        /**
         * @var Core\Driver
         */
        private static $_driver;

        /**
         * @var object
         */
        private static $_callbacks = array(
            'on_loaded'   => array(),
            'on_shutdown' => array(),
        );

        /**
         * @param Core\Driver $driver
         */
        static function set_driver( $driver ) {

            self::$_driver = $driver;
        }

        /**
         * @return Core\Driver
         */
        static function driver() {

            if ( ! isset( self::$_driver ) ) {

                self::$_driver = new \NprAlt\Drivers\_Default_();

                Messaging::debug_log( 'No driver set, using _Default_ instead.' );

            }

            return self::$_driver;
        }

        /**
         * Returns object of callback array properties.
         *
         * @return object
         */
        static function callbacks() {

            return self::$_callbacks;

        }

        /**
         * Check to ensure if callback type is valid.
         *
         * @param string $callback_type
         * @return bool
         */
        static function _is_callback_type_valid( $callback_type ) {
            
            $is_valid = true; 
            if ( ! preg_match( '#^on_(loaded|shutdown)$#', $callback_type ) ) {

                $err_msg = Messaging::__( 'Invalid callback type: %s' );
                Messaging::show_error( sprintf( $err_msg, $callback_type ) );

                $is_valid = false;
            }
            return $is_valid;
        }

        /**
         * Invoke the array of registered 'on_loaded' callbacks.
         *
         * @param string $callback_type
         */
        static function invoke_callbacks( $callback_type ) {
            
            if ( self::_is_callback_type_valid( $callback_type ) ) {

                foreach ( self::$_callbacks->{$callback_type} as $callback ) {
                    call_user_func( $callback );
                }

            }

        }

        /**
         * Register a callback to be run when system NprAlt is fully loaded.
         *
         * @param string   $callback_type
         * @param callable $callback
         */
        static function register_callback( $callback_type, $callback ) {

            self::$_callbacks = (object) self::$_callbacks;

            if ( self::_is_callback_type_valid( $callback_type ) ) {

                self::$_callbacks->{$callback_type}[] = $callback;

            }

        }

    }
}