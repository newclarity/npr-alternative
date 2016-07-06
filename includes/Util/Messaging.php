<?php

namespace NprAlt\Util {

    use NprAlt\Util\Drivers;

    class Messaging {

        /**
         * Display an error message.
         *
         * @param string $message
         */
        static function show_error( $message ) {

            Drivers::driver()->show_message( $message, false );

        }

        /**
         * Display a general or error message.
         *
         * @param string $message
         * @param bool   $is_error
         *
         */
        function show_message( $message, $is_error = false ) {

            Drivers::driver()->show_message( $message, $is_error );

        }


        /**
         * Log an error action during development.
         *
         * If a fatal error, use NprAlt::log_error() instead.
         *
         * @param string $action
         */
        static function debug_log( $action ) {

            if ( NPRALT_DEBUG ) {
                Drivers::driver()->log_error( $action );
            }

        }

        /**
         * @param string $err_msg
         */
        static function log_error( $err_msg ) {

            Drivers::driver()->log_error( __CLASS__ . ": {$err_msg}" );

        }


        /**
         * Designed for future language translations
         *
         * @param string $message
         *
         * @return string
         */

        static function __( $message ) {
            return $message;
        }


    }

}