<?php

namespace NprAlt\Drivers {

    use NprAlt\Core;
    use NprAlt\Util;

    /**
     * Class _Default_ - Underscores used because 'Default' is a reserved word in PHP.
     */
    class _Default_ implements Core\Driver {

        const SETTINGS_FILE = 'settings.txt';
    
        /**
         * @param \WP_Error|mixed $indicator
         *
         * @return bool
         */
        function is_error( $indicator ) {

            return (bool) $indicator;

        }

        /**
         * Returns was is passed.  Best we can do for default.
         *
         * @param mixed $result
         *
         * @return string
         */
        function get_response_body( $result ) {

            return $result;

        }

        /**
         * Returns 200.  Best. We. Can. Do. If we assume nothing.
         *
         * @param mixed $result
         *
         * @return int
         */
        function get_response_code( $result ) {
            
            return 200;

        }

        /**
         * Returns empty string. Best we can do.
         *
         * @param mixed $result
         *
         * @return string
         */
        function get_response_message( $result ) {

            return '';

        }

        /**
         * Calls file_get_contents() as a fallback
         *
         * @param string $url
         *
         * @return string
         */
        function get_http_response( $url ) {
            
            return file_get_contents( $url );

        }

        /**
         * @param Core\Settings $settings
         */
        function save_settings( $settings ) {

            file_put_contents( 
                self::SETTINGS_FILE, 
                serialize( Util\Misc::maybe_cast_to_array( (array) $settings ) ) 
            );

        }

        /**
         * @return Core\Settings 
         */
        function load_settings() {

            return file_get_contents( self::SETTINGS_FILE );

        }

        /**
         * @param string $html
         * @return string
         */
        static function sanitize_html( $html ) {

            return $html;

        }

        /**
         * @param \WP_Error|string $err_msg
         */
        function log_error( $err_msg ) {

            error_log( $err_msg );

        }

        /**
         * Display a general or error message.
         *
         * @param string $message
         * @param bool   $is_error
         * 
         */
        function show_message( $message, $is_error = false ) {
            $class = $is_error ? 'error' : 'message';
            echo <<<HTML
<div class="{$class}"><p><strong>{$message}</strong></p></div>
HTML;
        }

        /**
         * By default we can't cache anything
         *
         * @param string $cache_key
         *
         * @return mixed
         */
        function get_cached_value( $cache_key ) {
            return null;
        }

        /**
         * Since we can't cache anything throw away whatever value you get.
         *
         * @param string $cache_key
         * @param mixed $value
         * @param int $timeout
         *
         * @return mixed
         */
        function cache_value( $cache_key, $value, $timeout = 0 ) {
            
            
        }
        
    }

}