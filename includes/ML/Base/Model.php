<?php

namespace NprAlt\ML\Base {

    use NprAlt\ML;
    use NprAlt\Core;

    abstract class Model extends Core\Instance {

        const EMPTY_XML = '<?xml version="1.0" encoding="UTF-8"?><nprml></nprml>';

        const PROPERTY_MAP = array();

        /**
         * NprML_Xml_Base constructor.
         *
         * @param \SimpleXMLElement|ML\Base\Xml_Element|string $xml
         * @param array                                     $properties
         */
        function __construct( $xml, $properties = array() ) {

            parent::__construct( $properties );

            if ( is_string( $xml ) ) {
                $xml = new \SimpleXMLElement( $xml );
            }

            if ( $xml instanceof \SimpleXMLElement ) {
                $root_element = new ML\Base\Xml_Element( $xml );

            } else if ( $xml instanceof ML\Base\Xml_Element ) {
                $root_element = $xml;

            } else {
                /*
                 * This should hopefully never happen
                 */
                $xml = new \SimpleXMLElement( self::EMPTY_XML );
                $root_element = new ML\Base\Xml_Element( $xml );
            }

            if ( $attributes = $root_element->attributes() ) {

                $attributes = $this->translate_attributes_to_properties( $attributes );

            }

            $this->assign_properties( $attributes );

            if ( trim( $root_element->value() ) ) {
                $root_element->property_name = $this->get_property_name( 'value' );
                $this->assign_value( 'value', $root_element );
            }

            $xml_iterator = $root_element->iterator;

            for ( $xml_iterator->rewind(); $xml_iterator->valid(); $xml_iterator->next() ) {

                $xml_element = new ML\Base\Xml_Element( $xml_iterator->current() );

                $element_name = $xml_iterator->key();

                $xml_element->property_name = $this->get_property_name( $element_name );

                $this->assign_value( $element_name, $xml_element );

            }

            $this->sanitize_properties( $root_element );
        }

        /**
         * Child classes can use this to sanitize properties after assignment
         *
         * @param ML\Base\Xml_Element $root_element
         */
        function sanitize_properties( $root_element ) {

        }

        /**
         * @param array $attributes
         *
         * @return array
         */
        function translate_attributes_to_properties( $attributes ) {

            foreach ( $attributes as $element_name => $value ) {

                $property_name = $this->get_property_name( $element_name );

                if ( $property_name !== $element_name ) {
                    $attributes[ $property_name ] = $value;
                    unset( $attributes[ $element_name ] );
                }

            }

            return $attributes;

        }

        /**
         * Takes element name and current XML helper and assigns its eleemnt values to this object.
         *
         * @note: Child classes should implement this method
         * @note: Be sure to call parent::assign_value( $element_name, $current );
         *
         * @param string                  $element_name
         * @param ML\Base\Xml_Element|mixed $xml_element
         *
         */
        function assign_value( $element_name, $xml_element ) {

            /*
             * This will either assign to $this->value or 
             * NprML_Instance_Base->_extra[ $property_name ]
             */
            $value = $xml_element instanceof ML\Base\Xml_Element
                ? trim( (string) $xml_element->value() )
                : trim( (string) $xml_element );

            if ( $value ) {
                $this->{$xml_element->property_name} = $value;
            }

        }

        /**
         * @param ML\Base\Xml_Element $xml_element
         *
         * @return mixed
         */
        function set_string_value( $xml_element ) {
            $this->{$xml_element->property_name} = $xml_element->value();
        }

        /**
         * @param object            $object
         * @param ML\Base\Xml_Element $xml_element
         *
         * @return mixed
         */
        function set_object_value( $xml_element, $object ) {
            $this->{$xml_element->property_name} = $object;
        }

        /**
         * @param ML\Base\Xml_Element $xml_element
         *
         * @return mixed
         */
        function set_datetime_value( $xml_element ) {
            $this->{$xml_element->property_name} = new ML\Base\DateTime( $xml_element );
        }

        /**
         * @param string $element_name
         *
         * @return mixed
         */
        function get_property_name( $element_name ) {

            $property_map = static::PROPERTY_MAP;

            return ! empty( $property_map[ $element_name ] )
                ? $property_map[ $element_name ]
                : $element_name;

        }
    }
}