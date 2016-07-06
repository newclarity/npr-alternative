<?php

namespace NprAlt\Core {

    /**
     * Class Api_Query
     */
    class Api_Query extends Instance {

        var $text;

        /**
         * NprAlt\Result constructor.
         *
         * @param string|array $args
         */
        function __construct( $args ) {

            if ( is_string( $args ) ) {
                $args = array( 'text' => $args );
            }

            parent::__construct( $args );

        }

    }
}