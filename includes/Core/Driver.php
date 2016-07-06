<?php

namespace NprAlt\Core {

    interface Driver {
        
        /**
         * Should return true if the $indictor indicates an error.
         *
         * @param mixed $indicator
         *
         * @return bool
         */
        function is_error( $indicator );

        /**
         * Retrieves response by dereferencing URL via HTTP.
         *
         * @param string $url
         *
         * @return string
         */
        function get_http_response( $url );

        /**
         * Returns HTTP body when given the result of get_http_response().
         *
         * @param mixed $result
         *
         * @return string
         */
        function get_response_body( $result );

        /**
         * Returns messages (if any) when given the result of get_http_response().
         *
         * @param mixed $result
         *
         * @return string
         */
        function get_response_message( $result );
        
        /**
         * Returns HTTP status code when given the result of get_http_response().
         *
         * @param mixed $result
         *
         * @return int
         */
        function get_response_code( $result );

        /**
         * @param Settings $settings
         */
        function save_settings( $settings );

        /**
         * @return Settings
         */
        function load_settings();

        /**
         * @param string $html
         * @return string
         */
        static function sanitize_html( $html );
    
        /**
         * @param string $err_msg
         */
        function log_error( $err_msg );

        /**
         * Display a general or error message.
         *
         * @param string $message
         * @param bool   $is_error
         */
        function show_message( $message, $is_error = false );

        /**
         * Return a cached value if cached by $cache_key, or null if not cached.
         *
         * @param string $cache_key
         *
         * @return mixed
         */
        function get_cached_value( $cache_key );

        /**
         * Cache a $value using $cache_key for $timeout seconds.
         *
         * @param string $cache_key
         * @param mixed $value
         * @param int $timeout
         *
         * @return mixed
         */
        function cache_value( $cache_key, $value, $timeout = 0 );


    }

}