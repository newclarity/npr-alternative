<?php

namespace NprAlt\Util {

    use NprAlt\Util;
    
    /**
     * Class Misc
     */
    class Misc {

        /**
         * Casts to an array and any elements to an array for non-scalar values.
         *
         * @param array $value
         *
         * @return array
         */
        static function maybe_cast_to_array( $value ) {

            if ( ! is_scalar( $value ) ) {

                $value = (array) $value;

                foreach ( $value as $index => $element ) {

                    if ( ! is_scalar( $element ) ) {

                        $value[ $element ] = self::maybe_cast_to_array( $element );

                    }

                }
            }

            return $value;
        }

        /**
         * Merge array of $args with a defined set of elements and values.
         *
         * Used to ensures an array has expected elements
         *
         * @param object|string|array $args
         * @param array               $defaults
         *
         * @return array|null Merged user defined values with defaults.
         */
        static function parse_args( $args, $defaults = null ) {
            if ( is_object( $args ) ) {
                $args = get_object_vars( $args );
            } else if ( ! is_array( $args ) ) {
                parse_str( $args, $args );
            }
            if ( is_array( $defaults ) ) {
                $args = array_merge( $defaults, $args );
            }

            return $args;
        }

        /**
         * Designed for child classes to inherit and add santitation, if desired.
         *
         * @param string $html
         *
         * @return mixed
         */
        static function sanitize_html( $html ) {

            Util\Drivers::driver()->sanitize_html( $html );

        }

        /**
         * Retrieve an response by dereferencing an HTTP(S) URL.
         *
         * Uses file_get_contents() which is often blocked by web hosts.
         *
         * Designed to be overridden by child class.
         *
         * @param string $url
         *
         * @return string
         */
        static function get_http_response( $url ) {

            return Util\Drivers::driver()->get_http_response( $url );

        }
    }

}