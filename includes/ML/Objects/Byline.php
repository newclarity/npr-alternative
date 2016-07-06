<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Byline extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'name' => 'person',
        );

        /**
         * @var string
         */
        var $id;

        /**
         * @var Objects\Person
         */
        var $person;

        /**
         * @var Objects\Link[]
         */
        use Objects\Links;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'name':
                    $this->person = new Objects\Person( $xml_element );
                    break;

                case 'link':
                    $this->add_link( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }
    }
}