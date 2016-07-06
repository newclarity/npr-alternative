<?php

namespace NprAlt\ML\Base {

    use NprAlt\Core;

    /**
     * Class NprML_XML_Element
     *
     * Wrapper for SimpleXmlElement with methods that simplify using SimpleXML.
     *
     */
    class Xml_Element extends Core\Instance {

        /**
         * @var \SimpleXMLElement
         */
        var $xml;

        /**
         * @var array
         */
        var $attributes = array();

        /**
         * @var \SimpleXMLIterator
         */
        var $iterator;

        /**
         * @var string
         */
        var $property_name;

        /**
         * NprML_XML_Element constructor.
         *
         * @param \SimpleXMLElement|string $xml
         * @param array                    $properties
         */
        function __construct( $xml, $properties = array() ) {

            if ( $xml instanceof \SimpleXMLElement ) {
                $this->xml = $xml;
                $xml = $xml->asXML();
            }

            if ( is_string( $xml ) ) {
                $this->xml = simplexml_load_string( $xml );
            }

            $this->iterator = new \SimpleXMLIterator( $xml );

            parent::__construct( $properties );

        }

        /**
         * Returns the value of a SimpleXML element AS A STRING!!! ;-)
         *
         * @return string
         */
        function value() {
            return $this->get_value();
        }

        /**
         * Given an XPath, returns the value of a SimpleXML element AS A STRING!!! ;-)
         *
         * @param string $xpath An Xpath specifying how depth to access the object
         *
         * @return string
         */
        function get_value( $xpath = '' ) {
            $xml_elements = $this->get_elements( $xpath );
            if ( 1 === count( $xml_elements ) ) {
                $value = (string) reset( $xml_elements );
            } else {
                $value = array();
                foreach ( $xml_elements as $index => $xml_element ) {
                    $value[ $index ] = (string) $xml_element;
                }
            }

            return (string) $value;
        }

        /**
         * Returns the attributes of a SimpleXML element AS AN ARRAY!!!  ;-)
         *
         * @return string[]
         */
        function attributes() {
            return $this->get_attributes();
        }

        /**
         * Given an XPath, returns the attributes of a SimpleXML element AS AN ARRAY!!!  ;-)
         *
         * @param string $xpath An Xpath specifying how depth to access the object
         *
         * @return string[]
         */
        function get_attributes( $xpath = '' ) {
            if ( ! isset( $this->attributes[ $xpath ] ) ) {
                $attributes = array();
                $xml_elements = $this->get_elements( $xpath );
                foreach ( $xml_elements as $xml_element ) {
                    if ( $xml_element instanceof \SimpleXMLElement ) {
                        /**
                         * @see: http://stackoverflow.com/a/13677624/102699
                         */
                        $attributes = current( $xml_element->attributes() );
                    }
                }
                $this->attributes[ $xpath ] = $attributes;
            }

            return $this->attributes[ $xpath ];
        }

        /**
         * Extracts value of a given attribute from a SimpleXML element.
         *
         * @param string $attribute The name of an attribute of the element.
         * @param string|null $xpath An Xpath specifying how depth to access the object
         *
         * @return string|null
         *   The value of the attribute (if it exists in element).
         */
        function get_attribute( $attribute, $xpath = null ) {
            $attributes = $this->get_attributes( $xpath );

            return isset( $attributes[ $attribute ] )
                ? $attributes[ $attribute ]
                : null;
        }

        /**
         * Extracts the first sub element from a SimpleXML element.
         *
         * @return \SimpleXMLElement The value of the attribute (if it exists in element).
         */
        function element() {
            return $this->get_element( null );
        }

        /**
         * Given an XPath, extracts the first sub element from a SimpleXML element.
         *
         * @param string $xpath The name of an attribute of the element.
         *
         * @return \SimpleXMLElement The value of the attribute (if it exists in element).
         */
        function get_element( $xpath ) {

            return count( $elements = $this->get_elements( $xpath ) )
                ? $elements[ 0 ]
                : null;
        }

        /**
         * Extracts elements from a SimpleXML element AS AN ARRAY!!! ;-)
         *
         * @return \SimpleXMLElement[] The value of the attribute (if it exists in element).
         */
        function elements() {
            return $this->get_elements( null );
        }

        /**
         * Given an XPath, extracts elements from a SimpleXML element AS AN ARRAY!!! ;-)
         *
         * @param string $xpath The name of an attribute of the element.
         *
         * @return \SimpleXMLElement[] The value of the attribute (if it exists in element).
         */
        function get_elements( $xpath ) {

            return ! empty( $xpath )
                ? $this->xml->xpath( $xpath )
                : array( $this->xml );
            
        }

    }
}
