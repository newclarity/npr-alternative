<?php

namespace NprAlt\Core {

    use NprAlt\Core;
    use NprAlt\Util\Drivers;
    use NprAlt\Util\Messaging;

    class Response extends Core\Instance {

        const HTTP_200_OK = 200;

        /**
         * @var int
         */
        var $code;

        /**
         * @var string
         */
        var $body;

        /**
         * @var string[]
         */
        var $notices = array();

        /**
         * @var object
         */
        var $message;

        /**
         * @var Core\Request
         */
        var $request;

        /**
         * @var Core\Instance
         */
        var $result;

        /**
         * @var \WP_Error
         */
        var $error = false;

        /**
         * Objects\Response constructor.
         *
         * @param mixed $result 
         * @param Core\Request $request
         * @param array           $properties
         */
        function __construct( $result, $request, $properties = array() ) {

            parent::__construct( $properties );

            do {

                if ( Drivers::driver()->is_error( $result ) ) {

                    $this->error = $result;

                    $http_err = '';
                    if ( ! empty( $result->errors[ 'http_request_failed' ][ 0 ] ) ) {
                        $http_err = Messaging::__( 'HTTP Error response =  %s' );
                        $http_err = sprintf( $http_err, $result->errors[ 'http_request_failed' ][ 0 ] );
                    }
                    $err_msg = sprintf( Messaging::__( 'Error retrieving story for url=%s' ), $request->queried_url() );
                    Messaging::debug_log( $err_msg );
                    Messaging::show_error( "{$err_msg} {$http_err}" );
                    break;
                }

                $this->code = Drivers::driver()->get_response_code( $result );

                if ( self::HTTP_200_OK !== $this->code ) {
                    $err_msg = Messaging::__( 'An error occurred pulling your story from the NPR API.  The API responded with message = %s' );
                    Messaging::show_error( sprintf( $err_msg, Drivers::driver()->get_response_message( $result ) ) );
                    break;
                }

                if ( $this->body = Drivers::driver()->get_response_body( $result ) ) {
                    break;
                }

                $this->notices[] = Messaging::__( 'No data available.' );

            } while ( false );


        }

    }
}