<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;
    use NprAlt\Util;

    class Paragraphs extends ML\Base\Model {

        /**
         * @var bool
         */
        var $is_html;

        /**
         * @var string[]
         */
        var $paragraphs = array();

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'paragraph':
                    $this->paragraphs[] = Util\Misc::sanitize_html( $xml_element->value() );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }

        /**
         * @return string
         */
        function __toString() {

            if ( $this->is_html ) {

                $paragraphs = array_map( array( 'NprML', 'sanitize_html' ), $this->paragraphs );

                $string = '<p>' . implode( "</p>\n\n<p>", $paragraphs ) . '</p>\n\n';

            } else {

                $string = implode( "\n\n", $this->paragraphs );

            }

            return $string;

        }

    }
}