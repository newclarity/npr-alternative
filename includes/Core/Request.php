<?php

namespace NprAlt\Core {

    use NprAlt\Core;
    use NprAlt\Util\Drivers;
    use NprAlt\Util\Misc;

    class Request extends Core\Instance {

        var $org_id;
        var $api_key;
        var $base_url;
        var $url_path;
        var $query;
        private $_queried_url;

        /**
         * NPRAPI_Request constructor.
         *
         * @param int    $org_id
         * @param string $api_key
         * @param array  $args
         */
        function __construct( $org_id, $api_key, $args = array() ) {

            $args = Misc::parse_args( $args, array(
                'base_url' => \NprAlt::API_ROOT,
                'url_path' => \NprAlt::QUERY_PATH
            ) );

            $this->org_id = $org_id;
            $this->api_key = $api_key;
            
            parent::__construct( $args );

        }

        /**
         * Get the requested URL
         *
         * (read only from outside the class)
         *
         * @return string
         */
        function queried_url() {
            return $this->_queried_url;
        }

        /**
         * Only query_api() can set the queried_url() so it does not change in response
         *
         * @return string
         */
        private function set_queried_url() {
            $query = http_build_query( $this->query );
            $this->_queried_url = "{$this->base_url}/{$this->url_path}?{$query}";
        }

        /**
         * @param array|string $query
         *
         * @return Core\Response
         */
        function query_api( $query ) {

            if ( is_string( $query ) ) {

                $query = parse_url( $query );

                if ( 1 === count( $query ) && isset( $query[ 'path' ] ) ) {

                    /*
                     * If just a query string parse_url() will put in 'path'
                     */
                    $query = $query[ 'path' ];

                    if ( false === strpos( $query, '=' ) && is_numeric( $query ) ) {
                        $query = "id={$query}";
                    }

                    $this->query = $query;

                } else {

                    /*
                     * Otherwise it should be in the query
                     */
                    $this->query = $query[ 'query' ];
                    $this->base_url = "{$query[ 'schema' ]}://{$query[ 'host' ]}";
                    $this->url_path = trim( $query[ 'path' ], '/' );

                }

            }

            parse_str( $query, $this->query );
            $this->query[ 'apiKey' ] = $this->api_key;
            $this->query[ 'orgId' ] = $this->org_id;

            $this->set_queried_url();

            $result = Drivers::driver()->get_http_response( $this->queried_url() );

            return new Core\Response( $result, $this );

        }

    }
}