<?php

namespace NprAlt\ML\Objects {

    use NprAlt\ML;

    class Person extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'personId' => 'person_id',
            'value'    => 'name',
        );

        /**
         * @var string
         */
        var $person_id;

        /**
         * @var string
         */
        var $name;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'value':
                    $this->set_string_value( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }
    }
}
