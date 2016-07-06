<?php

namespace NprAlt\Util {

    use NprAlt\Core;
    use NprAlt\Util\Messaging;
    
    /**
     * Class Util
     */
    class Settings {

        /**
         * @var Core\Settings
         */
        private static $_settings;

        /**
         * @param array $settings
         */
        static function register_settings( $settings ) {

            self::$_settings = new Core\Settings( $settings );

        }

        /**
         * @param array $args
         */
        static function register_api_query( $args ) {

            if ( self::$_settings instanceof Core\Settings ) {

                self::$_settings->api_queries[] = new Core\Api_Query( $args );

            } else {

                $err_msg = sprintf(
                    '%s must be called before you can call %s.',
                    get_called_class() . '::register_settings()',
                    __METHOD__ . '()'
                );
                Messaging::show_error( $err_msg );

            }

        }

        /**
         * @return Core\Settings
         */
        static function settings() {

            if ( empty( self::$_settings ) ) {

                if ( $settings = Drivers::driver()->load_settings() ) {
                    self::$_settings = $settings;
                } else {
                    self::$_settings = new Core\Settings();
                }

            }

            return self::$_settings;

        }

        /**
         * @param Core\Settings|object|array $settings
         */
        static function save_settings( $settings ) {

            self::$_settings = new Core\Settings( $settings );

        }

    }

}