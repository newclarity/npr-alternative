<?php

namespace NprAlt\Core {
    
    use NprAlt\Util\Messaging;
    
    /**
     * Base class for OOP container
     */
    abstract class Instance {

        /**
         * @var mixed
         */
        var $value;

        /**
         * @var array
         */
        var $_extra = array();

        /**
         * NprML_Instance_Base constructor.
         *
         * @param array $properties
         */
        function __construct( $properties = array() ) {

            if ( count( (array) $properties ) ) {

                $this->assign_properties( $properties );

            }

        }

        /**
         * @param array $properties
         */
        function assign_properties( $properties ) {

            if ( is_object( $properties ) ) {
                $properties = (array) $properties;
            }

            if ( is_array( $properties ) ) {
                foreach ( $properties as $property => $value ) {

                    $this->{$property} = $value;
                }
            }

        }

        /**
         * Magic method to access non-declared properties and log an error while doing it.
         *
         * @param string $property_name
         *
         * @return mixed
         */
        function __get( $property_name ) {

            $err_msg = Messaging::__( 'Assignment to non-existent property %s->%s.' );
            $err_msg = sprintf( $err_msg, get_class( $this ), $property_name );
            Messaging::debug_log( $err_msg );

            return isset( $this->_extra[ $property_name ] )
                ? $this->_extra[ $property_name ]
                : null;

        }

        /**
         * Magic method to set non-declared properties.
         *
         * @param string $property_name
         * @param mixed  $value
         */
        function __set( $property_name, $value ) {
            if ( $value = trim( $value ) ) {
                $this->_extra[ $property_name ] = $value;
            }
            $class_name = get_class( $this );
            echo "<p>{$class_name}->{$property_name} not found.</p>";
        }

        /**
         * @return string
         */
        function __toString() {
            return (string) $this->value;
        }

    }
}