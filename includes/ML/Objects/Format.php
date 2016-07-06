<?php


namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Format extends ML\Base\Model {

        /**
         * @var Objects\Mp3[]
         */
        var $mp3;

        /**
         * @var string
         */
        var $mediastream;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'mp3':
                    $this->mp3 = new Objects\Mp3( $xml_element );
                    break;

                case 'mediastream':
                    $this->set_string_value( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }


        }
    }
}