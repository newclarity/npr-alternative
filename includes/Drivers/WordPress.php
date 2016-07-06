<?php

namespace NprAlt\Drivers {

    use NprAlt\Core;
    use NprAlt\Util;

    /**
     * Class WordPress
     */
    class WordPress implements Core\Driver {

        const SETTINGS_OPTION = 'npr-alt-settings';
        
        /**
         * @param \WP_Error|mixed $indicator
         *
         * @return bool
         */
        function is_error( $indicator ) {

            return is_wp_error( $indicator );

        }

        /**
         * Returns HTTP body when given the result of get_http_response().
         *
         * @param mixed $result
         *
         * @return int
         */
        function get_response_body( $result ) {

            return wp_remote_retrieve_body( $result );

        }

        /**
         * Returns messages (if any) when given the result of get_http_response().
         *
         * @param mixed $result
         *
         * @return string
         */
        function get_response_message( $result ) {
            
            return wp_remote_retrieve_response_message( $result );
            
        }

        /**
         * Returns 200.  Best. We. Can. Do. If we assume nothing.
         *
         * @param mixed $result
         *
         * @return int|string The response code as an integer. Empty string on incorrect parameter given.
         */
        function get_response_code( $result ) {

            return wp_remote_retrieve_response_code( $result );

        }

        /**
         * Calls wp_remote_get()
         *
         * @param string $url
         *
         * @return string
         */
        function get_http_response( $url ) {
            
            return wp_remote_get( $url );

        }

        /**
         * @param Core\Settings $settings
         */
        function save_settings( $settings ) {

            update_option( 
                self::SETTINGS_OPTION,
                Util\Misc::maybe_cast_to_array( (array) $settings ) 
            );

        }

        /**
         * @return Core\Settings 
         */
        function load_settings() {

            return get_option( self::SETTINGS_OPTION );

        }

        /**
         * @param string $html
         * @return string
         */
        static function sanitize_html( $html ) {

            return wp_kses_post( $html );

        }

        /**
         * Display a general or error message.
         *
         * @param string $message
         * @param bool   $is_error
         *
         */
        function show_message( $message, $is_error = false ) {
            $class = $is_error ? 'error' : 'updated fade';
            echo <<<HTML
<div id="message" class="{$class}"><p><strong>{$message}</strong></p></div>
HTML;
        }

        /**
         * @param \WP_Error|string $err_msg
         */
        function log_error( $err_msg ) {

            if ( is_wp_error( $err_msg ) ) {
                $this->_log_wp_error( $err_msg );
            } else {
                error_log( $err_msg );
            }
            
        }

        /**
         * @param \WP_Error $wp_error
         */
        private function _log_wp_error( $wp_error ) {
            $codes = $wp_error->get_error_codes();
            $messages = $wp_error->get_error_messages();
            $errors = http_build_query( array_combine( $codes, $messages ) );
            $errors = str_replace( '&', '; ', $errors );
            error_log( "ERROR: {$errors}" );
        }


        /**
         * Get cached value from WordPress object caching
         *
         * @param string $cache_key
         *
         * @return mixed
         */
        function get_cached_value( $cache_key ) {

            return wp_cache_get( $cache_key, 'npr-alt' );
        }

        /**
         * Cache value using WordPress object caching
         *
         * @param string $cache_key
         * @param mixed $value
         * @param int $timeout
         *
         * @return mixed
         */
        function cache_value( $cache_key, $value, $timeout = 0) {

            $old_value = md5( serialize( wp_cache_get( $cache_key ) ) );

            if ( $old_value !== md5( serialize( $value ) ) ) {

                wp_cache_set( $cache_key, $value, 'npr-alt', $timeout );

            }

        }

    }

}
