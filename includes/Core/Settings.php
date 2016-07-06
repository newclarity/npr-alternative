<?php

namespace NprAlt\Core {
    
    
    /**
     * Class NprAlt_Settings
     */
    class Settings extends Instance {

        /**
         * @var string
         */
        var $api_key = 'No API key specified.';

        /**
         * @var string
         */
        var $org_id = 0;

        /**
         * @var Api_Query[]
         */
        var $api_queries = array( 'text' => 'id=' );

        /**
         * NprAlt_Api_Settings constructor.
         *
         * @param array|object $properties
         */
        function __construct( $properties = array() ) {

            parent::__construct( (array) $properties );

            foreach ( $this->api_queries as $index => $args ) {

                $this->api_queries[ $index ] = new Api_Query( $args );

            }

        }

        /**
         * @param array $args
         */
        function register_api_query( $args ) {

            $this->api_queries[] = new Api_Query( $args );

        }
    }
}