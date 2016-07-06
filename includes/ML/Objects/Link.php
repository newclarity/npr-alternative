<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;

    class Link extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'value' => 'url',
        );

        /**
         * @var string
         */
        var $type;

        /**
         * @var string
         */
        var $url;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {
                case 'value':
                    $this->url = $xml_element->value();
                    break;
                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }

    }
}
