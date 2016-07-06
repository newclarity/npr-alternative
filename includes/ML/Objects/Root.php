<?php

namespace NprAlt\ML\Objects {

    use NprAlt\ML;
    use NprAlt\ML\Objects;
    use NprAlt\Util\Messaging;

    class Root extends ML\Base\Model {

        /**
         * @var string
         */
        var $version;

        /**
         * @var ML\Objects\Message
         */
        var $message;

        /**
         * @var ML\Objects\_List_
         */
        var $list;


        /**
         * Parses stories. Turns raw XML(NprML) into various object properties.
         */
        /**
         * Objects\NPRML constructor.
         *
         * @param ML\Base\Xml_Element|\SimpleXMLElement|string $xml
         */
        function __construct( $xml ) {

            do {

                if ( $xml instanceof ML\Base\Xml_Element ) {
                    $xml_element = $xml;
                } else {
                    $xml_element = new ML\Base\XML_Element( $xml );
                }

                $root = null; // This stops PhpStorm from showing an error on $root

                if ( 'nprml' !== $xml_element->xml->getName() ) {
                    $message = Messaging::__( "Unexpected root XML element '%s' returned from %s. Expected 'nprml.'" );
                    $message = sprintf( $message, $xml_element->xml->getName(), $this->request->queried_url() );
                    Messaging::debug_log( $message );
                } else {

                }

                if ( $message = $xml_element->get_element( 'message' ) ) {
                    $this->message = new ML\Objects\Message( $message );
                }

                if ( $list = $xml_element->get_element( 'list' ) ) {
                    $this->list = new Objects\_List_( $list );
                }

            } while ( false );

            parent::__construct( array() );

        }

    }
}